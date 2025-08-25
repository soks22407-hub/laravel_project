<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $rows = Banner::whereNull('deleted_at')->get();
        return view('banners.index', compact('rows'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable|max:200',
        ]);

        Banner::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('banner.index');
    }

    public function edit(string $id)
    {
        $row = Banner::findOrFail($id);
        return view('banners.edit', compact('row'));
    }

    public function update(Request $request, string $id)
    {
        $row = Banner::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable|max:200',
        ]);

        $row->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('banner.index');
    }

    public function delete(string $id)
    {
        $row = Banner::findOrFail($id);
        $row->deleted_by = auth()->id();
        $row->save();
        $row->delete();

        return redirect()->route('banner.index');
    }
}