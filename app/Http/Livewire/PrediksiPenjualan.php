<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Livewire\Component;

class PrediksiPenjualan extends Component
{
    public $titleModal = '';
    public $sizeModal = 'modal-default';
    public $showGraph = false;
    public $barang;

    public $arrayLevel, $arrayTrend = [];
    public $arraySeasonal, $forecast;
    public $seasonal = [];
    public $dataBarang;
    public $displayModal = 'form';

    public $dataPrediksi;
    public $data;
    public $forecastNext = [];
    public $predictMonth = 12;
    public $tauhn = [];
    public function render()
    {
        if (!auth()->user()) {
            abort(403);
        }
        $this->barang = Barang::latest()->get();
        return view('livewire.prediksi-penjualan');
    }

    public function selectProduk($value)
    {
        $this->dataBarang = Barang::findOrfail($value['id']);

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

        // Mencari Error
        $forecast = array_slice($this->forecast, count($this->forecast) - 12);
        $actualTerkhir = array_slice($array1, count($array1) - 12);
        // dd($forecast);
        $error = [];
        $ape = [];
        $akurasi = [];
        $mape = 0;
        $pape = 0;
        $rataAkurasi = 0;
        for ($i = 0; $i < count($forecast); $i++) {
            $error[] = abs($forecast[$i] - $actualTerkhir[$i]);
            $ape[] = abs($actualTerkhir[$i] - $forecast[$i]) / $actualTerkhir[$i] * 100;
            $akurasi[] = 100 - $ape[$i];
            $mape += $error[$i];
            $pape += $ape[$i];
            $rataAkurasi += $akurasi[$i];
        }
        // dd($this->forecast);
        // dd($mape);
        $this->dataPrediksi = [
            'tahun' => array_slice($array2, count($array2) - 12),
            'forecast' => array_slice($this->forecast, count($this->forecast) - 12),
            'actual' => array_slice($array1, count($array1) - 12),
            'error' => $error,
            'ape' => $ape,
            'akurasi' => $akurasi,
            'mape' => $mape / 12,
            'pape' => $pape / 12,
            'rataAkurasi' => $rataAkurasi / 12
        ];
        // dd($this->dataPrediksi);
        $this->data = $data;
        $this->tauhn = array_slice($array2, count($array2) - 12);
        // $this->forecastPeriode();
        $this->dispatchBrowserEvent('chart', ['data' => $data]);
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
        // dd($levelSebelumnya, $trendSebelumnya);
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

    public function displayModal($value)
    {
        $this->displayModal = $value;
        if ($this->displayModal == 'form') {
            $this->titleModal = 'Form';
            $this->sizeModal = 'modal-default';
        } else if ($this->displayModal == 'periode sebelumnya') {
            $this->titleModal = 'Hasil Prediksi Sebelumnya';
            $this->sizeModal = 'modal-xl';
            $this->dispatchBrowserEvent('chart2', ['data' => $this->data]);
        } else if ($this->displayModal == 'prediksi') {
            $this->titleModal = 'Form Predksi';
            $this->sizeModal = 'modal-default';
        }
    }

    public function forecastPeriode()
    {
        if ($this->predictMonth <= 12) {
            $nextForec = [];
            $tahun = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'oct', 'nov', 'dec',];
            $varTahun = substr($this->tauhn[0], 6);
            // dd($varTahun);
            $levelTrakhir = $this->arrayLevel[count($this->arrayLevel) - 1];
            $trendTerakhir = $this->arrayTrend[count($this->arrayTrend) - 1];

            $seasonalTerkait = array_slice($this->arraySeasonal, count($this->arraySeasonal) - 12);

            // dd($seasonalTerkait, $this->arraySeasonal);
            $k =  $this->predictMonth;
            // dd($k);
            $no = 1;
            for ($i = 0; $i < $k; $i++) {
                $nextForec[] = ($levelTrakhir + ($i + 1) * $trendTerakhir) * $seasonalTerkait[$i];
                if ($i <= 12) {
                    $tahun[$i] = $tahun[$i] . '-20' . ((int)$varTahun + $no);
                } else {
                    $no++;
                    $tahun[$i] = $tahun[$i] . (int)$varTahun + $no;
                }
                // print($i);
            }
            $this->forecastNext = [
                'tahun' => $tahun,
                'forecast' => $nextForec

            ];
        }
        // dd($this->forecastNext['tahun']);
    }
}