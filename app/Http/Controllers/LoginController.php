<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'PEMIRA HMIF | Login'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password harus diisi.'
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if ($user && Hash::check($validatedData['password'], $user->password)) {
            Auth::login($user);
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'userRole' => $user->role,
                'sesi' => $user->sesi,
            ]);

            if ($user->role === 'admin') {
                return redirect()->route('dashboard.index');
            }

            $now = Carbon::now('Asia/Jakarta');

            $sesiTime = Carbon::createFromFormat('H:i:s', session('sesi'), 'Asia/Jakarta');

            $validTimeEnd = $sesiTime->copy()->addHours(2);

            if ($now->between($sesiTime, $validTimeEnd)) {
                return redirect()->route('voter.index');
            } else {
                Auth::logout();
                return back()->withErrors(['Sesi tidak valid atau sudah lewat.'])->withInput(['email' => $user->email]);
            }
        }

        return back()->withErrors(['Periksa kembali email dan password yang anda masukkan.'])->withInput($request->only('email'));
    }


    public function logout(Request $request): RedirectResponse
    {
        $request->session()->flush();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
