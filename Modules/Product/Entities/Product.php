<?php

namespace Modules\Product\Entities;

use App\Models\BaseModel;
use Modules\Category\Entities\Model as Category;
use Modules\Color\Entities\Model as color;
use Modules\Size\Entities\Model as size;

class Product extends BaseModel
{
    protected $guarded = [];

    protected $table = 'products';


    public static function getSortingOptions()
    {
        return [
            1 => __('trans.default_sorting'),
            2 => __('trans.sort_by_popularity'),
            3 => __('trans.sort_by_price') . ': ' . __('trans.low_to_high'),
            4 => __('trans.sort_by_price') . ': ' . __('trans.high_to_low'),
        ];
    }

    /*** Start Relations ***/
    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function Gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }

//    public function Items()
//    {
//        return $this->hasMany(ProductItem::class);
//    }

    public function Items()
    {
        return $this->hasMany(ProductItem::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_item','product_id','color_id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function allSizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }
    /*** End Relations ***/











    public function Price()
    {
        return format_number(($this->price * Country()->currancy_value),2);
    }
    public function RealPrice()
    {
        if ($this->discount_value && $this->discount_from < now() && $this->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->discount_value)) * Country()->currancy_value);
        } else {
            return format_number($this->price * Country()->currancy_value);
        }
    }
    public function PriceWithCurrancy()
    {
        if ($this->discount_value && $this->discount_from < now() && $this->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->discount_value)) * Country()->currancy_value).' '.Country()->currancy_code;
        } else {
            return format_number($this->price * Country()->currancy_value).' '.Country()->currancy_code;
        }
    }
    public function CalcPrice()
    {
        if ($this->discount_value && $this->discount_from < now() && $this->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->discount_value)) * Country()->currancy_value);
        } else {
            return format_number($this->price * Country()->currancy_value);
        }
    }
    public function CalcPriceWithCurrancy()
    {
        if ($this->discount_value && $this->discount_from < now() && $this->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->discount_value)) * Country()->currancy_value).' '.Country()->currancy_code;
        } else {
            return format_number($this->price * Country()->currancy_value).' '.Country()->currancy_code;
        }
    }

    public function scopeHasDiscount($query)
    {
        return $query->where('discount_value', '>', 0)->where('discount_from', '<', now())->where('discount_to', '>', now());
    }

    public function HasDiscount()
    {
        return $this->discount_value && $this->discount_from < now() && $this->discount_to > now();
    }

    public function RealPriceWithQuantity($quantity)
    {
        if ($this->discount_value && $this->discount_from < now() && $this->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->discount_value)) * Country()->currancy_value * $quantity);
        } else {
            return format_number($this->price * Country()->currancy_value * $quantity);
        }
    }


    public function RealPriceWithQuantityMainCountry($quantity)
    {
        if ($this->discount_value && $this->discount_from < now() && $this->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->discount_value)) * $quantity);
        } else {
            return format_number($this->price * $quantity);
        }
    }

    public function RealPriceMainCountry()
    {
        if ($this->discount_value && $this->discount_from < now() && $this->discount_to > now()) {
            return format_number(($this->price - ($this->price / 100 * $this->discount_value)));
        } else {
            return format_number($this->price);
        }
    }


} //end of class
