<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ExcelExportReport implements WithMultipleSheets,WithStyles {
    protected static $sheetsData = [];

    public static function addSheet(string $title, array $data): void {
        self::$sheetsData[$title] = $data;
    }

    public function sheets(): array {
        $sheets = [];

        foreach (self::$sheetsData as $sheetName => $sheetData) {
            $sheets[] = new class($sheetData, $sheetName) implements FromCollection, WithTitle, WithStyles, WithColumnWidths {
                protected $data;
                protected $name;

                public function __construct(array $data, string $name)
                {
                    $this->data = $data;
                    $this->name = $name;
                }

                public function collection()
                {
                    return new Collection($this->data);
                }

                public function title(): string
                {
                    return $this->name;
                }

                public function styles($sheet)
                {
                    return [
                        1    => ['font' => ['bold' => true]],
                    ];
                }

                public function columnWidths(): array {
                    return [
                        'A' => 10,
                        'B' => 11,
                        'C' => 25,
                        'D' => 18,
                        'E' => 14,
                        'F' => 30,
                        'G' => 20,
                        'H' => 16,
                        'I' => 16,
                        'J' => 14,
                        'K' => 14,
                        'L' => 15,
                        'M' => 20,
                        'N' => 20,
                        'O' => 20,
                    ];
                }

                public function chunkSize(): int
                {
                    return 1000;
                }
            };
        }
        return $sheets;
    }

    public function styles($sheet) {
        // $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
        //     'font' => [
        //         'bold' => true,
        //     ],
        // ]);
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
