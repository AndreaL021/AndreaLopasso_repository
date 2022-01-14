<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use App\Jobs\Watermark;
use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionRemoveFaces;
use App\Jobs\GoogleVisionSafeSearchImage;

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
        $uniqueSecret= $request->input('uniqueSecret');
        $images = session()->get("images.{$uniqueSecret}",[]);
        $removedImages = session()->get("removedimages.{$uniqueSecret}",[]);
        $images= array_diff($images, $removedImages);

        if ($images!=null) {
            $announcement= Auth::user()->announcements()->create([
                'title'=>$request->title,
                'body'=>$request->body,
                'price'=>$request->price,
                'category_id'=>$request->category_id,
            ]);

            foreach($images as $image){
                $i = new AnnouncementImage();

                $fileName = basename($image);
                $newFileName = "public/announcements/{$announcement->id}/{$fileName}";
                Storage::move($image, $newFileName);

                $i->file = $newFileName;
                $i->announcement_id = $announcement->id;
                $i->save();
                if ($announcement->category->id != 5) {
                    GoogleVisionSafeSearchImage::withChain([
                        new GoogleVisionLabelImage($i->id),
                        new GoogleVisionRemoveFaces($i->id),
                        new Watermark($i->id),
                        new ResizeImage($i->file,300,200),
                        new ResizeImage($i->file,300,300),
                        new ResizeImage($i->file,600,400)
                    ])->dispatch($i->id);
                }else{
                    GoogleVisionSafeSearchImage::withChain([
                        new GoogleVisionLabelImage($i->id),
                        new Watermark($i->id),
                        new ResizeImage($i->file,300,200),
                        new ResizeImage($i->file,300,300),
                        new ResizeImage($i->file,600,400)
                    ])->dispatch($i->id);
                }
            }
            File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));
            return redirect(route('homepage'))->with("status", 'L\'annuncio è stato inserito, in attesa di essere accettato da un revisore');
        }else{
            return redirect(route('announcement.create'))->with("status", 'L\'annuncio richiede almeno un\'immagine.');
        }
    }


    public function uploadImage(Request $request){
        $uniqueSecret= $request->input('uniqueSecret');
        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");
        
        dispatch(new ResizeImage($fileName,120,120));
        
        session()->push("images.{$uniqueSecret}", $fileName);
        
        return response()->json(['id' =>$fileName]);
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
                'src' =>AnnouncementImage::getUrlByFilePath($image, 120, 120),
            ];
        }
        return response()->json($data);
    }
    

    public function show(){
        $announcements=Auth::user()->announcements()->orderByDesc('created_at')->get();

        return view('announcement.show', compact('announcements'));
    }

    
    public function edit(Announcement $announcement, Request $request){
        $uniqueSecret = $request->old('uniqueSecret', base_convert(sha1(uniqid(mt_rand())), 16, 36));
        return view('announcement.edit', compact('announcement', 'uniqueSecret'));
    }

    
    public function update(AnnouncementRequest $request, Announcement $announcement){
        if (Auth::user()->name === $announcement->user->name) {
            $uniqueSecret= $request->input('uniqueSecret');
            $images = session()->get("images.{$uniqueSecret}",[]);
            $oldImages= $announcement->images;
            $removedImages = session()->get("removedimages.{$uniqueSecret}",[]);
            $images= array_diff($images, $removedImages);

            if ($images!=null|| $oldImages->count()>1) {

                $announcement->update([
                    'title'=>$request->title,
                    'body'=>$request->body,
                    'price'=>$request->price,
                    'category_id'=>$request->category_id,
                ]);
                if ($images!=null) {
                    foreach($images as $image){
                        $i = new AnnouncementImage();

                        $fileName = basename($image);
                        $newFileName = "public/announcements/{$announcement->id}/{$fileName}";
                        Storage::move($image, $newFileName);

                        $i->file = $newFileName;
                        $i->announcement_id = $announcement->id;
                        $i->save();
                        if ($announcement->category->id != 5) {
                            GoogleVisionSafeSearchImage::withChain([
                                new GoogleVisionLabelImage($i->id),
                                new GoogleVisionRemoveFaces($i->id),
                                new Watermark($i->id),
                                new ResizeImage($i->file,300,200),
                                new ResizeImage($i->file,300,300),
                                new ResizeImage($i->file,600,400)
                            ])->dispatch($i->id);
                        }else{
                            GoogleVisionSafeSearchImage::withChain([
                                new GoogleVisionLabelImage($i->id),
                                new Watermark($i->id),
                                new ResizeImage($i->file,300,200),
                                new ResizeImage($i->file,300,300),
                                new ResizeImage($i->file,600,400)
                            ])->dispatch($i->id);
                        }
                    }
                }
                File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));
            }else{
                return redirect(route('announcement.edit'))->with("status", 'L\'annuncio richiede almeno un\'immagine.');
            }
        }

        return redirect(route('announcement.show'))->with("status", 'Annuncio modificato correttamente');
    }

    public function deleteImages(AnnouncementImage $image){
        $announcement=Announcement::find($image->announcement_id);
        if (Auth::user()->name === $announcement->user->name) {
            $image->delete();
        }
        return redirect(route('announcement.edit', compact('announcement')))->with("status", 'Immagine rimossa correttamente');
    }
    
    public function destroy(Announcement $announcement){
        if (Auth::user()->name === $announcement->user->name) {
            foreach($announcement->images()->get() as $image ){
                $image->delete();
            }
            $announcement->delete();
        }
        
        return redirect(route('announcement.show'))->with("status", 'Articolo eliminato correttamente');
    }
}
