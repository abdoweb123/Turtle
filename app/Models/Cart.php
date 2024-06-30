<?php

namespace App\Models;

use Modules\Color\Entities\Model as Color;
use Modules\Product\Entities\ProductItem;
use Modules\Size\Entities\Model as Size;
use Modules\Product\Entities\Product;

class Cart extends BaseModel
{
    protected $guarded = [];

    protected $table = 'cart';


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }


    public function color()
    {
        return $this->belongsTo(Color::class);
    }


    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function item()
    {
        return $this->belongsTo(ProductItem::class,'item_id');
    }


} //end of class
