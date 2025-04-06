<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // Convert join_date
            $joinDate = null;
            if (!empty($row['join_date'])) {
                if (is_numeric($row['join_date'])) {
                    $joinDate = Date::excelToDateTimeObject($row['join_date'])->format('Y-m-d');
                } else {
                    $joinDate = Carbon::parse($row['join_date'])->format('Y-m-d');
                }
            }

            // Check for existing employee by email
            $employee = Employee::where('emp_id', $row['emp_id'])->first();

            $data = [
                'emp_id'         => $row['emp_id'],
                'emp_name'       => $row['emp_name'],
                'department_id'  => $row['department_id'],
                'designation_id' => $row['designation_id'],
                'join_date'      => $joinDate,
                'phone_number'   => $row['phone_number'],
                'email'   => $row['email'],
                'others'         => $row['others'],
                'status'         => $row['status'],
                'picture'        => $row['picture'],
                'company'        => $row['company'],
            ];

            if ($employee) {
                $employee->update($data);
            } else {
                // Add email back to data for new records
                $data['emp_id'] = $row['emp_id'];
                Employee::create($data);
            }
        }
    }
}
