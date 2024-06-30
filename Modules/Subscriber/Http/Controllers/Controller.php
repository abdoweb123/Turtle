<?php

namespace Modules\Subscriber\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Subscriber\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::latest()->get();

        return view('subscriber::index', compact('Models'));
    }
}
