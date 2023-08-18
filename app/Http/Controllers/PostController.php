<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
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
    public function store(StorePostRequest $request): RedirectResponse
    {
        //request yang valid masuk

        //mengambil data input yang valid
        $validated = $request->validated();

        //mengambil bagian dari data input yang divalidasi
        $validated = $request->safe()->only(['name', 'email']);
        $validated = $request->safe()->except(['name', 'email']);

        // simpan post blog
        return redirect('/post');
        //blog valid..
        return redirect('/posts');
        $title = $request->old('title');
        // $post = /**... */

        // return to_route('post.show', ['post' => $post->id]);
    }
}
