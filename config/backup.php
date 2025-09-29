<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MySQL Dump Path Configuration
    |--------------------------------------------------------------------------
    |
    | Specify the path to mysqldump executable. Leave empty to auto-detect.
    | Common paths:
    | - Windows (XAMPP): C:\xampp\mysql\bin\mysqldump.exe
    | - Windows (Laragon): C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe
    | - Windows (WAMP): C:\wamp64\bin\mysql\mysql8.0.31\bin\mysqldump.exe
    | - Linux/Mac: /usr/bin/mysqldump or /usr/local/bin/mysqldump
    |
    */
    'mysqldump_path' => env('MYSQLDUMP_PATH', ''),

    /*
    |--------------------------------------------------------------------------
    | Common MySQL Dump Paths
    |--------------------------------------------------------------------------
    |
    | These paths will be checked automatically if no path is specified
    |
    */
    'common_paths' => [
        // Windows paths
        'C:\xampp\mysql\bin\mysqldump.exe',
        'C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe',
        'C:\laragon\bin\mysql\mysql-8.0.35-winx64\bin\mysqldump.exe',
        'C:\laragon\bin\mysql\mysql-5.7.33-winx64\bin\mysqldump.exe',
        'C:\wamp64\bin\mysql\mysql8.0.31\bin\mysqldump.exe',
        'C:\wamp\bin\mysql\mysql8.0.31\bin\mysqldump.exe',
        'D:\laragon\bin\mysql\mysql-5.7.39-winx64\bin\mysqldump.exe',

        // Linux/Mac paths
        '/usr/bin/mysqldump',
        '/usr/local/bin/mysqldump',
        '/opt/lampp/bin/mysqldump',
        '/Applications/XAMPP/xamppfiles/bin/mysqldump',
    ],

    /*
    |--------------------------------------------------------------------------
    | Backup Storage Path
    |--------------------------------------------------------------------------
    |
    | Directory where backup files will be stored
    |
    */
    'storage_path' => storage_path('app/backups'),

    /*
    |--------------------------------------------------------------------------
    | Default Backup Options
    |--------------------------------------------------------------------------
    |
    | Default mysqldump options
    |
    */
    'mysqldump_options' => [
        '--single-transaction',
        '--routines',
        '--triggers',
        '--lock-tables=false',
        '--no-tablespaces',
    ],

    /*
    |--------------------------------------------------------------------------
    | Maximum Backup File Age (in days)
    |--------------------------------------------------------------------------
    |
    | Automatically clean up backup files older than this many days
    | Set to 0 to disable automatic cleanup
    |
    */
    'max_file_age' => 30,
];