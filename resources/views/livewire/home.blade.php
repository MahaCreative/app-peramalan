<div class="w-full">
    <div class="px-14 lg:px-28 flex items-center min-h-screen min-w-full ">
        <div class="w-[65%]">
            <h3 class="font-bold uppercase text-white lg:text-[30pt]">Allows you to better manage sales</h3>
            <p class="text-slate-400 lg:w-[70%] lg:text-[20pt]">web platform that helps you to predict the sales that
                will
                occur in
                the
                next period</p>
            <div class="flex gap-x-3 my-6">
                <button data_link='login'
                    class="btn transition-all ease-linear duration-300 hover:bg-opacity-70 border rounded-md py-2 px-4 bg-orange-500 text-white opacity-80 shadow-md
                 shadow-slate-300/50">Login</button>
                <button data_link='register'
                    class="btn transition-all ease-linear duration-300 hover:bg-opacity-70 border rounded-md py-2 px-4 w-52
                     bg-white opacity-80 shadow-md
                 shadow-slate-300/50">Register
                    Your Account</button>
            </div>
        </div>
        <div>
            <img class="md:flex hidden" src="{{ asset('images/download.png') }}" alt="">
        </div>
    </div>
    <div class="my-20 px-14 lg:px-28 flex items-center w-full justify-center">
        <div wire:ignore.self class="bg-white bg-opacity-80 py-3 px-4 rounded-md shadow-md shadow-slate-200/50 hidden"
            id="login">
            <div class="flex justify-center mb-10">
                <h3 class="font-light italic">Sign in to WebPredict</h3>
            </div>
            <form action="" class="flex flex-col gap-y-3" wire:submit.prevent="loginHandler">

                <input type="email" wire:model="email"
                    class="focus:outline-none focus:ring-1 focus:ring-blue-400 focus:shadow-blue-400 w-96 py-2 px-4 border-none rounded-md shadow-md shadow-slate-50"
                    placeholder="Email">
                @error('Email')
                    <p class="text-red-600 italic text-sm">{{ $message }}</p>
                @enderror
                <input type="password" wire:model="password"
                    class="focus:outline-none focus:ring-1 focus:ring-blue-400 focus:shadow-blue-400 w-96 py-2 px-4 border-none rounded-md shadow-md shadow-slate-50"
                    placeholder="password">
                @error('password')
                    <p class="text-red-600 italic text-sm">{{ $message }}</p>
                @enderror
                <input type="password" wire:model="password_confirmation"
                    class="focus:outline-none focus:ring-1 focus:ring-blue-400 focus:shadow-blue-400 w-96 py-2 px-4 border-none rounded-md shadow-md shadow-slate-50"
                    placeholder="confirm_password">
                @error('password_confirmation')
                    <p class="text-red-600 italic text-sm">{{ $message }}</p>
                @enderror
                <button
                    class="transition-all ease-linear duration-300 hover:bg-opacity-70 border rounded-md py-2 px-4 bg-orange-500 text-white opacity-80 shadow-md
                 shadow-slate-300/50">Sign
                    in</button>
            </form>
            <div class="flex gap-x-3 items-center">
                <p class="text-blue-500">Register on Web Predict</p>
                <button data_link='register'
                    class="btn transition-all my-2 ease-linear duration-300 text-blue-500 hover:text-white
                 shadow-slate-300/50">Sign
                    Up
                </button>
            </div>
        </div>
        <div wire:ignore.self class="bg-white bg-opacity-80 py-3 px-4 rounded-md shadow-md shadow-slate-200/50 hidden"
            id="register">
            <div class="flex justify-center mb-10">
                <h3 class="font-light italic">Sign up in to WebPredict</h3>
            </div>
            <form action="" class="flex flex-col gap-y-3" wire:submit.prevent="registerHandler">
                <input type="text" wire:model="username"
                    class="focus:outline-none focus:ring-1 focus:ring-blue-400 focus:shadow-blue-400 w-96 py-2 px-4 border-none rounded-md shadow-md shadow-slate-50"
                    placeholder="username">
                @error('username')
                    <p class="text-red-600 italic text-sm">{{ $message }}</p>
                @enderror
                <input type="email" wire:model="email"
                    class="focus:outline-none focus:ring-1 focus:ring-blue-400 focus:shadow-blue-400 w-96 py-2 px-4 border-none rounded-md shadow-md shadow-slate-50"
                    placeholder="Email">
                @error('Email')
                    <p class="text-red-600 italic text-sm">{{ $message }}</p>
                @enderror
                <input type="password" wire:model="password"
                    class="focus:outline-none focus:ring-1 focus:ring-blue-400 focus:shadow-blue-400 w-96 py-2 px-4 border-none rounded-md shadow-md shadow-slate-50"
                    placeholder="password">
                @error('password')
                    <p class="text-red-600 italic text-sm">{{ $message }}</p>
                @enderror
                <input type="password" wire:model="password_confirmation"
                    class="focus:outline-none focus:ring-1 focus:ring-blue-400 focus:shadow-blue-400 w-96 py-2 px-4 border-none rounded-md shadow-md shadow-slate-50"
                    placeholder="confirm_password">
                @error('password_confirmation')
                    <p class="text-red-600 italic text-sm">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="transition-all ease-linear duration-300 hover:bg-opacity-70 border rounded-md py-2 px-4 bg-orange-500 text-white opacity-80 shadow-md
                 shadow-slate-300/50">Sign
                    in</button>
            </form>
            <div class="flex gap-x-3 items-center">
                <p class="text-blue-500">Already have an account?</p>
                <button data_link='login'
                    class="btn transition-all my-2 ease-linear duration-300 text-blue-500 hover:text-white
                 shadow-slate-300/50">Login
                </button>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/scroll.js') }}"></script>
    @endpush
</div>
