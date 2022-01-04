<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
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
        return view('contacts');
    }
    
    public function message(ContactRequest $req){
        $user= Auth::user()->name;
        $email= Auth::user()->email;
        $message= $req->input('message');
        $contact=compact('email', 'user', 'message');
        Mail::to($email)->send(new ContactMail($contact));

        return redirect(route('homepage'))->with("status", 'La tua segnalazione è andata a buon fine');
    }
}
