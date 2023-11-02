<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//Models

use App\Models\User;

class Apartment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function view()
    {
        return $this->hasMany(View::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'apartment_service', 'apartment_id', 'service_id');
    }
    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function existingSponsorships()
    {
        return $this->belongsToMany(Sponsorship::class)
            ->withPivot('start_date', 'end_date');
    }

}
