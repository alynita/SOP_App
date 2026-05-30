<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-[#f6faf7] px-6 py-10 overflow-hidden">

    <!-- BACKGROUND -->
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute -top-32 -left-32 w-[500px] h-[500px]
            bg-emerald-200/30 rounded-full blur-3xl">
        </div>

        <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px]
            bg-teal-200/20 rounded-full blur-3xl">
        </div>

    </div>

    <!-- CARD -->
    <div class="relative w-full max-w-xl">

        <div class="bg-white rounded-3xl shadow-2xl
            border border-emerald-100
            px-10 py-10">

            <!-- HEADER -->
            <div class="text-center mb-10">

                <!-- LOGO -->
                <div class="mb-5">

                    <img src="/logo.png"
                        class="h-14 mx-auto object-contain">

                </div>

                <!-- TITLE -->
                <h1 class="text-3xl font-bold text-slate-800">
                    Sistem SOP
                </h1>

                <p class="text-slate-500 mt-2">
                    Kementerian Kesehatan Republik Indonesia
                </p>

                <p class="text-sm text-slate-400 mt-1">
                    Digital SOP Management System
                </p>

            </div>

            <!-- SESSION -->
            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- EMAIL -->
                <div class="mb-6">

                    <x-input-label
                        for="email"
                        value="Email"
                        class="text-slate-700 mb-2"
                    />

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="Masukkan email"
                        class="block w-full rounded-xl
                        border border-slate-200
                        px-5 py-3.5
                        text-slate-800
                        placeholder-slate-400
                        focus:border-emerald-500
                        focus:ring-emerald-500"
                    />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2"
                    />

                </div>

                <!-- PASSWORD -->
                <div class="mb-5">

                    <x-input-label
                        for="password"
                        value="Password"
                        class="text-slate-700 mb-2"
                    />

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="Masukkan password"
                        class="block w-full rounded-xl
                        border border-slate-200
                        px-5 py-3.5
                        text-slate-800
                        placeholder-slate-400
                        focus:border-emerald-500
                        focus:ring-emerald-500"
                    />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />

                </div>

                <!-- REMEMBER -->
                <div class="flex items-center justify-between mb-8">

                    <label class="flex items-center">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-300
                            text-emerald-600
                            focus:ring-emerald-500"
                        >

                        <span class="ml-2 text-sm text-slate-600">
                            Remember me
                        </span>

                    </label>

                    <!-- FORGOT -->
                    @if (Route::has('password.request'))

                        <a href="{{ route('password.request') }}"
                            class="text-sm text-emerald-600 hover:underline">

                            Lupa Password?

                        </a>

                    @endif

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full py-3.5 text-base rounded-xl
                    bg-emerald-600 hover:bg-emerald-700
                    text-white font-semibold
                    shadow-lg transition-all duration-300"
                >
                    Login
                </button>

                <!-- REGISTER -->
                @if (Route::has('register'))

                <div class="text-center mt-6 text-sm text-slate-600">

                    Belum punya akun?

                    <a href="{{ route('register') }}"
                        class="text-emerald-600 font-semibold hover:underline">

                        Register

                    </a>

                </div>

                @endif

            </form>

            <!-- FOOTER -->
            <div class="text-center text-xs text-slate-400
                mt-10 border-t pt-5">

                © {{ date('Y') }}
                BBPK Jakarta - Sistem SOP Digital

            </div>

        </div>

    </div>

</div>

</x-guest-layout>