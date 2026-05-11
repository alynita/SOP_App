<section>

    <header class="mb-3">

        <h5 class="fw-bold text-dark">
            Update Password
        </h5>

        <p class="text-muted small">
            Gunakan password yang kuat untuk menjaga keamanan akun.
        </p>

    </header>

    <form method="POST" action="{{ route('password.update') }}">

        @csrf
        @method('PUT')

        <!-- CURRENT PASSWORD -->
        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password"
                name="current_password"
                class="form-control"
                autocomplete="current-password">
        </div>

        <!-- NEW PASSWORD -->
        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password"
                name="password"
                class="form-control"
                autocomplete="new-password">
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password"
                name="password_confirmation"
                class="form-control"
                autocomplete="new-password">
        </div>

        <!-- BUTTON -->
        <button type="submit" class="btn btn-success">
            Save Password
        </button>

    </form>

</section>