<?php

namespace Modules\Product\Entities;

use App\Models\BaseModel;
use Modules\Color\Entities\Model as Color;
use Modules\Size\Entities\Model as Size;


class ProductItem extends BaseModel
{
    protected $guarded = [];

    protected $table = 'product_item';

//    public function Product()
//    {
//        return $this->belongsTo(Product::class);
//    }
//
    public function Color()
    {
        return $this->belongsTo(Color::class, 'item_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function item()
    {
        return $this->morphTo();
    }


}
