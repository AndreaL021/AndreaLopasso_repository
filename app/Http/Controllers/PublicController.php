<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PublicController extends Controller
{
    public function index(){

        $announcements = Announcement::where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        ->paginate(9);

        return view('welcome', compact('announcements'));
    }



    public function category(Category $category){

        $announcements=$category->announcements()
        ->where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        ->paginate(9);
        $name= $category->name;
        return view('announcement.category', compact('announcements', 'name'));
    }


    public function search(Request $request){
        $q = $request->input('q');
        $announcements = Announcement::search($q)
        ->where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('announcement.search-page', compact('q', 'announcements'));
    }


    public function detail(Announcement $announcement){
        $first= $announcement->images->first();
        $first=$first->id;
        return view('announcement.detail', compact('announcement', 'first'));
    }


    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
