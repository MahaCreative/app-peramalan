<?php

namespace App\Http\Livewire;

use App\Imports\DetailPenjualanImport;
use App\Imports\DetailPenjualanImportt;
use App\Models\Barang;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class PenjualanBarang extends Component
{
    use WithFileUploads;

    public $idBarang;
    public $statusModal = 'tambah barang';
    public $titleModal = 'Upload File Penjualan Excel';
    public $sizeModal = 'modal-default';
    public $kode_barang, $nama_barang, $file;
    public $dataBarang;
    public $data;

    public $arrayLevel, $arrayTrend = [];
    public $arraySeasonal, $forecast;

    public $seasonal = [];
    public $showGraph = false;
    public function mount()
    {
        $this->idBarang = session()->get('idBarang');
        // if ($this->idBarang == null) {
        //     abort(403);
        // }
        $this->dataBarang = Barang::findOrfail($this->idBarang);
        // $this->dataBarang = Barang::findOrfail(1);
        $this->kode_barang = $this->dataBarang->kode_barang;
        $this->nama_barang = $this->dataBarang->nama_barang;
    }

    public function render()
    {
        // dd($this->dataBarang->detail_penjualan()->get());

        // ubahPolaData


        return view('livewire.penjualan-barang');
    }

    public function trainData()
    {
        $this->showGraph = !$this->showGraph;
        $array1 = [];
        $array2 = [];
        $bulan = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'oct', 'nov', 'dec',];
        $no = 0;
        $tahun = 0;
        $countTahun = count($this->dataBarang->detail_penjualan()->get());

        while ($no <= 12) {

            if ($no == 12) {
                $no = 0;
                $tahun++;
            }
            if ($tahun == $countTahun) {
                break;
            }

            $array1[] = $this->dataBarang->detail_penjualan()->get()[$tahun][$bulan[$no]];
            $array2[] =  $bulan[$no] . '-' . $this->dataBarang->detail_penjualan()->get()[$tahun]['tahun_penjualan'];
            $no++;
        }




        $this->arraySeasonal = $this->getSeasonal(array_slice($array1, 0, 12));
        $this->hitung($array1);
        $this->Forecast($array1);

        $data['tahun'] = $array2;
        $data['penjualan'] = $array1;
        $data['seasonal'] = $this->arraySeasonal;
        $data['level'] = $this->arrayLevel;
        $data['forecast'] = $this->forecast;
        $this->dispatchBrowserEvent('chart', ['data' => $data]);
        // $this->data = json_encode($data);

        // dd($this->arrayLevel, $this->arraySeasonal, $this->arrayTrend);
    }

    protected function seedLevel($data)
    {
        // dd($data);
        $sum = 0;
        for ($i = 0; $i < count($data); $i++) {
            $sum += $data[$i];
        }
        return $sum / 12;
    }

    public function getSeasonal($data)
    {
        $seedLevel = $this->seedLevel($data);
        $array = [];

        for ($i = 0; $i < count($data); $i++) {
            $array[] = $data[$i] / $seedLevel;
        }
        return $array;
    }

    protected function seedTrend($data)
    {
        $sum = 0;
        $y1 = array_slice($data, 0, 12);
        $y2 = array_slice($data, 12, 24);

        for ($i = 0; $i < 12; $i++) {
            $sum += $y2[$i] - $y1[$i];
        }
        return $sum / (12 * 12);
    }

    public function hitung($data)
    {
        $alpha =  0.141;
        $gamma = 0.141;
        $beta =  0.141;

        $levelSebelumnya = $this->seedLevel(array_slice($data, 0, 12));
        $trendSebelumnya = $this->seedTrend($data);

        for ($i = 0; $i < count(array_slice($data, 12)); $i++) {
            if ($i < count(array_slice($data, 12))) {
                if ($i == 0) {

                    // Mencari nilai initial awal Level
                    $lt = $alpha * ($data[12] / $this->arraySeasonal[$i]) + (1 - $alpha) * ($levelSebelumnya + $trendSebelumnya);
                    $this->arrayLevel[] = $lt;

                    // Mencari nilai initial awal trend
                    $bt = $beta * ($this->arrayLevel[$i] - $levelSebelumnya) + (1 - $beta) * $trendSebelumnya;
                    $this->arrayTrend[] = $bt;
                } else {
                    $lt = $alpha * ($data[12 + $i] / $this->arraySeasonal[$i]) + (1 - $alpha) * ($this->arrayLevel[$i - 1] + $this->arrayTrend[$i - 1]);
                    $this->arrayLevel[] = $lt;

                    // Mencari nilai initial awal trend
                    $bt = $beta * ($this->arrayLevel[$i] - $this->arrayLevel[$i - 1]) + (1 - $beta) * $this->arrayTrend[$i - 1];
                    $this->arrayTrend[] = $bt;
                }

                // Mencari Nilai Seasonal
                $st = $gamma * ($data[12 + $i] / $this->arrayLevel[$i]) + (1 - $gamma) * $this->arraySeasonal[$i];
                $this->arraySeasonal[] = $st;
            }
        }
    }

    public function Forecast($data)
    {

        $levelSebelumnya = $this->seedLevel(array_slice($data, 0, 12));
        $trendSebelumnya = $this->seedTrend($data);


        for ($i = 0; $i < count(array_slice($data, 12)); $i++) {
            if ($i == 0) {
                $this->forecast[] = ($levelSebelumnya + 1 * $trendSebelumnya) * $this->arraySeasonal[$i];
            } else {
                $this->forecast[] = ($this->arrayLevel[$i - 1] + 1 * $this->arrayTrend[$i - 1]) * $this->arraySeasonal[$i];
            }
        }
    }

    public function submitHandler()
    {
        // dd($this->file);
        Excel::import(new DetailPenjualanImport($this->idBarang), $this->file);
    }
}