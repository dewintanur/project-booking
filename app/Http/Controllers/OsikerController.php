<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Kecamatan;
class OsikerController extends Controller
{
    private $apiKey = 'HMsGWFtjpuGdiaHIsoXp';

    private function makeApiRequest($url, $data = [])
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Content-Type' => 'multipart/form-data'
        ])->post($url, $data);

        if ($response->failed()) {
            return 'Error: ' . $response->body();
        }

        return $response->json()['Data'];
    }

    public function showSubsector()
    {
        $url = "https://osiker.com/api/master-data/subsektor/list";
        return $this->makeApiRequest($url);
    }

    public function showDistrict()
{
    $url = "https://osiker.com/api/master-data/kecamatan/list";
    return $this->makeApiRequest($url);
}


    public function showCity()
    {
        $url = "https://osiker.com/api/master-data/kota/list";
        return $this->makeApiRequest($url);
    }

    public function showCategory()
    {
        $url = "https://osiker.com/api/master-data/kategori/list";
        return $this->makeApiRequest($url);
    }

    public function form(Request $request)
    {
        // Retrieve all the data needed for the form
        $subsektor = $this->showSubsector();
        $kota = $this->showCity();
        $kategori = $this->showCategory();
        $kecamatan = $this->showDistrict();

        // Jika ID kota tersedia di request, ambil data kecamatan

        // Send data to the view
        return view('osiker.register.form', compact('subsektor', 'kecamatan', 'kota', 'kategori'));
    }
}
