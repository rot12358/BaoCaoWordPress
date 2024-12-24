<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportRequest; // Import Mailable

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function sendSupportRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);

        // Gửi email
        Mail::to('lamt14865@gmail.com')->send(new SupportRequest(
            $request->name,
            $request->email,
            $request->phone,
            $request->address,
            $request->message
        ));

        return redirect()->back()->with('success', 'Email hỗ trợ đã được gửi thành công.');
    }
}
