<x-guest-layout>

<div class="min-h-screen bg-[#f6faf7] flex items-center justify-center px-6 py-10">

    <div class="w-full max-w-4xl">

        <!-- HEADER -->
        <div class="text-center mb-10">

            <img
                src="/logo.png"
                alt="Logo BBPK Jakarta"
                class="mx-auto h-48 object-contain mb-6"
            >

            <h1 style="
                font-size: 90px;
                font-weight: 900;
                line-height: 1;
                margin-bottom: 10px;
                background: linear-gradient(to right,#84cc16,#06b6d4);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            ">
                E-SOP
            </h1>

            <p class="text-lg text-gray-600">
                (Elektronik Standar Operasional Prosedur)
            </p>

        </div>

        <x-auth-session-status
            class="mb-4"
            :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- EMAIL -->
            <div class="mb-6">

                <label class="block text-xl font-medium text-gray-800 mb-2">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Masukkan Email"
                    class="w-full rounded-xl border border-gray-300 px-5 py-4 text-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                >

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />

            </div>

            <!-- PASSWORD -->
            <div class="mb-4">

                <label class="block text-xl font-medium text-gray-800 mb-2">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan Password"
                    class="w-full rounded-xl border border-gray-300 px-5 py-4 text-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                >

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />

            </div>

            <!-- REMEMBER -->
            <div class="flex justify-between items-center mb-8">

                <label class="flex items-center">

                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="mr-2 rounded"
                    >

                    <span class="text-gray-700">
                        Remember me
                    </span>

                </label>

                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="text-emerald-600 hover:underline"
                    >
                        Lupa Password?
                    </a>

                @endif

            </div>

            <!-- BUTTON -->
            <div class="text-center">

                <button
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold text-xl px-20 py-3 rounded-xl shadow-md"
                >
                    Login
                </button>

            </div>

            <!-- REGISTER -->
            @if (Route::has('register'))

            <div class="text-center mt-8 text-lg">

                Belum punya akun?

                <a
                    href="{{ route('register') }}"
                    class="font-bold text-emerald-600 hover:underline"
                >
                    Register
                </a>

            </div>

            @endif

        </form>

        <!-- FOOTER -->
        <div class="text-center mt-10 text-sm text-gray-500">

            © {{ date('Y') }}
            BBPK Jakarta - Elektronik Standar Operasional Prosedur

        </div>

    </div>

</div>

</x-guest-layout>