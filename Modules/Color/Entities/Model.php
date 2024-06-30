<?php

namespace Modules\Color\Entities;

use App\Models\BaseModel;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductItem;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'colors';


    public function Items()
    {
        return $this->hasMany(ProductItem::class);
    }



} //end of class
