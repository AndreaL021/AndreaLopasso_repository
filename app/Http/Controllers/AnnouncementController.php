<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
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
        $uniqueSecret = $request->old('uniqueSecret', base_convert(sha1(uniqid(mt_rand())), 16, 36));

        return view('announcement.create', compact('uniqueSecret'));
    }

    
    public function store(AnnouncementRequest $request)
    {
        $announcement= Auth::user()->announcements()->create([
            'title'=>$request->title,
            'body'=>$request->body,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
        ]);

        $uniqueSecret= $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}",[]);
        $removedImages = session()->get("removedimages.{$uniqueSecret}",[]);
        
        $images= array_diff($images, $removedImages);

        foreach($images as $image){
            $i = new AnnouncementImage();
            
            $fileName = basename($image);
            $newFileName = "public/announcements/{$announcement->id}/{$fileName}";
            Storage::move($image, $newFileName);
       
            $i->file = $newFileName;
            $i->announcement_id = $announcement->id;

            $i->save();
        }
        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));

        return redirect(route('homepage'))->with("status", 'L\'annuncio è stato inserito, in attesa di essere accettato da un revisore');
    }


    public function uploadImage(Request $request){
        $uniqueSecret= $request->input('uniqueSecret');
        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");
        
        session()->push("images.{$uniqueSecret}", $fileName);
        return response()->json(
            [
            'id' =>$fileName
            ]
        );
    }


    public function removeImage(Request $request){

        $uniqueSecret= $request->input('uniqueSecret');
        $fileName = $request->input('id');
        session()->push("removedimages.{$uniqueSecret}", $fileName);
        Storage::delete($fileName);

        return response()->json('ok');
    }


    public function getImages(Request $request){
        $uniqueSecret = $request->input('uniqueSecret');
        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        $data =[];

        foreach ($images as $image){
            $data[] = [
                'id' =>$image,
                'src' =>Storage::url($image),
            ];
        }
        return response()->json($data);
    }
    

    public function show(){
        $announcements=Auth::user()->announcements()->orderByDesc('created_at')->get();

        return view('announcement.show', compact('announcements'));
    }

    
    public function edit(Announcement $announcement){
        return view('announcement.edit', compact('announcement'));
    }

    
    public function update(AnnouncementRequest $request, Announcement $announcement){
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

    
    public function destroy(Announcement $announcement){
        if (Auth::user()->name === $announcement->user->name) {
        $announcement->delete();
        }
        
        return redirect(route('announcement.show'))->with("status", 'Articolo eliminato correttamente');
    }
}
