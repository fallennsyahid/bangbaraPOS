<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return view('admin.reviews.index', compact('reviews'));
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    public function bulkDelete(Request $request)
{
    // Ambil array ID dari request
    $ids = $request->input('ids');

    // Validasi jika tidak ada ID yang dikirim
    if (!$ids || count($ids) === 0) {
        return response()->json(['success' => false, 'message' => 'No items selected.']);
    }

    // Hapus data berdasarkan ID
    $deleted = Review::whereIn('id', $ids)->delete();

    // Periksa apakah data berhasil dihapus
    if ($deleted) {
        return response()->json(['success' => true, 'message' => 'Selected items deleted successfully.']);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to delete selected items.']);
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Ulasan berhasil dihapus');
    }
}
