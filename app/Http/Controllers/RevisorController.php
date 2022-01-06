<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RevisorController extends Controller
{
    public function __construct()
    {
        $categories=Category::all();
        View::share('categories', $categories);
        
        $this->middleware('auth.revisor');
    }
    
    public function index()
    {
        $announcements=Announcement::where('is_accepted', 0)->first();
        $announcement= Announcement::where('is_accepted', null)
        ->orderBy('created_at', 'desc')
        ->first();
        // dd($announcement);

        return view('revisor.home', compact('announcement', 'announcements'));
    }
    
    public function accept($id)
    {
        $announcement= Announcement::find($id);
        $announcement->is_accepted= true;
        $announcement->save();
        return redirect(route('revisor.home'))->with("status", 'Articolo accettato');
    }

    public function reject($id)
    {
        $announcement= Announcement::find($id);
        $announcement->is_accepted= false;
        $announcement->save();
        return redirect(route('revisor.home'))->with("status", 'Articolo archiviato');
    }
    
    public function archive()
    {
        $announcement= Announcement::where('is_accepted', 0)
        ->orderBy('created_at', 'desc')
        ->first();

        return view('revisor.archive', compact('announcement'));
    }
    
    public function restore($id)
    {
        $announcement= Announcement::find($id);
        $announcement->is_accepted= null;
        $announcement->save();
        return redirect(route('revisor.home'))->with("status", 'Articolo ripristinato');
    }

    public function delete($id){
        $announcement= Announcement::find($id);
        if ($announcement->is_accepted == false) {
            $announcement->delete();
        }
        return redirect(route('revisor.home'))->with("status", 'Articolo eliminato correttamente');
    }
}
