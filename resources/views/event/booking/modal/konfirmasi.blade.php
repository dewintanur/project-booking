<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Permintaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengirim permintaan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="confirmSubmit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Konfirmasi Pengajuan -->
<script>
     document.addEventListener('DOMContentLoaded', function () {
            const confirmButton = document.getElementById('confirmSubmit');
            const modalConfirmButton = document.getElementById('modalConfirmButton');

            // Tampilkan modal saat tombol kirim diklik
            confirmButton.addEventListener('click', function () {
                const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmationModal.show();
            });

            // Kirim data saat konfirmasi di modal
            modalConfirmButton.addEventListener('click', function () {
                document.getElementById('booking-form').submit(); // Kirim form
                window.location.href = "{{ route('event.booking.history') }}"; // Arahkan ke halaman riwayat
            });
        });
</script>

