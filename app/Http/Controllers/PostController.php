<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{

    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Posts/PostIndex', [
            'posts' => PostResource::collection(
                Post::with(['user', 'comments.user'])
                    ->search($request->search)
                    ->latest()
                    ->paginate(15)
                    ->withQueryString()
            ),
            'search' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/PostCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $path = $request->file('file')->store('blog', 'public');

        $validated = $request->validated();

        $validated['image'] = $path;

        Post::create($validated);

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
        return Inertia::render('Posts/PostShow', [
            'post' => PostResource::make(
                $post->loadMissing([
                    'user', 'comments' => function ($query) {
                        $query->with('user')->latest();
                    }

                ])
            ),
            'canEdit' => $request->user()?->can('update', $post) ?? null,
            'canDelete' => $request->user()?->can('delete', $post) ?? null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/PostEdit', [
            'post' => $post->loadMissing(['user']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        tap($post)->update($request->validated());

        $post->refresh();

        return to_route('posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return to_route('posts.index');
    }
}
