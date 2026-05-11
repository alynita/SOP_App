<section class="space-y-3">

    <header>
        <h5 class="fw-bold text-dark">
            Delete Account
        </h5>

        <p class="text-muted small">
            Once your account is deleted, all data will be permanently removed.
        </p>
    </header>

    <!-- BUTTON TRIGGER -->
    <button type="button"
        class="btn btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#deleteModal">
        Delete Account
    </button>

    <!-- MODAL BOOTSTRAP -->
    <div class="modal fade" id="deleteModal" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <p class="text-dark">
                            Are you sure? This action cannot be undone.
                        </p>

                        <input type="password"
                            name="password"
                            class="form-control mt-2"
                            placeholder="Enter password">

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="btn btn-danger">
                            Delete
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>