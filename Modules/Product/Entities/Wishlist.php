<?php

namespace Modules\Product\Entities;

use App\Models\BaseModel;

class Wishlist extends BaseModel
{
    protected $guarded = [];

    protected $table = 'wishlist';

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}//end of class
