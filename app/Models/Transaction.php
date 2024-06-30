<?php

namespace App\Models;

use Modules\Client\Entities\Model as Client;
use Modules\Order\Entities\Model as Order;

class Transaction extends BaseModel
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

} //end of class