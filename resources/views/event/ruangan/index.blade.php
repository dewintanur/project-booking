@extends('layouts.app')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Biaya Sewa</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ruangan as $r)
            <tr>
                <td>{{ $r->nama_ruangan }}</td>
                <td>{{ $r->lantai }}</td>
                <td>{{ $r->biaya_sewa }}</td>
                <td><img src="{{ asset('storage/' . $r->gambar) }}" alt="Gambar" width="100"></td>
                <td>
                    <a href="{{ route('event.ruangan.edit', $r->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
