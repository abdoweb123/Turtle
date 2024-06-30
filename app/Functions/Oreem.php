<?php

namespace App\Functions;

class Oreem
{
    public static function CreateTask($Order){
        $branch_id = $Order->branch_id;
        $client_id = $Order->client_id;
        $payment_method = $Order->payment()->first()->title(); //cash
        $client_address_id = $Order->address_id;

        $branch_name = 'Main Branch';
        $branch_lat = '26.1697441';
        $branch_long = '50.5554756';
        $branch_address = 'Isa Town bahrain';
        $branch_email = 'info@domain.com';
        $branch_phone = "973 3677 6733";

        $Client = $Order->Client;
        $client_name = $Client->name;
        $client_phone = $Client->phone;
        $client_email = $Client->email;

        $Address = $Order->address()->first();
        $address_longitude = $Address->lang ?? $branch_long;
        $address_latitude = $Address->lat ?? $branch_lat;
        $block = $Address->block;
        $road = $Address->road;
        $building = $Address->building_no;
        $flat = $Address->apartment;
        $address_special_inst = preg_replace('/[^\x{0600}-\x{06FF}A-Za-z !@#$%^&*()]/u', '', $Address->additional_directions);
        $client_address_full = $block.$road.$building.$flat;

        $cash_need_to_be_collected = $Order->payment_id == 1 ? $Order->net_total : 0;

        $fields = (object) [];

        $fields->api_key = '8C1AA313-CBF4-D041-62AA-09828B6D1FBE';
        $fields->order_id = $Order->id;
        $fields->building = $building;
        $fields->flat = $flat;
        $fields->road = $road;
        $fields->block = $block;
        $fields->cash = $cash_need_to_be_collected ?? 0;
        $fields->customer_name = $client_name ?? '';
        $fields->customer_phone = $client_phone ?? '';
        $fields->item_info = '';
        foreach($Order->Products as $key => $item){
            $fields->item_info .= $item['title_'.lang()]. ' -- ';
        }
        $fields->comments = $address_special_inst;
        // dd($fields);
        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://food.esoq.com/api/createTask');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $Task = json_decode($server_output, true);

        return $Task;
    }

}