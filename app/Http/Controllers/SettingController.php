<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        // Validate based on request type
        if ($request->ajax() || $request->wantsJson()) {
            $request->validate([
                'app_name' => 'required|string|max:255',
                'sidebar_color' => 'required|string|max:255',
                'dark_mode' => 'nullable|boolean',
            ]);
        } else {
            $request->validate([
                'app_name' => 'required|string|max:255',
                'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'sidebar_color' => 'required|string|max:255',
                'dark_mode' => 'nullable|boolean',
            ]);
        }

        // Update app name
        $this->updateSetting('app_name', $request->app_name);
        
        // Update app logo
        if ($request->hasFile('app_logo')) {
            $logoPath = $request->file('app_logo')->store('logos', 'public');
            $this->updateSetting('app_logo', $logoPath);
        }
        
        // Update sidebar color
        $this->updateSetting('sidebar_color', $request->sidebar_color);
        
        // Update dark mode
        $this->updateSetting('dark_mode', $request->has('dark_mode') ? '1' : '0');

        // Clear cache
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');

        // Return response based on request type
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Settings updated successfully.']);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Update or create a setting.
     */
    private function updateSetting($key, $value)
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}