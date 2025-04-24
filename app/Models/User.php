<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'gender', 'age', 'contact'];


    // Mutator for the 'contact' attribute
    // Automatically encrypts the contact value before saving to the database
    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = Crypt::encryptString($value);
    }

    // Accessor for the 'contact' attribute
    // Automatically decrypts the contact value when accessed
    public function getContactAttribute($value)
    {
        return Crypt::decryptString($value);
    }


    // Accessor for the 'name' attribute
    // Capitalizes the first letter of the name when retrieved
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // Accessor for the 'gender' attribute
    // Capitalizes the first letter, e.g., "male" => "Male"
    public function getGenderAttribute($value)
    {
        return ucfirst($value);
    }

}
