@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 100%;
        background-color: white;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        padding: 20px;
        margin: 20px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: white;
    }

    .card-img-top {
        width: 100%;
        max-width: 800px; /* Batasi lebar gambar */
        height: 50%;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .card-body {
        text-align: center;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .btn-booking {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
    .info-section {
        text-align: left;
        font-size: 16px;
        margin-top: 30px;
        padding-left: 15px;
    }


    .btn {
        padding: 10px 20px;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .card-img-top {
            width: 100%;
        }
    }
</style>

<div class="container">
    <div class="card">
    <h1 class="card-title">{{ $ruang->nama_ruangan }}</h1>
        <img src="{{ asset('storage/' . $ruang->gambar) }}" class="card-img-top" alt="{{ $ruang->nama_ruangan }}">

        <div class="card-body">
            <!-- Deskripsi Ruangan -->
            <p class="card-text">{{ $ruang->detail_ruangan }}</p>

            <!-- Informasi Ruangan -->
            <div class="info-section">
                <h2>Informasi Ruangan</h2>
                <ul class="list-unstyled">
                    <li>Lantai: <strong>{{ $ruang->lantai }}</strong></li>
                    <li>Ukuran: <strong>{{ $ruang->ukuran ?? '-' }}</strong></li>
                    <li>Kapasitas: <strong>{{ $ruang->kapasitas }} orang</strong></li>
                    <li>PIC: <strong>Contact Marketing</strong></li>
                    <li>Harga Sewa: <strong>{{ $ruang->biaya_sewa == 0 ? 'Gratis' : $ruang->biaya_sewa }}</strong></li>
                </ul>
            </div>

            <!-- Fasilitas Ruangan -->
            <div class="info-section">
                <strong>Fasilitas</strong>
                <p>{{ $ruang->fasilitas }}</p>
            </div>

            <!-- Tombol Booking -->
            <div class="btn-booking">
                @auth
                <button class="btn btn-success" onclick="openModal('{{ $ruang->id }}')">Booking</button>
                @endauth
                @include('event.booking.modal.jadwal', ['ruang' => $ruang])

            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal
    function openModal(ruangId) {
        document.getElementById(`modal${ruangId}`).style.display = "flex";
        
        // Inisialisasi Flatpickr inline
        flatpickr(`#date${ruangId}`, {
            dateFormat: "Y-m-d",
            inline: true,
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                document.getElementById(`date${ruangId}`).value = dateStr; // Simpan tanggal yang dipilih
            }
        });
    }

    // Fungsi untuk menutup modal
    function closeModal(ruangId) {
        document.getElementById(`modal${ruangId}`).style.display = "none";
    }
    function handleBooking(ruangId) {
    const ruangName = document.getElementById(`ruang-name${ruangId}`).innerText;
    const lantai = document.getElementById(`lantai${ruangId}`).innerText;
    const fasilitas = document.getElementById(`fasilitas${ruangId}`).innerText;
    
    const tanggal = document.getElementById(`date${ruangId}`).value;
    const waktuChecked = document.querySelectorAll(`input[name="time${ruangId}[]"]:checked`);
    const waktu = Array.from(waktuChecked).map(input => input.value);

    if (!tanggal || waktu.length === 0) {
        alert("Silakan pilih tanggal dan waktu.");
        return;
    }

    // Log data yang akan disimpan
    console.log({
        ruangName,
        lantai,
        fasilitas,
        date: tanggal,
        times: waktu,
        biaya: 'Gratis' // Ganti sesuai biaya sewa ruangan
    });

    // Simpan data ke session storage
    sessionStorage.setItem('bookingData', JSON.stringify({
        ruangName: ruangName,
        lantai: lantai,
        fasilitas: fasilitas,
        date: tanggal,
        times: waktu,
        biaya: 'Gratis' // Ganti sesuai biaya sewa ruangan
    }));

    // Redirect ke halaman create
    window.location.href = '../booking/create/{id}'; // Sesuaikan dengan URL route create kamu
}


    // // Fungsi untuk menyimpan booking menggunakan AJAX
    // function handleBooking(ruangId) {
    //     const selectedDate = document.getElementById(`date${ruangId}`).value;
    //     const checkedTimes = Array.from(document.querySelectorAll(`input[name="time${ruangId}[]"]:checked`)).map(checkbox => checkbox.value);

    //     if (!selectedDate) {
    //         alert("Harap pilih tanggal terlebih dahulu.");
    //         return;
    //     }

    //     if (checkedTimes.length === 0) {
    //         alert("Harap pilih setidaknya satu jam.");
    //         return;
    //     }

    //     const bookingData = {
    //         ruang_id: ruangId,
    //         tanggal: selectedDate,
    //         jam: checkedTimes
    //     };

    //     $.ajax({
    //         url: '{{ route("event.booking.store") }}',
    //         type: 'POST',
    //         data: bookingData,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
    //             alert('Booking berhasil disimpan!');
    //             closeModal(ruangId);
    //         },
    //         error: function(xhr) {
    //             alert('Gagal menyimpan booking: ' + xhr.responseText);
    //         }
    //     });
    // }
</script>
@endsection
