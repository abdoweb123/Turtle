<?php

namespace Modules\Product\Entities;

use App\Models\BaseModel;
use Modules\Color\Entities\Model as color;

class Gallery extends BaseModel
{
    protected $guarded = [];

    protected $table = 'product_gallery';

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(color::class,'color_id');
    }


} //end of class
