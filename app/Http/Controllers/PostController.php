<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * menampilkan form untuk membuat post blog baru.
     */
    public function create(): View
    {
        return view('post.create');
    }

    /**
     * menyimpan post blog baru.
     */
    public function store(Request $request): RedirectResponse
    {
        //validasi dan simpan post blog
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'publish_at' => 'nullable|date',
        ]);

        //blog valid..
        return redirect('/posts');
        $title = $request->old('title');
        // $post = /**... */

        // return to_route('post.show', ['post' => $post->id]);
    }
}
