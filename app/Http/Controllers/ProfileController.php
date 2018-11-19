<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        return view('profile.profile')->with('user', $user);
    }

    public function edit(){
        $user = auth()->user();
        return view('profile.edit')->with('user', $user);
    }

    public function update(Request $request){
        $this->validate($request, array(
            'name' => 'required',
            'phone' => 'required|integer|max:9999999999',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));
        $user = auth()->user();
        $updateUser = $user;

        $updateUser->name = $request->input('name');
        $updateUser->description = $request->input('about');
        $updateUser->phone = $request->input('phone');

        if($request->hasFile('picture')){
            $image= $request->file('picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save( public_path('images/' . $filename ) );
            $updateUser->profilePicture= $filename;
        };

        $updateUser->save();

        return redirect('/profile')->with('user', $user);
    }
}
