<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    

    public function contacts(){
        $announcement=0;
        return view('contacts', compact('announcement'));
    }

    public function contacts2(Announcement $announcement){
        return view('contacts', compact('announcement'));
    }
    
    public function message(ContactRequest $req, $announcement){
        if ($announcement==0) {
            $a=$announcement;
            $user= Auth::user()->name;
            $email= Auth::user()->email;
            $message= $req->input('message');
            $contact=compact('email', 'user', 'message', 'a');
            Mail::to($email)->send(new ContactMail($contact));
        }else{
            $announcement= Announcement::find($announcement);
            $announcement= $announcement->id;
            $a="Numero annuncio rifiutato: $announcement";
            $user= Auth::user()->name;
            $email= Auth::user()->email;
            $message= $req->input('message');
            $contact=compact('email', 'user', 'message', 'a');
            Mail::to($email)->send(new ContactMail($contact));
        }

        return redirect(route('homepage'))->with("status", 'La tua segnalazione è andata a buon fine');
    }
}
