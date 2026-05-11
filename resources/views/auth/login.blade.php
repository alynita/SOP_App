<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-[#f6faf7] px-6">

    <!-- soft background glow -->
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-emerald-200/30 rounded-full blur-3xl"></div>

        <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] bg-teal-200/20 rounded-full blur-3xl"></div>

    </div>

    <!-- CARD -->
    <div class="relative w-full max-w-md">

        <div class="bg-white rounded-3xl shadow-xl border border-emerald-50 p-10">

            <!-- HEADER -->
            <div class="text-center mb-10">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-500 flex items-center justify-center shadow-md">

                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>

                </div>

                <h1 class="mt-4 text-2xl font-bold text-slate-800">
                    Sistem SOP Login
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Kementerian Kesehatan Digital System
                </p>

            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- EMAIL -->
                <div class="mb-5">

                    <x-input-label for="email" value="Email"
                        class="text-slate-600 text-sm mb-1" />

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email"
                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 placeholder-slate-400
                            focus:outline-none focus:ring-0 focus:border-emerald-500 focus:shadow-sm transition"
                    />

                </div>

                <!-- PASSWORD -->
                <div class="mb-4">

                    <x-input-label for="password" value="Password"
                        class="text-slate-600 text-sm mb-1" />

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 placeholder-slate-400
                            focus:outline-none focus:ring-0 focus:border-emerald-500 focus:shadow-sm transition"
                    />

                </div>

                <!-- REMEMBER -->
                <div class="flex items-center mb-8">

                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">

                    <label for="remember_me" class="ml-2 text-sm text-slate-600">
                        Remember me
                    </label>

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold shadow-md transition-all duration-300"
                >
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>