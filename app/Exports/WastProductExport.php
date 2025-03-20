<?php

namespace App\Exports;

use App\Models\WastProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WastProductExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return WastProduct::whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function headings(): array
    {
        return [
            "asset_tag", "asset_type", "model", "purchase_date", 
            "description", "asset_sl_no", "date", "note", 
            "others", "created_at"
        ]; // Ensure these match your database columns
    }

    public function map($WastProduct): array
    {
        return [
            $WastProduct->asset_tag ?? '',
            $WastProduct->asset_type ?? '',
            $WastProduct->model ?? '',
            $WastProduct->purchase_date ? Date::dateTimeToExcel($WastProduct->purchase_date) : '',
            $WastProduct->description ?? '',
            $WastProduct->asset_sl_no ?? '',
            $WastProduct->others ?? '',
            Date::dateTimeToExcel($WastProduct->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_YYYYMMDD, // purchase_date
            'G' => NumberFormat::FORMAT_DATE_YYYYMMDD, // created_at
        ];
    }
}
