@extends('layouts.app')
@section('content')

<div class="container">
    <div class="text-center">
        <h1>Booking Ruangan</h1>
    </div>
    <div class="">
        <div class="form-event ">
            <div class="card shadow border-0 mb-3">
                <div class="card-body p-5">
                    <h4>Data Ruangan</h4>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong id="ruang-nama" name="ruangan"></strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p id="ruang-lantai" >Lantai: </p>
                                    <p id="ruang-biaya">Biaya Sewa: <strong>Gratis</strong></p>
                                    <p id="fasilitas">Fasilitas:</p>
                                    <ul>
                                        <li>Akses Ramp Samping</li>
                                    </ul>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Booking</th>
                                                <th>Jam Booking</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="booking-table-body">
                                            <!-- Booking data will be appended here -->
                                        </tbody>
                                    </table>
                                    <button class="btn btn-success" onclick="openBookingModal()">Booking Tanggal
                                        Lainnya</button> <br>
                                    <hr>
                                    <button class="btn btn-secondary">Hapus Ruangan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-secondary">Booking Ruangan Lainnya</button>
        </div>
        <div class="form-event p-2">
            <div class="card shadow border-0">
                <div class="card-body p-5">
<form action="{{ route('event.booking.store') }}" method="POST" id="booking-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-title mb-3">
                            <h4 class="text-start">Data Event </h4>
                        </div>
                        <div class="row gx-5">
                            <div class="col-12 col-lg-7">
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="nama_event">Nama Event
                                        <span class="text-danger"><small>*</small></span>
                                    </label>
                                    <input placeholder="Nama Event" type="text" name="nama_event" id="nama_event"
                                        class="form-control mb-2" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="kategori_event">Kategori Event
                                        <span class="text-danger"><small>*</small></span>
                                    </label>
                                    <select placeholder="event" type="text" name="kategori_event" id="event"
                                        class="form-select mb-2" required>
                                        <option class="bg-white" value="">Pilih Kategori</option>
                                        <option class="bg-white" value="1">Dinas</option>
                                        <option class="bg-white" value="2">Kampus</option>
                                        <option class="bg-white" value="3">Komersial</option>
                                        <option class="bg-white" value="4">Komunitas</option>
                                        <option class="bg-white" value="5">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="kategori_ekraf">Kategori Ekraf
                                        <span class="text-danger"><small>*</small></span>
                                    </label>
                                    <select placeholder="ekraf" type="text" name="kategori_ekraf" id="ekraf"
                                        class="form-select mb-2" required>
                                        <option class="bg-white" value="">Pilih Kategori Ekraf</option>
                                        <option class="bg-white" value="1">DKV</option>
                                        <option class="bg-white" value="2">Aplikasi</option>
                                        <option class="bg-white" value="3">Arsitektur</option>
                                        <option class="bg-white" value="4">Desain Interior</option>

                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="deskripsi_event">Deskripsi Event
                                        <span class="text-danger"><small>*</small></span>
                                    </label>
                                    <textarea type="text" name="deskirpsi_event" id="deskripsi"
                                        class="form-control mb-2" required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="deskripsi_event">Peralatan yang digunakan</label>
                                    <textarea type="text" name="fasilitas" id="alat"
                                        class="form-control mb-2"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="jumlah">Jumlah Peserta</label>
                                    <input placeholder="0" type="number" name="jumlah_peserta" id="jumlah"
                                        class="form-control mb-2">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="nama_pic">Nama PIC Penyelenggara
                                        <span class="text-danger"><small>*</small></span>
                                    </label>
                                    <input placeholder="" type="text" name="nama_pic" id="nama_pic"
                                        class="form-control mb-2" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="telpon">Nomer Telepon PIC Penyelenggara
                                        <span class="text-danger"><small>*</small></span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">+62</div>
                                        </div>
                                        <input placeholder="8341..." type="number" name="no_pic" id="telpon"
                                            class="form-control mb-2">
                                    </div>

                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-bold pb-2" for="kategori_ekraf">Jenis Event
                                        <span class="text-danger"><small>*</small></span>
                                    </label>
                                    <select placeholder="" type="text" name="jenis_event" id="jenis"
                                        class="form-select mb-2" required>
                                        <option class="bg-white" value="">Pilih Jenis Event</option>
                                        <option class="bg-white" value="">Terbatas</option>
                                        <option class="bg-white" value="">Terbuka untuk Umum</option>
                                        <option class="bg-white" value="">Internal</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="proposal_caption" class="form-label fw-bold pb-2">Proposal
                                        Event</label>
                                    <label for="proposal" class="cursor-pointer w-100">
                                        <div id="proposal_image"
                                            class="w-100 d-flex justify-content-center align-items-center"
                                            style="border-radius: 24px; border: 1px solid #629EF5; min-height: 150px; background: url(https://event.mcc.or.id/assets/images/upload.svg) no-repeat center center;">
                                            <input name="proposal" id="proposal" class="d-none" accept=".pdf,.doc,.docx"
                                                type="file">
                                        </div>
                                    </label>
                                    <div class="form-text">Maksimal ukuran file dokumen 2Mb dengan ekstensi file
                                        (*.pdf)</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5">
                                <div class="form-group mb-3">
                                    <label for="banner_caption" class="form-label fw-bold pb-2">Banner Poster
                                        Event</label>
                                    <label for="banner" class="cursor-pointer w-100">
                                        <div id="banner_image" class="w-100"
                                            style="border-radius: 24px; border: 1px solid #629EF5; height: 400px; background: url(https://event.mcc.or.id/assets/images/upload.svg) no-repeat center center;">
                                            <input name="banner" id="banner" class="d-none" accept=".jpg,.png,.jpeg"
                                                type="file">
                                        </div>
                                    </label>
                                    <div class="form-text">Maksimal ukuran file dokumen 2Mb dengan ekstensi file
                                        (*.jpg, *.jpeg, *.png)</div>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreeTerms"
                                    onclick="toggleModal()" />
                                <label class="form-check-label" for="agreeTerms">Saya telah membaca dan menyetujui
                                    syarat dan ketentuan.</label>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="syaratKetentuanModal" tabindex="-1"
                                aria-labelledby="syaratKetentuanModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="syaratKetentuanModalLabel">Syarat dan Ketentuan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <ol class="mb-3">
                                                    <li>Penyelenggara bisa menggunakan Ruangan di Gedung MCC dan
                                                        melakukan publikasi setelah menerima Surat Konfirmasi dari
                                                        Building Management MCC.</li>
                                                    <li>Penggunaan Ruangan Empowerment/Pemberdayaan di Gedung MCC tidak
                                                        dipungut biaya/gratis.</li>
                                                    <li>Acara yang diselenggarakan tidak boleh mengandung atau membawa
                                                        isu SARA, politik dan kekerasan.</li>
                                                    <li>Penyelenggara <strong>wajib</strong> memberikan data atau
                                                        informasi yang sebenar-benarnya mengenai kegiatan yang akan
                                                        dilaksanakan.</li>
                                                    <li>Setiap penyelenggara <strong>wajib</strong> melakukan proses
                                                        Check-in dan Check-out di meja Customer Service Lantai 2. Pada
                                                        saat proses Check-in setiap penyelenggara <strong>wajib</strong>
                                                        memberikan kartu identitas / ID-Card dan akan diserahkan kembali
                                                        saat proses Check-out.</li>
                                                    <li>Setiap penyelenggara <strong>wajib</strong> membuat form data
                                                        peserta/pengunjung yang hadir (nama, telp, alamat &amp; email)
                                                        dan diserahkan ke Customer Service pada saat proses Check-out.
                                                    </li>
                                                    <li>Penggunaan Ruangan maksimal pada pukul 21.00 WIB. Lebih dari jam
                                                        tersebut Manajemen berhak untuk menghentikan acara.</li>
                                                    <li>Menjaga fasilitas, sarana, dan prasarana yang tersedia dalam
                                                        Ruangan/Gedung MCC.</li>
                                                    <li>Melengkapi sendiri kebutuhan yang tidak tersedia/kurang seperti
                                                        kabel roll, alat tulis, kursi, meja, level stage, dekorasi, dll.
                                                    </li>
                                                    <li>Peminjaman peralatan yang ada di ruangan harus atas seijin
                                                        Building Management MCC.</li>
                                                    <li>Menjaga ketertiban, kebersihan dan keamanan penyelenggaraan
                                                        acara.</li>
                                                    <li>Dilarang menempel, memaku benda apapun pada dinding
                                                        Ruangan/Gedung MCC.</li>
                                                    <li>Dilarang memasang atribut Partai Politik, atau Ormas Keagamaan
                                                        yang berbau politik di Ruangan/Gedung MCC.</li>
                                                    <li>Loading in barang dilakukan pada H-1 Jam 22.00 - 06.00 WIB.</li>
                                                    <li>Loading out barang dilakukan di hari yang sama setelah rundown
                                                        acara selesai.</li>
                                                    <li>Jika proses loading out melebihi batas waktu yang ditentukan,
                                                        Manajemen MCC berhak memindahkan properti dan tidak bertanggung
                                                        jawab atas kerusakan properti.</li>
                                                    <li>Ruangan yang sudah selesai digunakan serta peralatannya
                                                        <strong>wajib</strong> dikembalikan pada posisi semula dan
                                                        memberikan konfirmasi ke Customer Service pada saat Check-out.
                                                    </li>
                                                    <li>Mengumpulkan sampah pada titik/tempat sampah yang tersedia.
                                                        Petugas Kebersihan MCC akan melakukan pembuangan sampah yang
                                                        telah terkumpul.</li>
                                                    <li>Pembatalan/Cancelation dilakukan maksimal pada H-2.</li>
                                                    <li>Apabila ditemukan pelanggaran pada poin-poin Syarat dan
                                                        Ketentuan ini, maka Manajemen MCC berhak untuk menjatuhkan
                                                        sanksi kepada Penyelenggara.</li>
                                                </ol>
                                            </div>
                                            <div class="signature_area">
                                                <div class="d-flex align-items-start">
                                                    <canvas id="signature_canvas" class="border me-3" style="touch-action: none;"></canvas>
                                                    <button type="button" class="button clear" data-action="signature-clear">Clear</button>
                                                </div>
                                                <div class="form-text">Silahkan, tanda tangan di atas</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="confirmAgreement()">Setuju</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button" id="btn-booking-confirm"
                                    class="btn btn-lg btn-primary fw-bold fs-5" data-bs-toggle="modal"
                                    data-bs-target="#confirmationModal">
                                    Konfirmasi Permintaan
                                </button>
                            </div>
                            @include('event/booking/modal/konfirmasi') <!-- Pastikan path sesuai dengan struktur folder Anda -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <script>
       
          document.addEventListener('DOMContentLoaded', function () {
        const confirmButton = document.getElementById('confirmSubmit');
        if (confirmButton) {
            confirmButton.addEventListener('click', function () {
                console.log('Kirim button clicked'); // Log when the button is clicked
                // Alihkan pengguna ke halaman riwayat booking
                console.log('Sebelum pindah halaman');
                window.location.href = "{{ route('event.booking.history') }}";
                console.log('Setelah pindah halaman'); // Periksa apakah ini muncul di console

            });
        } else {
            console.error('confirmSubmit button not found'); // Log an error if the button is not found
        }
    }); 
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookingData = JSON.parse(sessionStorage.getItem('bookingData'));

            if (bookingData) {
                document.getElementById('ruang-nama').innerText = bookingData.ruangName; // Nama Ruangan
                document.getElementById('ruang-lantai').innerText = 'Lantai: ' + bookingData.lantai; // Lantai
                document.getElementById('ruang-biaya').innerText = 'Biaya Sewa: ' + bookingData
                .biaya; // Biaya Sewa

                // Populasi tabel dengan data booking
                const bookingTableBody = document.getElementById('booking-table-body');
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${bookingData.date}</td>
            <td>${bookingData.times.join(', ')}</td>
            <td>
                <button class="btn btn-danger btn-sm">Hapus</button>
                <button class="btn btn-secondary btn-sm">Edit</button>
            </td>
        `;
                bookingTableBody.appendChild(row);
            }
        });

        function toggleModal() {
            const checkbox = document.getElementById('agreeTerms');
            const modal = new bootstrap.Modal(document.getElementById('syaratKetentuanModal'));

            if (checkbox.checked) {
                modal.show(); // Tampilkan modal jika checkbox dicentang
            } else {
                modal.hide(); // Sembunyikan modal jika checkbox tidak dicentang
            }
        }

        function confirmAgreement() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('syaratKetentuanModal'));

            // Hapus pengecekan tanda tangan
            alert("Anda telah menyetujui syarat dan ketentuan.");
            modal.hide(); // Tutup modal setelah menyetujui

            // Di sini, kamu bisa menambahkan logika untuk melanjutkan proses booking
        }

       
    document.addEventListener('DOMContentLoaded', function () {
            var canvas = document.getElementById('signature-pad');
            if (canvas) {
                var signaturePad = new SignaturePad(canvas);
                console.log("Signature Pad initialized successfully!");
            } else {
                console.error('Canvas for Signature Pad not found!');
            }
        });
    </script>
    @section('scripts')
    <!-- Load Signature Pad Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/3.0.2/signature_pad.umd.min.js"></script>

    @endsection
