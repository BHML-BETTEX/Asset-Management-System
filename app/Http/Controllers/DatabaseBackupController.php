<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Carbon\Carbon;

class DatabaseBackupController extends Controller
{
    protected $backupPath;
    protected $mysqldumpPath;

    public function __construct()
    {
        $this->backupPath = Config::get('backup.storage_path', storage_path('app/backups'));
        $this->mysqldumpPath = $this->getMysqldumpPath();

        if (!File::exists($this->backupPath)) {
            File::makeDirectory($this->backupPath, 0755, true);
        }
    }

    /**
     * Show the backup interface
     */
    public function index()
    {
        $tables = $this->getAllTables();
        $backupFiles = $this->getBackupFiles();
        $backupStatus = $this->getBackupStatus();

        return view('admin.backup.index', compact('tables', 'backupFiles', 'backupStatus'));
    }

    /**
     * Create full database backup
     */
    public function fullBackup(Request $request)
    {
        try {
            $format = $request->input('format', 'sql'); // sql or zip
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $dbName = Config::get('database.connections.mysql.database');

            $filename = "full_backup_{$dbName}_{$timestamp}.sql";
            $filePath = $this->backupPath . '/' . $filename;

            // Generate SQL dump
            $this->createSqlDump($filePath);

            // Set download completion cookie
            setcookie('download_completed', '1', time() + 60, '/');

            if ($format === 'zip') {
                $zipFilename = "full_backup_{$dbName}_{$timestamp}.zip";
                $zipPath = $this->backupPath . '/' . $zipFilename;

                $this->createZipFile($filePath, $zipPath, $filename);
                File::delete($filePath); // Remove SQL file after zipping

                return response()->download($zipPath)->deleteFileAfterSend(true);
            }

            return response()->download($filePath)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    /**
     * Create individual table backup
     */
    public function tableBackup(Request $request)
    {
        try {
            $tables = $request->input('tables', []);
            $format = $request->input('format', 'sql');
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');

            if (empty($tables)) {
                return back()->with('error', 'Please select at least one table to backup.');
            }

            if (count($tables) === 1) {
                // Single table backup
                $tableName = $tables[0];
                $filename = "table_{$tableName}_{$timestamp}.sql";
                $filePath = $this->backupPath . '/' . $filename;

                $this->createTableSqlDump($filePath, $tableName);

                // Set download completion cookie
                setcookie('download_completed', '1', time() + 60, '/');

                if ($format === 'zip') {
                    $zipFilename = "table_{$tableName}_{$timestamp}.zip";
                    $zipPath = $this->backupPath . '/' . $zipFilename;

                    $this->createZipFile($filePath, $zipPath, $filename);
                    File::delete($filePath);

                    return response()->download($zipPath)->deleteFileAfterSend(true);
                }

                return response()->download($filePath)->deleteFileAfterSend(true);

            } else {
                // Multiple tables backup
                $filename = "tables_backup_{$timestamp}.sql";
                $filePath = $this->backupPath . '/' . $filename;

                $this->createMultipleTablesSqlDump($filePath, $tables);

                // Set download completion cookie
                setcookie('download_completed', '1', time() + 60, '/');

                if ($format === 'zip') {
                    $zipFilename = "tables_backup_{$timestamp}.zip";
                    $zipPath = $this->backupPath . '/' . $zipFilename;

                    $this->createZipFile($filePath, $zipPath, $filename);
                    File::delete($filePath);

                    return response()->download($zipPath)->deleteFileAfterSend(true);
                }

                return response()->download($filePath)->deleteFileAfterSend(true);
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Table backup failed: ' . $e->getMessage());
        }
    }

    /**
     * Get all database tables
     */
    private function getAllTables()
    {
        $dbName = Config::get('database.connections.mysql.database');
        $tables = DB::select("SHOW TABLES");
        $tableKey = "Tables_in_{$dbName}";

        return collect($tables)->map(function($table) use ($tableKey) {
            return $table->$tableKey;
        })->toArray();
    }

    /**
     * Get existing backup files
     */
    private function getBackupFiles()
    {
        $files = File::files($this->backupPath);

        return collect($files)->map(function($file) {
            return [
                'name' => $file->getFilename(),
                'size' => $this->formatBytes($file->getSize()),
                'date' => Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s'),
                'path' => $file->getPathname()
            ];
        })->sortByDesc('date')->values()->toArray();
    }

    /**
     * Create SQL dump for full database
     */
    private function createSqlDump($filePath)
    {
        if ($this->mysqldumpPath) {
            $this->createMysqldumpFile($filePath);
        } else {
            $this->createPhpSqlDump($filePath);
        }
    }

    /**
     * Create mysqldump file
     */
    private function createMysqldumpFile($filePath, $tables = [])
    {
        $dbHost = Config::get('database.connections.mysql.host');
        $dbPort = Config::get('database.connections.mysql.port', 3306);
        $dbName = Config::get('database.connections.mysql.database');
        $dbUser = Config::get('database.connections.mysql.username');
        $dbPassword = Config::get('database.connections.mysql.password');

        $options = implode(' ', Config::get('backup.mysqldump_options', [
            '--single-transaction',
            '--routines',
            '--triggers',
            '--lock-tables=false'
        ]));

        $tablesStr = empty($tables) ? '' : implode(' ', array_map('escapeshellarg', $tables));

        // Build command
        $command = sprintf(
            '"%s" --host=%s --port=%s --user=%s --password=%s %s %s %s > %s',
            $this->mysqldumpPath,
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbUser),
            escapeshellarg($dbPassword),
            $options,
            escapeshellarg($dbName),
            $tablesStr,
            escapeshellarg($filePath)
        );

        $result = shell_exec($command . ' 2>&1');

        if (!File::exists($filePath) || File::size($filePath) === 0) {
            // Fallback to PHP-based dump if mysqldump fails
            if (empty($tables)) {
                $this->createPhpSqlDump($filePath);
            } else {
                $this->createPhpMultipleTablesSqlDump($filePath, $tables);
            }
        }
    }

    /**
     * Create SQL dump for specific table
     */
    private function createTableSqlDump($filePath, $tableName)
    {
        if ($this->mysqldumpPath) {
            $this->createMysqldumpFile($filePath, [$tableName]);
        } else {
            $this->createPhpTableSqlDump($filePath, $tableName);
        }
    }

    /**
     * Create SQL dump for multiple tables
     */
    private function createMultipleTablesSqlDump($filePath, $tables)
    {
        if ($this->mysqldumpPath) {
            $this->createMysqldumpFile($filePath, $tables);
        } else {
            $this->createPhpMultipleTablesSqlDump($filePath, $tables);
        }
    }

    /**
     * PHP-based SQL dump as fallback
     */
    private function createPhpSqlDump($filePath)
    {
        $dbName = Config::get('database.connections.mysql.database');
        $tables = $this->getAllTables();

        $sql = "-- Database Backup: {$dbName}\n";
        $sql .= "-- Generated on: " . Carbon::now()->format('Y-m-d H:i:s') . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $sql .= $this->getTableStructureAndData($table);
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        File::put($filePath, $sql);
    }

    /**
     * PHP-based single table SQL dump
     */
    private function createPhpTableSqlDump($filePath, $tableName)
    {
        $sql = "-- Table Backup: {$tableName}\n";
        $sql .= "-- Generated on: " . Carbon::now()->format('Y-m-d H:i:s') . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";
        $sql .= $this->getTableStructureAndData($tableName);
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        File::put($filePath, $sql);
    }

    /**
     * PHP-based multiple tables SQL dump
     */
    private function createPhpMultipleTablesSqlDump($filePath, $tables)
    {
        $sql = "-- Tables Backup: " . implode(', ', $tables) . "\n";
        $sql .= "-- Generated on: " . Carbon::now()->format('Y-m-d H:i:s') . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $sql .= $this->getTableStructureAndData($table);
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        File::put($filePath, $sql);
    }

    /**
     * Get table structure and data
     */
    private function getTableStructureAndData($tableName)
    {
        $sql = "\n-- Table: {$tableName}\n";
        $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";

        // Get table structure
        $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
        $sql .= $createTable->{'Create Table'} . ";\n\n";

        // Get table data
        $rows = DB::table($tableName)->get();

        if ($rows->count() > 0) {
            $sql .= "-- Data for table `{$tableName}`\n";
            $sql .= "INSERT INTO `{$tableName}` VALUES\n";

            $values = [];
            foreach ($rows as $row) {
                $rowValues = [];
                foreach ($row as $value) {
                    if (is_null($value)) {
                        $rowValues[] = 'NULL';
                    } else {
                        $rowValues[] = "'" . addslashes($value) . "'";
                    }
                }
                $values[] = '(' . implode(', ', $rowValues) . ')';
            }

            $sql .= implode(",\n", $values) . ";\n\n";
        }

        return $sql;
    }

    /**
     * Create ZIP file
     */
    private function createZipFile($sqlPath, $zipPath, $sqlFilename)
    {
        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($sqlPath, $sqlFilename);
            $zip->close();
        } else {
            throw new \Exception('Could not create ZIP file');
        }
    }

    /**
     * Download existing backup file
     */
    public function downloadBackup($filename)
    {
        $filePath = $this->backupPath . '/' . $filename;

        if (!File::exists($filePath)) {
            return back()->with('error', 'Backup file not found.');
        }

        // Set download completion cookie
        setcookie('download_completed', '1', time() + 60, '/');

        return response()->download($filePath);
    }

    /**
     * Delete backup file
     */
    public function deleteBackup($filename)
    {
        $filePath = $this->backupPath . '/' . $filename;

        if (File::exists($filePath)) {
            File::delete($filePath);
            return back()->with('success', 'Backup file deleted successfully.');
        }

        return back()->with('error', 'Backup file not found.');
    }

    /**
     * Get mysqldump executable path
     */
    private function getMysqldumpPath()
    {
        // Check if path is configured
        $configuredPath = Config::get('backup.mysqldump_path');
        if ($configuredPath && $this->isExecutableValid($configuredPath)) {
            return $configuredPath;
        }

        // Auto-detect from common paths
        $commonPaths = Config::get('backup.common_paths', []);
        foreach ($commonPaths as $path) {
            if ($this->isExecutableValid($path)) {
                return $path;
            }
        }

        // Try system PATH
        if ($this->isExecutableValid('mysqldump')) {
            return 'mysqldump';
        }

        return null;
    }

    /**
     * Check if mysqldump executable is valid
     */
    private function isExecutableValid($path)
    {
        if (empty($path)) {
            return false;
        }

        // For Windows, add .exe if not present
        if (PHP_OS_FAMILY === 'Windows' && !str_ends_with(strtolower($path), '.exe') && $path !== 'mysqldump') {
            $path .= '.exe';
        }

        return File::exists($path) || $this->commandExists($path);
    }

    /**
     * Check if command exists in system PATH
     */
    private function commandExists($command)
    {
        $whereIsCommand = PHP_OS_FAMILY === 'Windows' ? 'where' : 'which';
        $process = proc_open(
            "$whereIsCommand $command",
            [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $pipes
        );

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            $errors = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            $returnCode = proc_close($process);

            return $returnCode === 0 && !empty(trim($output));
        }

        return false;
    }

    /**
     * Get backup status information
     */
    public function getBackupStatus()
    {
        return [
            'mysqldump_available' => !is_null($this->mysqldumpPath),
            'mysqldump_path' => $this->mysqldumpPath,
            'storage_path' => $this->backupPath,
            'storage_writable' => is_writable($this->backupPath),
            'php_fallback' => true,
        ];
    }

    /**
     * Detect and return available mysqldump paths
     */
    public function detectMysqldumpPath()
    {
        $detectedPaths = [];
        $commonPaths = Config::get('backup.common_paths', []);

        // Check configured path
        $configuredPath = Config::get('backup.mysqldump_path');
        if ($configuredPath && $this->isExecutableValid($configuredPath)) {
            $detectedPaths['configured'] = $configuredPath;
        }

        // Check common paths
        foreach ($commonPaths as $path) {
            if ($this->isExecutableValid($path)) {
                $detectedPaths['common'][] = $path;
            }
        }

        // Check system PATH
        if ($this->isExecutableValid('mysqldump')) {
            $detectedPaths['system'] = 'mysqldump (in system PATH)';
        }

        return response()->json([
            'success' => true,
            'detected_paths' => $detectedPaths,
            'current_path' => $this->mysqldumpPath,
            'suggestions' => $this->getMysqldumpSuggestions()
        ]);
    }

    /**
     * Get mysqldump path suggestions based on OS
     */
    private function getMysqldumpSuggestions()
    {
        if (PHP_OS_FAMILY === 'Windows') {
            return [
                'XAMPP' => 'C:\xampp\mysql\bin\mysqldump.exe',
                'Laragon' => 'C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe',
                'WAMP' => 'C:\wamp64\bin\mysql\mysql8.0.31\bin\mysqldump.exe',
            ];
        } else {
            return [
                'Standard Linux' => '/usr/bin/mysqldump',
                'Homebrew (Mac)' => '/usr/local/bin/mysqldump',
                'XAMPP Linux' => '/opt/lampp/bin/mysqldump',
            ];
        }
    }

    /**
     * Format file size
     */
    private function formatBytes($size)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor((strlen($size) - 1) / 3);

        return sprintf("%.2f %s", $size / pow(1024, $factor), $units[$factor]);
    }
}