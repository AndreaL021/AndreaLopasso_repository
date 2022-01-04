<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        
        $categories=Category::all();
        View::share('categories', $categories);
    }

    
    public function create(Request $request)
    {
        return view('announcement.create');
    }

    
    public function store(AnnouncementRequest $request)
    {
        $announcement= Auth::user()->announcements()->create([
             
            'title'=>$request->title,
            'body'=>$request->body,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            
        ]);

        return redirect(route('homepage'))->with("status", 'L\'articolo è stato inserito, in attesa di essere accettato da un revisore');;
    }

    
    public function show(Announcement $announcement)
    {
        //
    }

    
    public function edit(Announcement $announcement)
    {
        //
    }

    
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    
    public function destroy(Announcement $announcement)
    {
        //
    }
}
