<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataIkmExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($filteredData)
    {
        $this->data = $filteredData;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                $item->nama_ikm,
                $item->luas,
                $item->nama_pemilik,
                $item->jenis_kelamin,
                $item->kecamatan,
                $item->kelurahan,
                $item->komoditi,
                $item->jenis_industri,
                $item->alamat,
                $item->nib,
                $item->no_telp,
                $item->tenaga_kerja,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Usaha', 'Luas', 'Nama Pemilik', 'Jenis Kelamin', 'Kecamatan', 'Kelurahan',
            'Komoditi', 'Jenis Industri', 'Alamat', 'NIB', 'No Telp', 'Tenaga Kerja',
        ];
    }
}
