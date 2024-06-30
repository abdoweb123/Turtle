<?php

namespace Modules\Size\Entities;

use App\Models\BaseModel;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductItem;


class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'sizes';


    public function parent()
    {
        return $this->belongsTo(Model::class, 'parent_id');
    }


    public function children()
    {
        return $this->hasMany(Model::class, 'parent_id');
    }

    public function items()
    {
        return $this->hasMany(ProductItem::class, 'size_id');
    }


} //end of class
