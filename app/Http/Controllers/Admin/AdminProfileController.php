<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 


class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Ambil user yang sedang login

        if (!$user) {
            return abort(403, 'User not logged in'); // Jika user tidak login
        }

        return view('admin.profile.show', compact('user'));
    }
    
//    


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
    public function show($id)
{
    $user = Auth::user(); // Ambil user yang sedang login

    if (!$user) {
        return abort(403, 'User not logged in'); // Jika user tidak login
    }

    return view('admin.profile.show', compact('user'));
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $user = User::findOrFail($id);

         $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|unique:users,email,' . $user->id,
        'usertype' => 'nullable|in:staff,admin',
        'password' => 'nullable',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->usertype = $request->usertype;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

    // Simpan perubahan ke database
    if ($user->save()) {
        return redirect()->route('profile.edit')->with('success', 'Staff berhasil diperbarui!');
    } else {
        return back()->with('error', 'Gagal memperbarui staff, silakan coba lagi.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
