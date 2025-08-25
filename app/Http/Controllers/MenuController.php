<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        $rows = Menu::whereNull('deleted_at')->get();
        return view('menu.index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'sub_title'   => 'nullable|string|max:200',
            'description' => 'required|string|max:200',
            'active'      => 'required|boolean',
        ]);

        Menu::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'active' => $request->active,
            'created_by'  => auth()->id()
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Menu::findOrFail($id);
        return view('menu.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = Menu::findOrFail($id);
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'sub_title'   => 'nullable|string|max:200',
            'description' => 'nullable|string|max:200',
            'active'      => 'required|boolean',
        ]);

        $row->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'active' => $request->active,
            'updated_by'  => auth()->id()
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Menu::findOrFail($id);
        $row->update(['deleted_by' => auth()->id()]);
        $row->delete();
        return redirect()->route('menu.index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
