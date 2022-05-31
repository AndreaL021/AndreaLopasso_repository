<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $companies=Company::all();
        if (Auth::user()->company) {
            $activeUserCompany=Auth::user()->company->id;
        }else{
            $activeUserCompany=0;
        }
        return Inertia::render('Users/Index', compact('users', 'companies', 'activeUserCompany'));
    }

    public function create()
    {
        if (Auth::user()->company) {

            return back();
        }
        return Inertia::render('Users/Create');
    }
    

    public function store(CompanyRequest $request)
    {
        if (Auth::user()->company()==null) {
            Auth::user()->company()->create([
                'business_email'=>$request->business_email,
                'business_name'=>$request->business_name, 
                'address'=>$request->address, 
                'cap'=>$request->cap, 
                'city'=>$request->city, 
                'province'=>$request->province, 
                'region'=>$request->region
            ]);
        }
        return Inertia::render('Users/Index');
    }

    public function show(User $user)
    {
        $company=$user->company;
        return Inertia::render('Users/Show', compact('user', 'company'));
    }

    public function edit(User $user)
    {
        $company= $user->company;
        return Inertia::render('Users/Edit', compact('company', 'user'));
    }

    public function update(CompanyRequest $request, User $user)
    {
        dd($user);
        $user->update($request->only('business_name', 'business_email', 'address', 'cap', 'city', 'province', 'region'));
        return back();
        // return Redirect::route('users.index');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->name === $announcement->user->name) {
            foreach($announcement->images()->get() as $image ){
                $image->delete();
            }
            $announcement->delete();
        }
        return Inertia::render('Users/Destroy');
    }
}
