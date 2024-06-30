<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{ env('APP_NAME') }} - Order Summary</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="telephone=no" name="format-detection">
    <meta content= "width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" name="viewport">
    <style>
        .main-table td, .main-table th {
            text-align: center;
            padding: 5px;
            border-top: 1px solid #333;
            margin: 0 -1px;
        }

        .main-table tr {
            border: 1px solid #333;
        }
    </style>
</head>

<body style="margin:0; padding:10px 0 0 0;" bgcolor="#FFFFFF">
<table align="center" cellpadding="0" cellspacing="0" width="95%%" style="padding:15px;">
    <tr>
        <td align="center">
            <table align="center" border="1" cellpadding="0" cellspacing="0" width="600px" style="margin:15px; border: none;" bgcolor="#FFFFFF">
                <tr>
                    <td align="center" style="padding:5px;">
                        <a href="https://tt.emcan-group.com" target="_blank">
                            <img src="{{ asset(setting('logo')) }}" alt="Logo" style="width:100px; width:100px; border:0;" />
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table align="center" cellpadding="0" cellspacing="0" width="95%%" style="padding:15px;">
    <tr>
        <td align="center">
            <table align="center" border="1" cellpadding="0" cellspacing="0" width="600px" style="margin:15px;padding:15px;border-collapse: separate; border-spacing: 5px 5px;border: 1px solid #DDB864;" bgcolor="#FFFFFF">
                <tr>
                    <td bgcolor="#ffffff" style="padding: 30px 0;text-align: center;font-size: 24px;background: #f7efa7;">
                        New Order #{{ $order['id'] }}
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding:10px;">
                        <table>
                            <tr>
                                You&#39;ve recived the following order from {{ env('APP_NAME') }}
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding:10px;">
                        <table>
                            <tr>
                                Order #{{ $order['id'] }}
                                <span style="color: #DDB864">( {{ $order['created_at'] }} )</span>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding:10px 0;">
                        <table style="width: 100%;text-align: center;">
                            <tr>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Product</th>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Price</th>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Size</th>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Color</th>
                            </tr>

                            @foreach ($order->Products as $orderProduct)
                                <tr>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ $orderProduct['title_en'] }}</td>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ format_number($orderProduct->price * $orderProduct->pivot->quantity * Country()->currancy_value)  .' '. Country()->currancy_code }}</td>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ Size($orderProduct->pivot->size_id)?->title . Size($orderProduct->pivot->size_id)?->parent->title }}</td>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">{{ Color($orderProduct->pivot->color_id)?->title() }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Sub Total :</th>
                                <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{$order['coupon'] > 0?number_format(  $order['sub_total_after_coupon']  * Country()->currancy_value, Country()->decimals, ',', ',') .' '. Country()->currancy_code : number_format(  $order['sub_total']  * Country()->currancy_value, Country()->decimals, ',', ',') .' '. Country()->currancy_code }}</td>
                            </tr>
                            @if($order['discount'] > 0)
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Discount :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ number_format( $order['discount'] * Country()->currancy_value, Country()->decimals, ',', ',') .' '. Country()->currancy_code}}</td>
                                </tr>
                            @endif
                            @if($order['coupon'] > 0)
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">@lang('trans.Coupon') :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ number_format( $order['coupon'] * Country()->currancy_value, Country()->decimals, ',', ',') .' '. Country()->currancy_code}}</td>
                                </tr>
                            @endif
                            <tr>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">VAT :</th>
                                <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ number_format( $order['vat'] * Country()->currancy_value, Country()->decimals, ',', ',') .' '. Country()->currancy_code}}</td>
                            </tr>
                            @if($order['charge_cost'] > 0)
                                <tr>
                                    <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Shipping :</th>
                                    <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ number_format( $order['charge_cost'] * Country()->currancy_value, Country()->decimals, ',', ',') .' '. Country()->currancy_code}}</td>
                                </tr>
                            @endif
                            <tr>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Payment Method :</th>
                                <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ $order->Payment['title_en'] }}</td>
                            </tr>
                            <tr>
                                <th style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" scope="col">Total :</th>
                                <td style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important" colspan="4">{{ number_format( $order['net_total'] * Country()->currancy_value, Country()->decimals, ',', ',') .' '. Country()->currancy_code }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @if ( $order->address)
                    <tr>
                        <td style="font-size: 28px; color: #DDB864;font-weight: bold">
                            Billing Address
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important">
                            <table>
                                @if($order->address['first_name'] != null)
                                    <p>Name: {{ $order->address['first_name'].' '.$order->address['last_name']}}</p>
                                @else
                                    <p>Name: {{ $order->client['name']}}</p>
                                @endif
                                <p>Phone: {{ $order->client['phone'] }}</p>
                                <p>Email: {{ $order->client['email'] }}</p>
                                <p>Country: {{ $order->address->country['title_en'] }}</p>
                                @if($order->address->region_id == null)
                                     <p>City: {{ $order->address->city }}</p>
                                     <p>Address: {{ $order->address->address1.' ,'.$order->address->address2.' ,'.$order->address->state }}</p>
                                @else
                                     <p>Region: {{ $order->address['region_'.lang()] }}</p>
                                     <p>Block: {{ $order->address->block }}</p>
                                     <p>Road: {{ $order->address->road }}</p>
                                     <p>Building No: {{ $order->address->building_no }}</p>
                                     <p>Floor No: {{ $order->address->floor_no }}</p>
                                     <p>Floor No: {{ $order->address->floor_no }}</p>
                                     <p>Apartment No: {{ $order->address->apartment }}</p>
                                     <p>Apartment Type: {{ $order->address->apartmentType }}</p>
                                     <p>Additional Directions: {!! $order->address->additional_directions !!}</p>
                                @endif


                            </table>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 0.5rem 0.5rem;border: #CCC 1px solid !important">
                            <table>
                                <p>Type: @lang('trans.Pickup')</p>
                            </table>
                        </td>
                    </tr>
                @endif

                @if ($order['coupon'] > 0)
                    <tr>
                        <td>
                            Congratulations On The Sale
                        </td>
                    </tr>
                @endif
            </table>
        </td>
    </tr>
</table>
</body>
</html>