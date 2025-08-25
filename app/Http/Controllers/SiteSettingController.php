<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image; 

class SiteSettingController extends Controller
{
    public function index()
    {
        $rows = SiteSetting::all();
        return view('site_setting.index', compact('rows'));
    }

    public function create()
    {
        return view('site_setting.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'content'     => 'nullable|string|max:200',
            'facebook'    => 'nullable|string|max:100',
            'telegram'    => 'nullable|string|max:100',
            'youtube'     => 'nullable|string|max:100',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file_name = null;

        if ($request->hasFile('logo')) {
            $image     = $request->file('logo');
            $file_ext  = $image->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_ext;

            $destinationPath = public_path('uploads/logos');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $image->move($destinationPath, $file_name);
            $this->GenerateSiteThumbailsImage($destinationPath.'/'.$file_name, $file_name);
        }

        // Create the post
        $site = SiteSetting::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'content'     => $validated['content'],
            'facebook'     => $validated['facebook'],
            'telegram'     => $validated['telegram'],
            'youtube'     => $validated['youtube'],
            'logo'       => $file_name,
            'created_by'  => auth()->id(),
        ]);

        return redirect()->route('site_setting.index')->with('success', 'Site_Setting created successfully.');
    }

    public function GenerateSiteThumbailsImage($imagePath, $imageName)
    {
        $destinationPath = public_path('uploads/logos');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Read the saved image
        $img = Image::read($imagePath);

        // Create 124x124 thumbnail
        $img->cover(124, 124, 'center')
            ->save($destinationPath.'/thumb_'.$imageName);
    }

    public function edit($id)
    {
        $row = SiteSetting::findOrFail($id);
        return view('site_setting.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = SiteSetting::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'content'     => 'nullable|string|max:200',
            'facebook'    => 'nullable|string|max:100',
            'telegram'    => 'nullable|string|max:100',
            'youtube'     => 'nullable|string|max:100',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file_name = null;

        if ($request->hasFile('logo')) {
            $logo     = $request->file('logo');
            $file_ext  = $logo->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_ext;

            $destinationPath = public_path('uploads/logos');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // Delete old images if exist
            if ($row->logo && File::exists($destinationPath.'/'.$row->logo)) {
                File::delete($destinationPath.'/'.$row->logo);
                File::delete($destinationPath.'/thumb_'.$row->logo);
            }

            $logo->move($destinationPath, $file_name);
            $this->GenerateSiteThumbailsImage($destinationPath.'/'.$file_name, $file_name);
        }
        
        $row->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'content'     => $validated['content'],
            'facebook'    => $validated['facebook'],
            'telegram'    => $validated['telegram'],
            'youtube'     => $validated['youtube'],
            'logo'        => $file_name,
            'updated_by'  => auth()->id()
        ]);


        return redirect()->route('site_setting.index')->with('success', 'Site setting updated successfully.');
    }

    public function destroy($id)
    {
        $row = SiteSetting::findOrFail($id);
        $destinationPath = public_path('uploads/logos');
        if ($row->logo && File::exists($destinationPath.'/'.$row->logo)) {
            File::delete($destinationPath.'/'.$row->logo);
            File::delete($destinationPath.'/thumb_'.$row->logo);
        }
        $row->update(['deleted_by' => auth()->id()]);
        $row->delete();

        return redirect()->route('site_setting.index')->with('success', 'Site setting deleted successfully.');
    }
}