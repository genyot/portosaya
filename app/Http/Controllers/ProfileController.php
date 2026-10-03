<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Isi data yang tervalidasi, TANPA foto & CV (diproses terpisah)
        $user->fill($request->safe()->except(['photo', 'cv_file']));

        // Kalau email berubah, verifikasi direset
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Kalau ada upload foto baru
        if ($request->hasFile('photo')) {

            // Hapus foto lama supaya tidak menumpuk
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan foto baru ke storage/app/public/photos
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        // Kalau ada upload CV baru
        if ($request->hasFile('cv_file')) {

            if ($user->cv_file) {
                Storage::disk('public')->delete($user->cv_file);
            }

            $user->cv_file = $request->file('cv_file')->store('cv', 'public');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
