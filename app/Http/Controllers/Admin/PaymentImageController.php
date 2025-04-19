<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PaymentImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $image = Image::first();
        return view('admin.settings.index', compact('image'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_image' => 'required',
        ]);

        $paymentImage = $request->file('payment_image')->store('barcode-image', 'public');

        Image::create([
            'payment_image' => $paymentImage,
        ]);

        return redirect()->back()->with('Success', 'Change photo successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_image' => 'required',
        ]);

        $image = Image::findOrFail($id);

        if ($image->payment_image && Storage::disk('public')->exists($image->payment_image)) {
            Storage::disk('public')->delete($image->payment_image);
        }

        $paymentImage = $request->file('payment_image')->store('barcode-image', 'public');

        $image->update([
            'payment_image' => $paymentImage,
        ]);

        return redirect()->back()->with('success', 'Photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
