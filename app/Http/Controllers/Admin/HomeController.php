<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Client\Entities\Model as Client;
use Modules\Category\Entities\Model as Category;
use Modules\Service\Entities\Model as Service;
use Modules\Order\Entities\Model as Order;
use Modules\Product\Entities\Product;

class HomeController extends BasicController
{
    public function index(Request $request)
    {
        $chartOrders = DB::table('orders')->whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->select([DB::raw('DATE(created_at) AS label'), DB::raw('(COUNT(*)) as y')])->groupBy('label')->get()->toarray();
        $chartChanges = DB::table('orders')->where('status', 1)->select(DB::raw('sum(net_total) as y'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as label"))->groupBy('label')->orderBy('created_at')->get()->toarray();
        $chartUsers = Client::whereNotNull('created_at')->whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->select([DB::raw('DATE(created_at) AS label'), DB::raw('(COUNT(*)) as y')])->groupBy('label')->get()->toarray();

        $categoriesCount =Category::count();
        $productsCount = Product::count();
        $clientsCount = Client::count();
        $currentOrdersCount = DB::table('orders')->where('status','!=', 3)->count(); //3- delivered
        $previousOrdersCount = DB::table('orders')->where('status', 3)->count(); //3- delivered
        $servicesCount = Service::Active()->count();
        $subscribersCount = DB::table('subscribers')->count();

        return view('Admin.home', compact(

            'categoriesCount',
            'productsCount',
            'clientsCount',
            'servicesCount',
            'subscribersCount',
            'currentOrdersCount',
            'previousOrdersCount',
            'chartOrders',
            'chartUsers',
            'chartChanges'
        ));
    }


    // current and past orders
    public function getOrders($type)
    {
        $operator = $type == 'previous' ? '=' : '!=';
        $Models = Order::latest()
            ->with('Branch', 'Client.Country', 'Products', 'Address')
            ->where('status', $operator, 3)
            ->get();

        return view('order::index', compact('Models'));
    }


} //end of class
