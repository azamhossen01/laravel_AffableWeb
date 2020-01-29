<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function certificates(){
        return $this->hasMany(Certificate::class);
    }
}
