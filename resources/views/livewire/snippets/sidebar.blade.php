<div class="bg-slate-900 transitions w-24 md:w-40 lg:w-72 py-5 min-h-screen fixed px-5 shadow-md shadow-gray-400">
    <div class="flex justify-center my-4">
        <div class="bg-slate-100 p-2 rounded-full border-4 border-red-500 overflow-hidden">
            <img class="w-24 transitions hover:scale-110 hover:cursor-pointer" src="{{ asset('OIP.jfif') }}"
                alt="">
        </div>
    </div>
    <div class="lg:flex justify-center w-full text-white italic font-semibold text-lg hidden">
        <p class="">Predict Youre Sales</p>
    </div>
    <div>
        <ul class="flex flex-col gap-y-1 ">
            <li class="w-full px-2 py-1 hover:cursor-pointer transitions text-white  bg-orange-500 hover:bg-orange-600 ">
                <a href="" class="flex gap-x-2"><span
                        class="flex justify-center items-center w-full lg:w-4 lg:block">a</span>
                    <span class="hidden lg:block">Dashboard</span></a>
            </li>
            <li
                class="w-full px-2 py-1 hover:cursor-pointer transitions text-white  bg-orange-500 hover:bg-orange-600 ">
                <a href="{{ route('data-barang') }}" class="flex gap-x-2"><span
                        class="flex justify-center items-center w-full lg:w-4 lg:block">a</span>
                    <span class="hidden lg:block">Data Barang</span></a>
            </li>
            <li
                class="w-full px-2 py-1 hover:cursor-pointer transitions text-white  bg-orange-500 hover:bg-orange-600 ">
                <a href="{{ route('prediksi-penjualan') }}" class="flex gap-x-2"><span
                        class="flex justify-center items-center w-full lg:w-4 lg:block">a</span>
                    <span class="hidden lg:block">Prediksi Penjualan</span></a>
            </li>

        </ul>
    </div>
</div>
