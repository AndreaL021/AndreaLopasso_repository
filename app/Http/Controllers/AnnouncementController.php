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

    
    public function show()
    {
        $announcements=Auth::user()->announcements()->orderByDesc('created_at')->get();

        return view('announcement.show', compact('announcements'));
    }

    
    public function edit(Announcement $announcement)
    {
        return view('announcement.edit', compact('announcement'));
    }

    
    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        if (Auth::user()->name === $announcement->user->name) {
        //     if ($request->file('img')) {
        //         $announcement->update([
        //             'title'=>$request->title,
        //             'body'=>$request->body,
        //             'price'=>$request->price,
        //             'category_id'=>$request->category_id,
        //             'img'=>$request->file('img')->store('public/img'),
        //         ]);
        //     }else {
                $announcement->update([
                    'title'=>$request->title,
                    'body'=>$request->body,
                    'price'=>$request->price,
                    'category_id'=>$request->category_id,
                ]);
        //     }
        }

        return redirect(route('announcement.show'))->with("status", 'Annuncio modificato correttamente');
    }

    
    public function destroy(Announcement $announcement)
    {
        if (Auth::user()->name === $announcement->user->name) {
        $announcement->delete();
        }
        
        return redirect(route('announcement.show'))->with("status", 'Articolo eliminato correttamente');
    }
}
