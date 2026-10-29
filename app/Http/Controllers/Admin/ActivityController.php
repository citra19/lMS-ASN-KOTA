<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities for admin management
     */
    public function index(Request $request)
    {
        Activity::autoSyncStatuses();

        $search = $request->query('q');
        $status = $request->query('status');
        $publish = $request->query('publish');

        $query = Activity::query()->withCount(['questions', 'attendances']);

        if ($search) {
            $query->search($search);
        }

        if ($status && in_array($status, ['upcoming', 'ongoing', 'completed'])) {
            $query->where('status', $status);
        }

        if ($publish !== null && $publish !== '') {
            $query->where('is_published', (bool) $publish);
        }

        $activities = $query->orderBy('date', 'desc')->paginate(10)->withQueryString();

        return view('admin.activities.index', compact('activities', 'search', 'status', 'publish'));
    }

    /**
     * Show form for creating a new activity
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created activity in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'theme' => ['required', 'string', 'max:255'],
            'speaker_name' => ['required', 'string', 'max:255'],
            'speaker_title' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['nullable'],
            'description' => ['nullable', 'string'],
            'youtube_url' => ['nullable', 'url', 'max:500'],
            'zoom_url' => ['nullable', 'url', 'max:500'],
            'zoom_meeting_id' => ['nullable', 'string', 'max:100'],
            'zoom_passcode' => ['nullable', 'string', 'max:100'],
            'pretest_url' => ['nullable', 'url', 'max:500'],
            'google_form_url' => ['nullable', 'url', 'max:500'],
            'material_url' => ['nullable', 'url', 'max:500'],
            'certificate_url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'in:upcoming,ongoing,completed'],
            'is_published' => ['nullable', 'boolean'],
            'jp_hours' => ['nullable', 'integer', 'min:1', 'max:50'],
            'passing_grade' => ['nullable', 'integer', 'min:10', 'max:100'],
            'banner_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'virtual_background' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'certificate_bg' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'material_file' => ['nullable', 'file', 'mimes:pdf,ppt,pptx,zip,rar,doc,docx', 'max:20480'],
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Activity::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;
        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['jp_hours'] = $validated['jp_hours'] ?? 3;
        $validated['passing_grade'] = $validated['passing_grade'] ?? 70;

        // Upload files
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        if ($request->hasFile('virtual_background')) {
            $validated['virtual_background'] = $request->file('virtual_background')->store('virtual_backgrounds', 'public');
        }

        if ($request->hasFile('certificate_bg')) {
            $validated['certificate_bg'] = $request->file('certificate_bg')->store('certificate_bgs', 'public');
        }

        if ($request->hasFile('material_file')) {
            $validated['material_file'] = $request->file('material_file')->store('materials', 'public');
        }

        $activity = Activity::create($validated);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Kegiatan "'.$activity->title.'" berhasil ditambahkan.');
    }

    /**
     * Show form for editing an existing activity
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update specified activity in storage
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'theme' => ['required', 'string', 'max:255'],
            'speaker_name' => ['required', 'string', 'max:255'],
            'speaker_title' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['nullable'],
            'description' => ['nullable', 'string'],
            'youtube_url' => ['nullable', 'url', 'max:500'],
            'zoom_url' => ['nullable', 'url', 'max:500'],
            'zoom_meeting_id' => ['nullable', 'string', 'max:100'],
            'zoom_passcode' => ['nullable', 'string', 'max:100'],
            'pretest_url' => ['nullable', 'url', 'max:500'],
            'google_form_url' => ['nullable', 'url', 'max:500'],
            'material_url' => ['nullable', 'url', 'max:500'],
            'certificate_url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'in:upcoming,ongoing,completed'],
            'is_published' => ['nullable', 'boolean'],
            'jp_hours' => ['nullable', 'integer', 'min:1', 'max:50'],
            'passing_grade' => ['nullable', 'integer', 'min:10', 'max:100'],
            'banner_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'virtual_background' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'certificate_bg' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'remove_certificate_bg' => ['nullable', 'boolean'],
            'material_file' => ['nullable', 'file', 'mimes:pdf,ppt,pptx,zip,rar,doc,docx', 'max:20480'],
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['jp_hours'] = $validated['jp_hours'] ?? 3;
        $validated['passing_grade'] = $validated['passing_grade'] ?? 70;

        // Update slug if title changed
        if ($validated['title'] !== $activity->title) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $counter = 1;
            while (Activity::where('slug', $slug)->where('id', '!=', $activity->id)->exists()) {
                $slug = "{$originalSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        // File uploads & replacements
        if ($request->hasFile('banner_image')) {
            if ($activity->banner_image && Storage::disk('public')->exists($activity->banner_image)) {
                Storage::disk('public')->delete($activity->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        if ($request->hasFile('virtual_background')) {
            if ($activity->virtual_background && Storage::disk('public')->exists($activity->virtual_background)) {
                Storage::disk('public')->delete($activity->virtual_background);
            }
            $validated['virtual_background'] = $request->file('virtual_background')->store('virtual_backgrounds', 'public');
        }

        if ($request->boolean('remove_certificate_bg')) {
            if ($activity->certificate_bg && Storage::disk('public')->exists($activity->certificate_bg)) {
                Storage::disk('public')->delete($activity->certificate_bg);
            }
            $validated['certificate_bg'] = null;
        } elseif ($request->hasFile('certificate_bg')) {
            if ($activity->certificate_bg && Storage::disk('public')->exists($activity->certificate_bg)) {
                Storage::disk('public')->delete($activity->certificate_bg);
            }
            $validated['certificate_bg'] = $request->file('certificate_bg')->store('certificate_bgs', 'public');
        }

        if ($request->hasFile('material_file')) {
            if ($activity->material_file && Storage::disk('public')->exists($activity->material_file)) {
                Storage::disk('public')->delete($activity->material_file);
            }
            $validated['material_file'] = $request->file('material_file')->store('materials', 'public');
        }

        $activity->update($validated);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Kegiatan "'.$activity->title.'" berhasil diperbarui.');
    }

    /**
     * Remove the specified activity
     */
    public function destroy(Activity $activity)
    {
        $title = $activity->title;

        // Clean up files
        if ($activity->banner_image && Storage::disk('public')->exists($activity->banner_image)) {
            Storage::disk('public')->delete($activity->banner_image);
        }
        if ($activity->virtual_background && Storage::disk('public')->exists($activity->virtual_background)) {
            Storage::disk('public')->delete($activity->virtual_background);
        }
        if ($activity->material_file && Storage::disk('public')->exists($activity->material_file)) {
            Storage::disk('public')->delete($activity->material_file);
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Kegiatan "'.$title.'" berhasil dihapus.');
    }

    /**
     * Toggle publication status (publish / unpublish)
     */
    public function togglePublish(Activity $activity)
    {
        $activity->update([
            'is_published' => ! $activity->is_published,
        ]);

        $statusMsg = $activity->is_published ? 'dipublikasikan' : 'disembunyikan (draft)';

        return back()->with('success', "Status kegiatan berhasil diubah menjadi {$statusMsg}.");
    }
}
