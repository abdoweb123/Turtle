<?php

namespace Modules\Product\Entities;

use App\Models\BaseModel;
use Modules\Size\Entities\Model as Size;


class ProductSize extends BaseModel
{
    protected $guarded = [];

    protected $table = 'product_size';

    public function Product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }

}//end of class
