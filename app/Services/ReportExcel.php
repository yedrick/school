<?php

namespace App\Services;

use App\Exports\ExcelExportReport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportExcel {

    public static function generateExcel($titles, $data,$filename,$file) {
        $data = array_merge([$titles], $data);
        ExcelExportReport::addSheet($file, $data);
        $export = new ExcelExportReport();
        $now=Carbon::now()->toDateString();
        $nameFile = "{$now}-{$filename}.xlsx";
        $excel = Excel::download($export, $nameFile, \Maatwebsite\Excel\Excel::XLSX);
        return  $excel;
    }
}
