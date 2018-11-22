<?php

namespace App\Http\Controllers;

use App\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminMembersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Input::has('search') && Input::get('search') != ""){
            $query = Input::get('search');
            $members = Members::where('name', $query)->paginate(5);
            return view('admin.manage-user')->with('members', $members);
        }

        $members = Members::paginate(5);
        return view('admin.manage-user')->with('members', $members);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $members = Members::find($id);
        $members->delete();
        return redirect('/members');
    }
}
