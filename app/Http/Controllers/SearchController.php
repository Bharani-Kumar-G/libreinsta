<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $searchTerm = $request->input('search');
        $results = User::where('username','like', '%' . $searchTerm . '%')->orWhere('name','like', '%' . $searchTerm . '%')->get();
        return view('search')->with(['results'=>$results]);
    }
}
