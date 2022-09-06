<div class="ml-4">
    @component('components.snippets.modals',
        ['title' => $titleModal, 'idModals' => 'modalsLarge', 'sizeModals' => $sizeModal])
        <form action="" wire:submit.prevent="submitHandler" class="w-full">
            <div class="">
                <label for="">Kode Produk</label>
                <input disabled wire:model="kode_barang" type="text" name="" id=""
                    class="form-control w-full">
                @error('kode_barang')
                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="">
                <label for="">Nama Produk</label>
                <input disabled wire:model="nama_barang" type="text" name="" id=""
                    class="form-control w-full">
                @error('nama_barang')
                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="">
                <label for="">File Excel</label>
                <input wire:model="file" type="file" name="" id="" class="form-control w-full">
                @error('file')
                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="button hover:bg-orange-500 hover:text-white">Submit</button>
        </form>
    @endcomponent
    <div class=" border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2">
        <div class="flex gap-x-2 px-4 py-2 border-b-4 border-orange-500 w-full items-center ">
            <div class="flex items-center gap-x-2">
                <a href="">
                    <i
                        class="bi bi-house-door-fill text-orange-500 text-[16pt] p-1 shadow-md shadow-gray-400/50 border"></i>
                </a>
                <a href="" class="text-[16pt] hover:text-orange-400 transitions">
                    Dashboard
                </a>
                <a href="" class="text-[16pt] hover:text-orange-400 transitions">
                    / Data Penjualan
                </a>
            </div>
        </div>
        <div class="flex lg:flex-row flex-col justify-between gap-y-2 my-2">
            <div class="flex gap-x-2">

                <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Import
                    Penjualan</button>
                <button type="button" wire:click='trainData'
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Train
                    Data</button>
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
                                        Tahun
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Jan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Feb
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Mar
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Apr
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Mei
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Jun
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Jul
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Agus
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Sep
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Oct
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Nov
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Dec
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataBarang->detail_penjualan as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->tahun_penjualan }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->jan }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->feb }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->mar }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->apr }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->mei }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->jun }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->jul }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->agu }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->sep }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->oct }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->nov }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->dec }}</p>
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
    <div class="grid  lg:grid-cols-2 gap-x-2 h-96 {{ $showGraph ? '' : 'hidden' }}">
        <div
            class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2">
            <canvas id="myChart"></canvas>
        </div>
        <div
            class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2">
            <canvas id="myChart2"></canvas>
        </div>

    </div>
    <div
        class="border {{ $showGraph ? '' : 'hidden' }}  lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 mx-2 h-[300px]">
        <canvas id="myChart3"></canvas>
    </div>
    @push('scripts')
        <script>
            window.addEventListener('chart', event => {
                var charData = event.detail.data;

                console.log(charData);
                let actual = [];
                let train = [];
                let seasonal = [];
                let forecast = [];
                for (let i = 0; i < charData.tahun.length; i++) {
                    actual.push({
                        x: charData.tahun[i],
                        y: charData.penjualan[i]
                    })
                }
                for (let i = 0; i < charData.tahun.length; i++) {
                    forecast.push({
                        x: charData.tahun[12 + i],
                        y: charData.forecast[i]
                    })
                }
                for (let i = 0; i < charData.tahun.length; i++) {
                    train.push({
                        x: charData.tahun[12 + i],
                        y: charData.level[i]
                    })
                }
                for (let i = 0; i < charData.tahun.length; i++) {
                    seasonal.push({
                        x: charData.tahun[12 + i],
                        y: charData.seasonal[i]
                    })
                }
                console.log(seasonal);
                const labels = charData.tahun
                const data = {
                    // labels: labels,
                    datasets: [{
                            label: 'Actual Data',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: actual
                        },
                        {
                            label: 'Level',
                            backgroundColor: 'rgb(25, 99, 132)',
                            borderColor: 'rgb(25, 99, 132)',
                            data: train
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


                const data2 = {
                    // labels: labels,
                    datasets: [{
                        label: 'Seasonal',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: seasonal
                    }, ]
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

                const data3 = {
                    // labels: labels,
                    datasets: [{
                            label: 'Actual',
                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: actual
                        },
                        {
                            label: 'Train',
                            backgroundColor: 'rgba(21, 255, 196, 0.697)',
                            borderColor: 'rgba(21, 255, 196, 0.697)',
                            data: forecast
                        },
                    ]
                };


                const config3 = {
                    type: 'line',
                    data: data3,
                    options: {


                    }
                };

                const myChart3 = new Chart(
                    document.getElementById('myChart3'),
                    config3
                );

            })
        </script>

        <script></script>
    @endpush
</div>
