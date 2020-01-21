<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function payment_details(){
        return $this->hasMany(PaymentDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
