<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan nama model menggunakan huruf kapital
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Subsektor;
use App\Models\Kategori;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|size:12', // Mengatur tepat 12 angka untuk phone
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'password' => 'required|string|min:8|max:255', // Password harus minimal 8 karakter
            'kategori_id' => 'required|integer|exists:kategori,id',
            'subsektor_id' => 'required|integer|exists:subsektor,id',
            'kota_id' => 'required|integer|exists:kota,id',
            'kecamatan_id' => 'required|integer|exists:kecamatan,id',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000', // Deskripsi bisa null jika tidak diperlukan
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Log::error('Validation failed: ' . json_encode($validator->errors()));
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Jika ada file logo yang diupload
        $path = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('public/logos');
        }

        // Simpan data ke dalam database
        $register = new User();
        $register->name = $request->input('name');
        $register->phone = $request->input('phone');
        $register->email = $request->input('email');
        $register->website = $request->input('website');
        $register->facebook = $request->input('facebook');
        $register->instagram = $request->input('instagram');
        $register->tiktok = $request->input('tiktok');
        $register->youtube = $request->input('youtube');
        $register->password = Hash::make($request->input('password')); // Hash password sebelum menyimpan
        $register->kategori_id = $request->input('kategori_id');
        $register->subsektor_id = $request->input('subsektor_id');
        $register->kota_id = $request->input('kota_id');
        $register->kecamatan_id = $request->input('kecamatan_id');
        $register->alamat = $request->input('alamat');
        $register->deskripsi = $request->input('deskripsi');

        // Simpan path logo jika ada
        if ($path) {
            $register->logo = $path;
        }

        try {
            $register->save(); // Simpan data ke database
            Log::info('Data successfully added: ' . $register->name);
            return redirect()->route('login')->with('success', 'Data berhasil ditambahkan. Silakan login.');
        } catch (\Exception $e) {
            Log::error('Failed to add data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan data.');
        }
    }

    public function edit($id)
    {
        // Ambil data register berdasarkan ID
        $register = User::findOrFail($id);

        // Ambil data tambahan dari database
        $kategori = Kategori::all();
        $subsektor = Subsektor::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();

        // Kirim data ke view
        return view('osiker.register.edit', compact('register', 'subsektor', 'kecamatan', 'kota', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|size:12',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'password' => 'nullable|string|min:8|max:255', // Password opsional
            'kategori_id' => 'required|integer|exists:kategori,id',
            'subsektor_id' => 'required|integer|exists:subsektor,id',
            'kota_id' => 'nullable|integer|exists:kota,id',
            'kecamatan_id' => 'nullable|integer|exists:kecamatan,id',
            'alamat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed during update: ' . json_encode($validator->errors()));
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $register = User::findOrFail($id);

        // Update data
        $register->name = $request->input('name');
        $register->phone = $request->input('phone');
        $register->email = $request->input('email');
        $register->website = $request->input('website');
        $register->facebook = $request->input('facebook');
        $register->instagram = $request->input('instagram');
        $register->tiktok = $request->input('tiktok');
        $register->youtube = $request->input('youtube');
        if ($request->input('password')) {
            $register->password = Hash::make($request->input('password')); // Hash password jika ada
        }
        $register->kategori_id = $request->input('kategori_id');
        $register->subsektor_id = $request->input('subsektor_id');
        $register->kota_id = $request->input('kota_id');
        $register->kecamatan_id = $request->input('kecamatan_id');
        $register->alamat = $request->input('alamat');
        $register->deskripsi = $request->input('deskripsi');

        // Jika ada file logo yang diupload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('public/logos');
            $register->logo = $path;
        }

        try {
            $register->save(); // Simpan perubahan ke database
            Log::info('Data successfully updated for ID: ' . $id);
            return redirect()->route('osiker.home')->with('success', 'Data berhasil diubah.');
        } catch (\Exception $e) {
            Log::error('Failed to update data for ID: ' . $id . '. Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengupdate data.');
        }
    }

    public function destroy($id)
    {
        try {
            $register = User::findOrFail($id);
            $register->delete(); // Hapus data
            Log::info('Data successfully deleted for ID: ' . $id);
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Failed to delete data for ID: ' . $id . '. Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }
}
