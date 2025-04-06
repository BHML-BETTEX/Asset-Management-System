<?php

namespace App\Imports;

use App\Models\Store;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;


class StoreImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // Convert join_date
            $purchase_date = null;
            if (!empty($row['purchase_date'])) {
                if (is_numeric($row['purchase_date'])) {
                    $purchase_date = Date::excelToDateTimeObject($row['purchase_date'])->format('Y-m-d');
                } else {
                    $purchase_date = Carbon::parse($row['purchase_date'])->format('Y-m-d');
                }
            }
            Store::create([
                'asset_type'       => $row['asset_type'],
                'model'            => $row['model'],
                'brand'            => $row['brand'],
                'description'      => $row['description'],
                'asset_sl_no'      => $row['asset_sl_no'],
                'qty'              => $row['qty'],
                'units'            => $row['units'],
                'warrenty'         => $row['warrenty'],
                'durablity'        => $row['durablity'],
                'cost'             => $row['cost'],
                'currency'         => $row['currency'],
                'vendor'           => $row['vendor'],
                'purchase_date'    => $purchase_date,
                'challan_no'       => $row['challan_no'],
                'picture'          => $row['picture'],
                'status'           => $row['status'],
                'location'         => $row['location'],
                'company'          => $row['company'],
                'others'           => $row['others'],
                'checkstatus'      => $row['checkstatus'],
                'others2'          => $row['others2'],
            ]);

            
        }
    }
}
