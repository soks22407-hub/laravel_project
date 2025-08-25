<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image; 

class PostController extends Controller
{
    /**
     * Initializes middleware for this controller.
     */
    public function __construct()
    {
        // Ensures only authenticated users can access these routes.
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all posts that have not been soft-deleted.
        $rows = Post::whereNull('deleted_at')->get();
        return view('post.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'sub_title'   => 'nullable|string|max:100',
            'description' => 'required|string|max:200',
            'content'     => 'required|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active'      => 'required|boolean',
        ]);

        $file_name = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $file_ext  = $image->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_ext;

            // Save to public/uploads/images (make sure folder exists)
            $destinationPath = public_path('uploads/images');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            
            $image->move($destinationPath, $file_name);

           
            $this->GeneratePostThumbailsImage($destinationPath.'/'.$file_name, $file_name);
        }

        // Create the post
        $post = Post::create([
            'title'       => $validated['title'],
            'sub_title'   => $validated['sub_title'] ?? null,
            'description' => $validated['description'],
            'content'     => $validated['content'],
            'image'       => $file_name,
            'active'      => $validated['active'],
            'created_by'  => auth()->id(),
        ]);

        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }

    public function GeneratePostThumbailsImage($imagePath, $imageName)
    {
        $destinationPath = public_path('uploads/images');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Read the saved image
        $img = Image::read($imagePath);

        // Create 124x124 thumbnail
        $img->cover(124, 124, 'center')
            ->save($destinationPath.'/thumb_'.$imageName);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // This method is currently not used based on your provided code,
        // but it's good practice to keep it.
        // Example: return view('post.show', ['post' => Post::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the post by its ID or fail.
        $row = Post::findOrFail($id);
        return view('post.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the post to be updated.
        $row = Post::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'sub_title'   => 'nullable|string|max:100',
            'description' => 'required|string|max:200',
            'content'     => 'required|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active'      => 'required|boolean',
        ]);

        $file_name = $row->image; // Keep old image if no new one

        // Handle image upload
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $file_ext  = $image->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_ext;

            $destinationPath = public_path('uploads/images');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // Delete old images if exist
            if ($row->image && File::exists($destinationPath.'/'.$row->image)) {
                File::delete($destinationPath.'/'.$row->image);
                File::delete($destinationPath.'/thumb_'.$row->image);
            }

            $image->move($destinationPath, $file_name);
            $this->GeneratePostThumbailsImage($destinationPath.'/'.$file_name, $file_name);
        }

        // Update the post
        $row->update([
            'title'       => $validated['title'],
            'sub_title'   => $validated['sub_title'] ?? null,
            'description' => $validated['description'],
            'content'     => $validated['content'],
            'image'       => $file_name,
            'active'      => $validated['active'],
            'updated_by'  => auth()->id()
        ]);

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the post by its ID or fail.
        $post = Post::findOrFail($id);
        $destinationPath = public_path('uploads/images');
        if ($post->image && File::exists($destinationPath.'/'.$post->image)) {
            File::delete($destinationPath.'/'.$post->image);
            File::delete($destinationPath.'/thumb_'.$post->image);
        }
        $post->update(['deleted_by' => auth()->id()]);
        $post->delete();
        return redirect()->route('post.index')->with('status', 'Post has been deleted successfully!');
    }
}
