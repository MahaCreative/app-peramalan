<div class="ml-4 px-24 my-8">
    @component('components.snippets.modals',
        ['title' => $titleModal, 'idModals' => 'modalsLarge', 'sizeModals' => $sizeModal])
        <form action="" wire:submit.prevent="forecastPeriode" class="w-full">
            @if ($displayModal == 'form')
                <div class="">
                    <label for="">Prediksi Berapa Bulan Ke Depan</label>
                    <input wire:model="predictMonth" type="number" name="" id="" class="form-control w-full"
                        placeholder="12">
                    @error('predictMonth')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                </div>
            @elseif ($displayModal == 'periode sebelumnya')
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-1 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="border-b border-gray-400/50">
                                    <tr>

                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 text-left">
                                            Tahun Prediksi
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 text-left">
                                            Penjualan Actual
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 text-left">
                                            Hasil Prediksi
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 text-left">
                                            Absolute Error
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 text-left">
                                            Absolute Persantase Error
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 text-left">
                                            Akurasi
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @if ($dataPrediksi)
                                        @dd($dataPrediksi['tahun'][9])
                                    @endif --}}
                                    @for ($i = 0; $i < count($dataPrediksi['tahun']); $i++)
                                        <tr wire:click="selectProduk()"
                                            class="border-b border-gray-400/50 hover:bg-cyan-300 hover:cursor-pointer transitions">

                                            <td class="text-sm text-gray-900 font-light px-6 py-1 whitespace-nowrap">
                                                <p>{{ $dataPrediksi['tahun'][$i] }}</p>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-1 whitespace-nowrap">
                                                <p>{{ $dataPrediksi['actual'][$i] }}</p>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-1 whitespace-nowrap">
                                                <p>{{ $dataPrediksi['forecast'][$i] }}</p>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-1 whitespace-nowrap">
                                                <p>{{ $dataPrediksi['error'][$i] }}</p>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-1 whitespace-nowrap">
                                                <p>{{ $dataPrediksi['ape'][$i] }}</p>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-1 whitespace-nowrap">
                                                <p>{{ $dataPrediksi['akurasi'][$i] }}</p>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="">
                            <label for="" class="text-bold">Mean Absolute Prediction Error (MAPE)</label>
                            <input disabled type="text" name="" id="" class="form-control "
                                value="{{ $dataPrediksi['mape'] }}">
                        </div>
                        <div class="">
                            <label for="" class="text-bold">Mean Absolute Persantase Error</label>
                            <input disabled type="text" name="" id="" class="form-control "
                                value="{{ $dataPrediksi['pape'] }}">
                        </div>
                        <div class="">
                            <label for="" class="text-bold">Akurasi Prediksi</label>
                            <input disabled type="text" name="" id="" class="form-control "
                                value="{{ $dataPrediksi['rataAkurasi'] }}">
                        </div>
                    </div>
                    <div
                        class="border w-full lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            @elseif ($dislpayModal == 'prediksi')
            @endif
            <button type="submit" class="button hover:bg-orange-500 hover:text-white">Submit</button>
        </form>
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
                    / Data Penjualan
                </a>
            </div>
        </div>
        <div class="flex lg:flex-row flex-col justify-between gap-y-2 my-2">
            <div class="flex gap-x-2  items-center justify-end">
                <input wire:model='search' type="text" placeholder="Search..."
                    class="border border-gray-400/50 rounded-md px-2 py-1 mb-2">
            </div>

        </div>


        <div class="grid grid-cols-2 gap-x-2">
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
                                        Kode Barang
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
                                    <tr wire:click="selectProduk({{ $item }})"
                                        class="border-b border-gray-400/50 hover:bg-cyan-300 hover:cursor-pointer transitions">
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
                                            <button class="button hover:bg-orange-500 hover:text-white"
                                                data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                wire:click="displayModal('form')">Prediksi</button>
                                        </td>


                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div
                class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="mx-4">
            <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                wire:click="displayModal('periode sebelumnya')"
                class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Lihat
                Hasil Prediksi Periode Sebelumnya</button>
        </div>
        <div
            class=" border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2">

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
                                        Tahun
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Total Prediksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (count($forecastNext) !== 0)
                                    @for ($i = 0; $i < count($forecastNext['tahun']); $i++)
                                        <tr wire:click="selectProduk({{ $item }})"
                                            class="border-b border-gray-400/50 hover:bg-cyan-300 hover:cursor-pointer transitions">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $no + 1 }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $forecastNext['tahun'][$i] }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $forecastNext['forecast'][$i] }}
                                            </td>


                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            window.addEventListener('chart', event => {
                var charData = event.detail.data;


                let actual = [];
                let train = [];

                for (let i = 0; i < charData.tahun.length; i++) {
                    actual.push({
                        x: charData.tahun[i],
                        y: charData.penjualan[i]
                    })
                }


                const labels = charData.tahun
                const data = {
                    // labels: labels,
                    datasets: [{
                            label: 'Actual Data',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: actual
                        },

                    ]
                };


                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        maintainAspectRatio: false,

                    }
                };


                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            })
            window.addEventListener('chart2', event => {
                var charData = event.detail.data;
                // console.log(charData.tahun.slice(charData.tahun.length - 12));

                let actual = [];
                let train = [];
                let forecast = [];
                for (let i = 0; i < charData.tahun.length - 12; i++) {
                    actual.push({
                        x: charData.tahun[i],
                        y: charData.penjualan[i]
                    })
                }

                for (let i = 0; i < charData.tahun.slice(charData.tahun.length - 12).length; i++) {
                    train.push({
                        x: charData.tahun[charData.tahun.length - 12 + i],
                        y: charData.penjualan[charData.penjualan.length - 12 + i]
                    })
                }
                for (let i = 0; i < charData.tahun.slice(charData.tahun.length - 12).length; i++) {
                    forecast.push({
                        x: charData.tahun[charData.tahun.length - 12 + i],
                        y: charData.forecast[charData.forecast.length - 12 + i]
                    })
                }
                const data2 = {
                    // labels: labels,
                    datasets: [{
                            label: 'Actual',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: actual
                        },
                        {
                            label: 'Train',
                            backgroundColor: 'rgba(21, 255, 196, 0.697)',
                            borderColor: 'rgba(21, 255, 196, 0.697)',
                            data: train
                        },
                        {
                            label: 'Prediksi',
                            backgroundColor: 'rgba(255, 173, 21, 0.697)',
                            borderColor: 'rgba(255, 173, 21, 0.697)',
                            data: forecast
                        },
                    ]
                };


                const config2 = {
                    type: 'line',
                    data: data2,
                    options: {
                        maintainAspectRatio: false,

                    }
                };

                const myChart2 = new Chart(
                    document.getElementById('myChart2'),
                    config2
                );
            })
        </script>

        <script></script>
    @endpush
</div>
