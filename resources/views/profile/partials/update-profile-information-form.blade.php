<section>

    <header class="mb-3">

        <h5 class="fw-bold text-dark">
            Profile Information
        </h5>

        <p class="text-muted small">
            Update informasi akun dan email kamu.
        </p>

    </header>

    <!-- FORM EMAIL VERIFICATION -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- FORM UTAMA -->
    <form method="POST" action="{{ route('profile.update') }}">

        @csrf
        @method('PATCH')

        <!-- NAME -->
        <div class="mb-3">

            <label class="form-label">Name</label>

            <input type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="form-control"
                required
                autofocus>

        </div>

        <!-- EMAIL -->
        <div class="mb-3">

            <label class="form-label">Email</label>

            <input type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="form-control"
                required>

        </div>

        <!-- UNVERIFIED NOTICE -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="alert alert-warning">

                <p class="mb-2">
                    Email kamu belum terverifikasi.
                </p>

                <button form="send-verification" class="btn btn-link p-0">
                    Kirim ulang verifikasi email
                </button>

                @if (session('status') === 'verification-link-sent')
                    <div class="text-success mt-2">
                        Link verifikasi sudah dikirim.
                    </div>
                @endif

            </div>

        @endif

        <!-- BUTTON -->
        <button type="submit" class="btn btn-success">
            Save
        </button>

    </form>

</section>