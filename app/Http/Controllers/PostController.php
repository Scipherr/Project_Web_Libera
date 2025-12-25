<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\ConvertPostVideo;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
       $categories = Category::all();
       
       // NEW: Fetch the top 5 latest posts for the carousel
       $carouselPosts = Post::orderBy('created_at', 'DESC')->take(5)->get();

       $postsQuery = Post::orderBy('created_at', 'DESC');

        if (request('category')) {
             $postsQuery->where('category_id', request('category'));
        }
        $posts = $postsQuery->simplePaginate(5);
        
        $posts->appends(request()->query());
        
        // Pass carouselPosts to the view
        return view('post.index', [
            'posts' => $posts,
            'categories' => $categories,
            'carouselPosts' => $carouselPosts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create',['categories'=> $categories]);
    }
   public function store(PostCreateRequest $request)
{
    $data = $request->validated();
    
    // Handle Image
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('posts', 'public');
    }

    $data['user_id'] = Auth::id();
    $data['slug'] = Str::slug($data['title']);

    // Handle Video (Upload Raw first)
    if ($request->hasFile('video')) {
        // Store in a temp folder inside public
        $data['video'] = $request->file('video')->store('posts/temp', 'public');
    }

    $post = Post::create($data);

    // Dispatch the conversion job if a video exists
    if (!empty($data['video'])) {
        ConvertPostVideo::dispatch($post);
    }

    return redirect()->route('dashboard')->with('status', 'Post created! Video is processing...');
}
    
    public function show(string $username,Post $post)
    {
        return view('post.show',['post'=>$post,]);
    }
    public function edit(Post $post)
    {
        // Ensure the logged-in user owns the post
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $categories = Category::all();
        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }
    public function update(PostCreateRequest $request, Post $post) 
    {
        // Note: You might want to create a separate PostUpdateRequest if validation differs
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $data = $request->validated();
        
        // Handle Image Update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        // Update Slug if title changed
        if ($post->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']);
        }

        $post->update($data);

        // Redirect back to the public profile or dashboard
        return redirect()->route('profile.show', ['user' => Auth::user()->username])
                         ->with('status', 'Post updated!');
    }
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        // Delete image
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('status', 'Post deleted successfully!');
    }
}
