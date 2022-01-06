<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PublicController extends Controller
{
    public function __construct(){
        
        $categories=Category::all();
        View::share('categories', $categories);
    }



    public function index(){

        $announcements = Announcement::where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('welcome', compact('announcements'));
    }



    public function category(Category $category){
        // dd($category->name);

        $announcements=$category->announcements()
        ->where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        ->paginate(6);
        // $announcements->
        $name= $category->name;
        return view('announcement/category', compact('announcements', 'name'));
    }


    public function detail(Announcement $announcement){
        return view('announcement.detail', compact('announcement'));
    }


}
