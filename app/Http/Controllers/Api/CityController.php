<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // Mengambil data city dari model, dan menghitung total office dari method officeSpaces
        $cities = City::withCount('officeSpaces')->get();
        // Menggunakan collection karena akan mengambil banyak data city
        return CityResource::collection($cities);
    }

    // Untuk detail data city
    public function show(City $city) // Model Binding
    {
        // Mengambil data office yang berada di kota tersebut, dan mengambil photo dari office
        $city->load(['officeSpaces.city', 'officeSpaces.photos']);
        // Menghitung data kantor di suatu kota
        $city->loadCount('officeSpaces');
        // Menggunakan new karena hanya mengambil 1 data kota
        return new CityResource($city);
    }
}
