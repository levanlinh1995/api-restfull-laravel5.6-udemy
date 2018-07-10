<?php

namespace App;

use App\User;
use App\Transaction;
use App\Transformers\BuyerTransformer;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends User
{
    use SoftDeletes;

    public $transformer = BuyerTransformer::class;
    
    protected $dates = ['deleted_at'];
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
