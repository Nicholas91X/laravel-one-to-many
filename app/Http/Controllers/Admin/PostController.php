<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Cathegory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cathegories = Cathegory::all();

        return view("admin.posts.create", compact("cathegories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Parte di validazione dati
        $request->validate([
            "title" => "required|string|max:150",
            "description" => "required",
            "published" => "sometimes|accepted",
            "image" => "nullable|mimes:jpes,bmp,png|max:2048",
            "cathegory_id" => "nullable|exists:cathegories,id"
        ]);

        //prendo i miei dati
        $data = $request->all();

        //creo un nuovo post
        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->description = $data['description'];
        if ( isset($data['image']) ) {
            $path_image = Storage::put("uploads", $data["image"]);
            $newPost->image = $path_image;
        };

        $newPost->cathegory_id = $data["cathegory_id"];

        $slug = Str::of($newPost->title)->slug("-");
        $count = 1;

        while ( Post::where("slug", $slug)->first() ) {
            $slug = Str::of($newPost->title)->slug("-") . "-{$count}";
            $count++;
        }

        $newPost->slug = $slug;

        $newPost->published = isset($data['published']);

        $newPost->save();

        return redirect()->route("posts.show", $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $cathegories = Cathegory::all();

        return view("admin.posts.edit", compact("post", "cathegories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //Parte di validazione dati
        $request->validate([
            "title" => "required|string|max:150",
            "description" => "required",
            "published" => "sometimes|accepted",
            "image" => "nullable|mimes:jpg,bmp,png",
            "cathegory_id" => "nullable|exists:cathegories,id"
        ]);

        //prendo i miei dati
        $data = $request->all();

        //aggiorno post
        if ( $post->title != $data['title'] ) {
            $post->title = $data['title'];

            $slug = Str::of($post->title)->slug("-");

            if ( $slug != $post->slug ) {
                $count = 1;

                while ( Post::where("slug", $slug)->first() ) {
                    $slug = Str::of($post->title)->slug("-") . "-{$count}";
                    $count++;
                }

                $post->slug = $slug;
            }
        } 

        $post->description = $data['description'];
        if ( isset($data['image']) ) {
            Storage::delete($post->image);
            $path_image = Storage::put("uploads", $data["image"]);
            $post->image = $path_image;
        };
        $post->cathegory_id = $data["cathegory_id"];
        $post->published = isset($data['published']);


        $post->save();

        return redirect()->route("posts.show", $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();

        return redirect()->route("posts.index");
    }
}
