<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Livewire\Component;

class DataBarang extends Component
{
    public $statusModal = 'tambah barang';
    public $titleModal = 'Tambah Barang';
    public $sizeModal = 'modal-default';
    public $search = '';

    public $kode_barang, $nama_barang;
    public $editStatus = false;


    public $barang, $idBarang;

    protected $rules = [
        'kode_barang' => 'required|min:6|unique:barangs,kode_barang',
        'nama_barang' => 'required',
    ];

    public function mount()
    {
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        if ($this->search === '') {

            $this->barang = Barang::latest()->get();
        } else {
            $this->barang = Barang::where('nama_barang', 'like', '%' . $this->search . '%')
                ->orWhere('kode_barang', 'like', '%' . $this->search . '%')->latest()->get();
        }
        return view('livewire.data-barang');
    }

    public function showModal($val)
    {
        if ($val = 'tambah barang') {
            $this->statusModal = $val;
            // dd($this->statusModal);
            $this->titleModal = 'Tambah Barang';
            $this->sizeModal = 'modal-default';
        }
    }

    public function submitHandler()
    {
        $attr = $this->validate();

        $this->barang = Barang::create($attr);
        $this->info('menambah');
        $this->resetPage();
    }

    public function edit($value)
    {
        $this->editStatus = true;
        $this->statusModal = 'tambah barang';
        $this->titleModal = 'Edit Barang ' . $value['nama_barang'];
        $this->nama_barang = $value['nama_barang'];
        $this->kode_barang = $value['kode_barang'];
        $this->idBarang = $value['id'];
    }

    public function delete($id)
    {
        $this->barang = Barang::findOrfail($id);
        $this->barang->delete();
        $this->info('mengedit');

        $this->resetPage();
    }

    public function updateHandler()
    {
        $this->barang = Barang::findOrfail($this->idBarang);
        $attr = $this->validate();
        $this->barang->update($attr);
        $this->info('mengedit');
        $this->editStatus = false;
        $this->resetPage();
    }

    public function lihatPenjualan($id)
    {
        return redirect()->route('penjualan-barang')->with('idBarang', $id);
    }


    public function resetPage()
    {
        $this->nama_barang = '';
        $this->kode_barang = '';
    }

    public function info($pesan)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil ' . $pesan . ' data',
            'text' => ''
        ]);
    }
}