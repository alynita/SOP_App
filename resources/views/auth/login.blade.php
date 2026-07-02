<x-guest-layout>

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

.login-wrapper {
    height: 100vh;        
    display: flex;
    overflow: hidden;     
}

.login-left {
    width: 50%;
    position: relative;
    flex-shrink: 0;       
}

.login-left img.bg-photo {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.login-left .overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.15) 60%, transparent 100%);
}

.login-left .caption {
    position: absolute;
    bottom: 40px;
    left: 40px;
    right: 40px;
    color: white;
}

.login-left .caption h2 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 4px;
}

.login-left .caption p {
    font-size: 16px;
    opacity: 0.8;
}

.login-right {
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px 32px;
    background: #fff;
    overflow-y: auto;     
}

.login-box {
    width: 100%;
    max-width: 420px;
}

.login-box .brand {
    text-align: center;
    margin-bottom: 36px;
}

.login-box .brand img {
    height: 90px;
    object-fit: contain;
    margin-bottom: 16px;
}

.login-box .brand h1 {
    font-size: 56px;
    font-weight: 900;
    line-height: 1;
    margin-bottom: 8px;
    white-space: nowrap;  
    background: linear-gradient(to right, #16a34a, #0891b2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.login-box .brand p {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.6;
}

.login-box label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
}

.login-box input[type="email"],
.login-box input[type="password"] {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 14px;
    margin-bottom: 16px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.login-box input[type="email"]:focus,
.login-box input[type="password"]:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22,163,74,0.15);
}

.login-box .row-remember {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.login-box .row-remember label {
    display: flex;
    align-items: center;
    font-weight: 400;
    font-size: 13px;
    color: #4b5563;
    margin: 0;
    cursor: pointer;
}

.login-box .row-remember input[type="checkbox"] {
    width: 16px !important;
    height: 16px !important;
    margin-right: 8px !important;
    margin-bottom: 0 !important;
    accent-color: #16a34a;
    flex-shrink: 0;
}

.login-box .row-remember a {
    font-size: 13px;
    color: #16a34a;
    text-decoration: none;
}

.login-box .row-remember a:hover {
    text-decoration: underline;
}

.login-box .btn-login {
    width: 100%;
    background: #16a34a;
    color: white;
    font-weight: 700;
    font-size: 15px;
    padding: 13px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(22,163,74,0.3);
    transition: background 0.2s;
}

.login-box .btn-login:hover {
    background: #15803d;
}

.login-box .footer {
    text-align: center;
    font-size: 11px;
    color: #9ca3af;
    margin-top: 32px;
}

@media (max-width: 768px) {
    .login-left { display: none; }
    .login-right { width: 100%; }
}
</style>

<div class="login-wrapper">

    {{-- KIRI: FOTO GEDUNG --}}
    <div class="login-left">

        <img
            class="bg-photo"
            src="/gedung-bbpk.jpg"
            alt="Gedung BBPK Jakarta"
        >

        <div class="overlay"></div>

        <div class="caption">
            <h2>Balai Besar Pelatihan Kesehatan</h2>
            <p>Jakarta</p>
        </div>

    </div>

    {{-- KANAN: FORM LOGIN --}}
    <div class="login-right">

        <div class="login-box">

            {{-- BRAND --}}
            <div class="brand">

                <img src="/logo login.png" alt="Logo BBPK">

                <h1>E-SOP</h1>

                <p>
                    Elektronik Standar Operasional Prosedur <br>
                    Balai Besar Pelatihan Kesehatan Jakarta
                </p>

            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">

                @csrf

                {{-- EMAIL --}}
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Masukkan Email"
                >
                <x-input-error :messages="$errors->get('email')" class="mt-1" />

                {{-- PASSWORD --}}
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan Password"
                >
                <x-input-error :messages="$errors->get('password')" class="mt-1" />

                {{-- REMEMBER + LUPA PASSWORD --}}
                <div class="row-remember">

                    <label>
                        <input type="checkbox" name="remember" id="remember_me">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif

                </div>

                <button type="submit" class="btn-login">
                    Login
                </button>

            </form>

            <p class="footer">
                © {{ date('Y') }} BBPK Jakarta — E-SOP
            </p>

        </div>

    </div>

</div>

</x-guest-layout>