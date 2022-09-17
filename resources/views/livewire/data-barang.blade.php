<div class="ml-4 px-24 my-8">
    @component('components.snippets.modals',
        ['title' => $titleModal, 'idModals' => 'modalsLarge', 'sizeModals' => $sizeModal])
        @if ($statusModal === 'tambah barang')
            <form action="" wire:submit.prevent="{{ $editStatus ? 'updateHandler' : 'submitHandler' }}" class="w-full">
                <div class="">
                    <label for="">Kode Produk</label>
                    <input wire:model="kode_barang" type="text" name="" id="" class="form-control w-full">
                    @error('kode_barang')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="">
                    <label for="">Nama Produk</label>
                    <input wire:model="nama_barang" type="text" name="" id=""
                        class="form-control w-full">
                    @error('nama_barang')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="button hover:bg-orange-500 hover:text-white">{{ $editStatus ? 'Update' : 'Submit' }}</button>
            </form>
        @endif
    @endcomponent
    <div class=" border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2">
        <div class="flex gap-x-2 px-4 py-2 border-b-4 border-orange-500 w-full items-center ">
            <div class="flex items-center gap-x-2">
                <a href="{{ route('dashboard') }}">
                    <i
                        class="bi bi-house-door-fill text-orange-500 text-[16pt] p-1 shadow-md shadow-gray-400/50 border"></i>
                </a>
                <a href="{{ route('dashboard') }}" class="text-[16pt] hover:text-orange-400 transitions">
                    Dashboard
                </a>
                <a href="" class="text-[16pt] hover:text-orange-400 transitions">
                    / Data Barang
                </a>
            </div>
        </div>
        <div class="flex lg:flex-row flex-col justify-between gap-y-2 my-2">
            <div class="flex gap-x-2">

                <button type="submit" wire:click="showModal('tambah barang')" data-bs-toggle="modal"
                    data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                    Barang</button>
            </div>
            <div class="flex gap-x-2  items-center justify-end">
                <input wire:model='search' type="text" placeholder="Search..."
                    class="border border-gray-400/50 rounded-md px-2 py-1 mb-2">
            </div>

        </div>

        {{-- Table --}}
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b border-gray-400/50">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Kode Produk
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Nama Barang
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barang as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->kode_barang }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->nama_barang }}</p>
                                        </td>

                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <div class="flex justify-center">
                                                <div>
                                                    <div class="dropdown relative">
                                                        <button
                                                            class="p-1 relative w-20 flex items-center justify-center border border-gray-500 transitions hover:bg-slate-400 hover:cursor-pointer shadow-md shadow-gray-500/50"
                                                            type="button" id="dropdownMenuButton1"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <ul class=" dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                                            aria-labelledby="dropdownMenuButton1">
                                                            <div class="flex flex-col gap-y-1">
                                                                <button wire:click="lihatPenjualan({{ $item->id }})"
                                                                    class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Lihat
                                                                    Penjualan</button>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#modalsLarge"
                                                                    wire:click="edit({{ $item }})"
                                                                    class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Edit</button>
                                                                <button wire:click="delete({{ $item->id }})"
                                                                    class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
