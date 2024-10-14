@extends('layouts.app')

@section('content')
<style>
    .py-4 {
        background-color: white;
    }

    /* Card Style */
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        background-color: white;
        display: flex;
        flex-direction: row;
        height: 250px;
    }

    /* Gambar di dalam card */
    .card-img-top {
        padding: 10px;
        width: 180px;
        height: 250px;
        object-fit: cover;
        border-radius: 20px;

    }

    /* Lantai Style */
    .lantai {
        background-color: #001A72;
        font-size: 18px;
        color: white;
        padding: 8px;
        font-weight: 700;
        font-family: Montserrat, sans-serif;
    }

    /* Container dan Row */
    .container {
        max-width: 100%;
        padding: 0;
        background-color: white;
    }

    .row {
        margin: 0;
    }

    /* Isi card */
    .card-body {
        /* margin-top: 20px; */
        padding: 10px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Menempatkan tombol di bawah */
    }

    .card-buttons {
        margin-top: auto;
    }

    /* Layout Mobile */
    @media (max-width: 768px) {
        .card {
            flex-direction: column;
            /* Ubah card menjadi vertikal di mobile */
            height: auto;
        }

        .card-img-top {
            width: 100%;
            /* Gambar memenuhi lebar card */
            height: 200px;
            /* Tinggi gambar di mobile */
            border-bottom-left-radius: 0;
            /* Hilangkan radius bawah di mobile */
            border-top-right-radius: 5px;
            /* Beri radius pada bagian kanan atas */
        }

        .card-body {
            text-align: center;
            /* Teks di tengah */
        }

        .card-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 15px;
        }

        .card-buttons a {
            margin-bottom: 10px;
            width: 100%;
        }
        .card-title  {
        color: black !important; /* Ganti dengan warna yang diinginkan */
    }
   
    }
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

<div class="container">
    <h1 class="text-center">Ruangan</h1>

    @foreach($ruangan->groupBy('lantai') as $lantai => $ruangs)
    <div id="room-booking"></div>

    <div class="row">
        <div class="col-12 p-0">
            <h2 class="lantai px-4">Lantai {{ $lantai }}</h2>
        </div>
        @foreach($ruangs as $ruang)
        <div class="col-md-6 mb-6 p-3">
            <div class="card">
                <img src="{{ asset('storage/' . $ruang->gambar) }}" class="card-img-top"
                    alt="{{ $ruang->nama_ruangan }}">
                <div class="card-body">
                <a href="{{ route('event.ruangan.show', $ruang->id) }}" class=" text-decoration-none">
                    <h5 class="card-title fw-bold">{{ $ruang->nama_ruangan }}</h5>
                </a>                    
                
            <p class="card-text">
                        Kapasitas {{ $ruang->kapasitas }}<br>
                        Biaya Sewa <strong>{{ $ruang->biaya_sewa }}</strong>
                    </p>
                    <div class="card-buttons">
                        <a href="{{ route('event.ruangan.show', $ruang->id) }}" class="btn btn-primary">
                            Detail
                        </a>
                        @auth
                    <button class="btn btn-success" onclick="openModal('{{ $ruang->id }}')">Booking</button>
                    @endauth
                    @include('event.booking.modal.jadwal', ['ruang' => $ruang])
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

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
    window.location.href = './event/booking/create/{id}'; // Sesuaikan dengan URL route create kamu
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