<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Data</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: darkblue;
                font-size: 14px;
            }
            .form-container {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-top: 40px;
                margin-bottom: 20px;
                font-size: 14px;
            }
            .bottom-image {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                height: auto;
                z-index: -1; /* Menempatkan gambar di belakang form */

            }
            .image-preview img {
                max-width: 100%;
                height: auto;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="container d-flex justify-content-center">
           

            <form action="/osiker/submit" method="POST" enctype="multipart/form-data" class="form-container col-md-6">
                @csrf

                <div class="text-center mb-4">
                    <img alt="Logo" src="https://osiker.com/assets/_logo/logo-sticky.png" class="img-fluid">
                </div>

                <div class="mb-3 row">
                    <label for="logo" class="col-sm-3 col-form-label">Logo:</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event)">
                        <div class="image-preview mt-2" id="imagePreview"></div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label">Nama:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-sm-3 col-form-label">Nomor Telepon:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" pattern="\d{12}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                        <small class="text-muted">Nomor telepon harus tepat 12 digit angka.</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="kategori" class="col-sm-3 col-form-label">Kategori:</label>
                    <div class="col-sm-9">
                        <select name="kategori_id" id="kategori" class="form-select ">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="subsektor" class="col-sm-3 col-form-label">Subsektor:</label>
                    <div class="col-sm-9">
                        <select name="subsektor_id" id="subsektor" class="form-select ">
                            <option value="" disabled selected>Pilih Subsektor</option>
                            @foreach($subsektor as $item)
                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="kota" class="col-sm-3 col-form-label">Kota:</label>
                    <div class="col-sm-9">
                    <select name="kota_id" id="kota_id" class="form-select">
                        <option value="" disabled selected>Pilih Kota</option>
                        @foreach($kota as $item)
                            <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan:</label>
                    <div class="col-sm-9">
                        <select name="kecamatan_id" id="kecamatan" class="form-select ">
                            <option value="" disabled selected>Pilih Kecamatan</option>
                            @foreach($kecamatan as $item)
                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="website" class="col-sm-3 col-form-label">Website:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}" placeholder="Website URL">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="facebook" class="col-sm-3 col-form-label">Facebook:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook') }}" placeholder="Facebook URL">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="instagram" class="col-sm-3 col-form-label">Instagram:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram') }}" placeholder="Instagram URL">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tiktok" class="col-sm-3 col-form-label">TikTok:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tiktok" name="tiktok" value="{{ old('tiktok') }}" placeholder="TikTok URL">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="youtube" class="col-sm-3 col-form-label">YouTube:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="youtube" name="youtube" value="{{ old('youtube') }}" placeholder="YouTube URL">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" onclick="window.history.back();" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <img src="{{ asset('images/bg_login_osiker.png') }}" alt="Background Image" class="bottom-image">

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
    $(document).ready(function() {
        $('#kategori, #subsektor, #kota, #kecamatan').select2();
        $('#kota').change(function() {
            var cityId = $(this).val();
            $.ajax({
                url: '/api/get-kecamatan', // Endpoint yang menangani request ini
                type: 'POST',
                data: {
                    id_kota: cityId, // Pastikan nama key di sini sama dengan nama key di validasi controller
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option value="" disabled selected>Pilih Kecamatan</option>');
                    $.each(data, function(index, kecamatan) {
                        $('#kecamatan').append('<option value="'+kecamatan.id+'">'+kecamatan.nama+'</option>');
                    });
                },
                error: function() {
                    alert('Error fetching data');
                }
            });
        });
    });


            function previewImage(event) {
                var input = event.target;
                var reader = new FileReader();
                reader.onload = function() {
                    var imagePreview = document.getElementById('imagePreview');
                    imagePreview.innerHTML = '<img src="' + reader.result + '" alt="Preview">';
                };
                reader.readAsDataURL(input.files[0]);
            }
        </script>
    </body>
    </html>