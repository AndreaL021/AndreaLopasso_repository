<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable=[
        'business_email',
        'business_name', 
        'address', 
        'CAP', 
        'city', 
        'province', 
        'region'
    ];

    public function user(){
        
        return $this->belongsTo(User::class);
    }
}
