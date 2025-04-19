<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SetPrinterAdminController extends Controller
{
    public function index() {
        $user = Auth::user();
        $printerName = $user->printer_name;
        
        return view('admin.settings.index', compact('printerName'));
    }
    public function setPrinter(Request $request) {
        $request->validate([
            'printer_name' => 'string|required'
        ]);

        $user = Auth::user();

        if ($user instanceof User) {
            $user->printer_name = $request->printer_name;
            $user->save();
            return redirect()->back()->with('success', 'Successfully changed printer name');

        } else {
            return redirect()->back()->withErrors('User not found or invalid.');
        }
        
    }
}
