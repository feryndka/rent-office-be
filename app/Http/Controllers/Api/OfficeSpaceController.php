<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource;
use App\Models\OfficeSpace;
use Illuminate\Http\Request;

class OfficeSpaceController extends Controller
{
    public function index()
    {
        // Mengambil data kantor dari model yang memiliki relasi dengan data city
        $officeSpaces = OfficeSpace::with(['city'])->get();
        // Menggunakan collection karena akan mengambil banyak data office
        return OfficeSpaceResource::collection($officeSpaces);
    }

    // Untuk detail data office
    public function show(OfficeSpace $officeSpace) // Model Binding
    {
        // Mengambil data office dari model, dan mengambil city, photo, serta benefits dari kantor tersebut
        $officeSpace->load(['city', 'photos', 'benefits']);
        // Menggunakan new karena hanya mengambil 1 data office
        return new OfficeSpaceResource($officeSpace);
    }
}
