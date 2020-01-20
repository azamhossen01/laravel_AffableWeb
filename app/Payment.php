<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function student(){
        return $this->belongsTo(Student::clsss);
    }

    public function payment_details(){
        return $this->hasMany(PaymentDetail::class);
    }
}
