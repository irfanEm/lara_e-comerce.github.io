<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * menyimpan post blog baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(),
        [
            'title' => 'required|unique|max:255',
            'body' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //mengambil data input yang valid
        $validated = $request->validated();

        //mengambil bagian dari data input yang divalidasi
        $validated = $request->safe()->only(['name', 'email']);
        $validated = $request->safe()->except(['name', 'email']);

        Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ])->validateWithBag('post');

        return redirect('register')->withErrors($validator, 'login');

        {{ $errors->login->first('email') }}

        // simpan post blog
        return redirect('/post');
    }
}
