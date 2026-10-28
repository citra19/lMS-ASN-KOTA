<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show website settings form
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update website settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title' => ['required', 'string', 'max:255'],
            'site_tagline' => ['required', 'string', 'max:255'],
            'agency_name' => ['required', 'string', 'max:255'],
            'parent_agency' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:50'],
            'fax' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'website' => ['nullable', 'string', 'max:255'],
            'head_officer_name' => ['nullable', 'string', 'max:255'],
            'head_officer_nip' => ['nullable', 'string', 'max:100'],
            'head_officer_title' => ['nullable', 'string', 'max:255'],
            'about_summary' => ['required', 'string'],
            'site_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $logoPath, 'branding');
        }

        foreach ($validated as $key => $value) {
            if ($key !== 'site_logo') {
                Setting::set($key, $value);
            }
        }

        return back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
