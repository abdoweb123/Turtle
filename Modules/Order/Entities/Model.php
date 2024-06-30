<?php

namespace Modules\Order\Entities;

use App\Models\BaseModel;
use Modules\Address\Entities\Model as Address;
use Modules\Branch\Entities\Model as Branch;
use Modules\Client\Entities\Model as Client;
use Modules\Delivery\Entities\Model as Delivery;
use Modules\Payment\Entities\Model as Payment;
use Modules\Product\Entities\Product;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'orders';

    public function orderStatus()
    {   //               0           1         2         3         4
        $status_en = ['pending','preparing','ready','delivered','refused'];
        $status_ar = ['قيد الانتظار','يتم التحضير','جاهز','تم التوصيل','مرفوض'];

        $status = lang() === 'ar' ? $status_ar : $status_en;

        return isset($status[$this->status]) ? $status[$this->status] : '';
    }


    /*** start relations ***/
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('item_id', 'color_id', 'size_id', 'quantity', 'total');
    }

    public function Delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }
    public function Payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

} //end of class
