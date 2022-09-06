<?php

namespace App\Imports;

use App\Models\DetailPenjualan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DetailPenjualanImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public $barang_id = 0;
    public function __construct($barang_id)
    {
        $this->barang_id = $barang_id;
    }


    public function collection(Collection $collection)
    {
        // dd($collection);

        foreach ($collection as $row) {

            if ($row['tahun'] == null) {
                break;
            } else {
                DetailPenjualan::create([
                    'barang_id' => $this->barang_id,
                    'tahun_penjualan' => $row['tahun'],
                    'jan' => $row['jan'],
                    'feb' => $row['feb'],
                    'mar' => $row['mar'],
                    'apr' => $row['apr'],
                    'mei' => $row['may'],
                    'jun' => $row['jun'],
                    'jul' => $row['jul'],
                    'agu' => $row['aug'],
                    'sep' => $row['sep'],
                    'oct' => $row['oct'],
                    'nov' => $row['nov'],
                    'dec' => $row['dec'],
                ]);
            }
        }
    }
}