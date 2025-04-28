<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantLocation;

class SetLocationController extends Controller
{
    public function showLocationForm()
    {
        // Ambil data lokasi restoran dari database
        $location = RestaurantLocation::first();
        return view('admin.settings.index', compact('location'));
    }

    public function updateLocation(Request $request)
    {
        // Validasi input
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        // Simpan atau update koordinat restoran
        $location = RestaurantLocation::first();
        if (!$location) {
            $location = new RestaurantLocation();
        }

        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();

        return redirect()->back()->with('success', 'Koordinat berhasil diperbarui');
    }
}
