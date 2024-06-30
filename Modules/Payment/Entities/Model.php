<?php

namespace Modules\Payment\Entities;

use App\Models\BaseModel;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'payments';

    // 1- internal
    // 2- pickup store
    // 3- international

} //end of class
