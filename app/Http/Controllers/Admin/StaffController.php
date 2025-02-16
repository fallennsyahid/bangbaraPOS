<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.staffs.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staffs.create');
    }

    public function export() {
    return Excel::download(new UserExport, 'users.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email|min:0',
            'usertype' => 'required|in:staff',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'usertype' => $request->input('usertype'),
            'password' => $request->input('password'),
        ]);
        return redirect()->route('staffs.index')->with('success', 'Succcessfully added staff');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.staffs.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.staffs.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $user = User::findOrFail($id);

         $request->validate([
        'name' => 'string|max:255',
        'email' => 'email|unique:users,email,' . $user->id,
        'usertype' => 'in:staff,admin',
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
        return redirect()->route('staffs.index')->with('success', 'Staff berhasil diperbarui!');
    } else {
        return back()->with('error', 'Gagal memperbarui staff, silakan coba lagi.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('staffs.index')->with('success', 'Succesfully Deleted Staff');
    }
}
