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

    // Accessor for the contact attribute (decrypting)
    public function getContactAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // Mutator for the contact attribute (encrypting)
    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = Crypt::encryptString($value);
    }

    // Accessor for the name attribute (capitalize the first letter)
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // // Mutator for the email attribute (store in lowercase)
    // public function setEmailAttribute($value)
    // {
    //     $this->attributes['email'] = strtolower($value);
    // }

    // Accessor for the gender attribute (return "Male" or "Female")
    public function getGenderAttribute($value)
    {
        return ucfirst($value);
    }


    // Accessor for decoding a JSON attribute
    public function getEmailAttribute($value)
    {
        return json_decode($value, true);
    }

    // Mutator for encoding an array into JSON before saving
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = json_encode($value);
    }
}
