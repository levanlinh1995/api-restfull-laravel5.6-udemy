<?php

namespace App;

use App\Buyer;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public $transformer = TransactionTransformer::class;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable =[
        'quantity',
        'buyer_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
