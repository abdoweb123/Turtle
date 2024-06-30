@extends('Admin.layout')

@section('pagetitle', __('trans.orders'))
@section('content')

    <div class="row">
        <div class="my-2 col-6 text-sm-end" style="text-align:{{lang() == 'en' ? 'left' : 'right' }}  !important;">
            <button type="button" id="DeleteSelected" onclick="DeleteSelected('orders')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
        </div>

        <form action="{{route('admin.orders.index')}}" method="get" class="my-2 col-6 text-sm-end d-flex">
            @csrf
            <label class="my-2 mx-1">@lang('trans.from')</label>
            <input type="datetime-local" name="from" class="form-control m-1" value="{{ request()->input('from') ?? '' }}">
            <label class="my-2 mx-1">@lang('trans.to')</label>
            <input type="datetime-local" name="to" class="form-control m-1" value="{{ request()->input('to') ?? '' }}">
            <button type="submit" class="btn text-white m-auto" style="background-color: {{setting('main_color')}}">@lang('trans.search')</button>
        </form>
    </div>

    <table class="table table-bordered data-table" >
        <thead>
            <tr>
                <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
                <th>@lang('trans.name')</th>
                <th>@lang('trans.phone')</th>
                <th>#</th>
                <th>@lang('trans.status')</th>
                <th>@lang('trans.netTotal')</th>
                <th>@lang('trans.Payment')</th>
                <th>@lang('trans.type')</th>
                <th>@lang('trans.time')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Models as $Order)
            <tr>
                <td>
                    <input type="checkbox" class="DTcheckbox" value="{{ $Order->id }}"> - {{ $Order->id }}
                </td>
                <td>{{ $Order->Client->name?? $Order->address?->first_name }}</td>
                <td>{{ $Order->Client->phone?? $Order->address?->phone }}</td>
                <td><a data-bs-toggle="modal" data-bs-target="#order-{{ $Order['id'] }}" href="#">@lang('trans.details')</a></td>
                <td style="text-align:center;">
                    @if($Order->delivery_id == 2)
                        <p>
                            {{  __('trans.Receipt_shop')  }}
                        </p>
                    @else
                        @if($Order['status'] == '3')
                            <p>
                                {{  __('trans.delivered')  }}
                            </p>
                        @else
                            <select class="select form-control">
                                <option data-status="4" data-id="{{ $Order['id'] }}" {{$Order['status'] == '4' ? 'selected' : ''}}>{{  __('trans.refused')  }}</option>
                                <option data-status="0" data-id="{{ $Order['id'] }}" {{$Order['status'] == '0' ? 'selected' : ''}}>{{  __('trans.pending')  }}</option>
                                <option data-status="1" data-id="{{ $Order['id'] }}" {{$Order['status'] == '1' ? 'selected' : ''}}>{{  __('trans.preparing')  }}</option>
                                <option data-status="2" data-id="{{ $Order['id'] }}" {{$Order['status'] == '2' ? 'selected' : ''}}>{{  __('trans.ready')  }}</option>
                                <option data-status="3" data-id="{{ $Order['id'] }}" {{$Order['status'] == '3' ? 'selected' : ''}}>{{  __('trans.send_order')  }}</option>
                            </select>
                        @endif
                    @endif
                </td>
                <td>{{ $Order['net_total'] . ' '. Country()->currancy_code }}</td>
                <td>{{ $Order->Payment ? $Order->Payment->title() : '' }}</td>
                <td>{{ $Order->Delivery ? $Order->Delivery->title() : '' }}</td>
                <td>{{ $Order['created_at'] }}</td>
                <td>
                    <form class="formDelete" method="POST" action="{{ route('admin.orders.destroy', $Order) }}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                            <i class="fa-solid fa-eraser"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    
    @foreach($Models as  $Order)
    <div class="modal fade" id="order-{{ $Order['id'] }}" tabindex="-1" aria-labelledby="order-{{ $Order['id'] }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="order-{{ $Order['id'] }}Label">@lang('trans.orderDetails')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="display:contents">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover text-center">
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <h4>{{ __("trans.client") }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.name") }}</th>
                                <td>
                                @if($Order->Client)
                                    {{ $Order->Client->name }}
                                @elseif($Order->address)
                                    {{ $Order->address->first_name }} {{ $Order->address->last_name }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.email") }}</th>
                                <td colspan="3">
                                @if($Order->Client)
                                    {{ $Order->Client->email }}
                                @elseif($Order->address)
                                    {{ $Order->address->email }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.phone") }}</th>
                                <td colspan="3">
                                @if($Order->Client)
                                    {{ $Order->Client->phone_code . $Order->Client->phone }}
                                @elseif($Order->address)
                                    {{ $Order->address->phone }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <h4>{{ __("trans.Payment") }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.sub_total") }}</th>
                                <td colspan="3">{{ $Order->sub_total . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @if($Order->charge_cost > 0)
                            <tr>
                                <th colspan="3">{{ __("trans.charge_cost") }}</th>
                                <td colspan="3">{{ $Order->charge_cost . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endif
                            @if($Order->discount > 0)
                            <tr>
                                <th colspan="3">{{ __("trans.discount") }}</th>
                                <td colspan="3">{{ $Order->discount . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="3">{{ __("trans.vat") }}</th>
                                <td colspan="3">{{ $Order->vat . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @if($Order->coupon > 0)
                            <tr>
                                <th colspan="3">{{ __("trans.coupon") }} ({{ $Order->coupon_text }})</th>
                                <td colspan="3">{{ $Order->coupon . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="3">{{ __("trans.net_total") }}</th>
                                <td colspan="3">{{ $Order->net_total . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @if ($Order->address)
                                <tr>
                                    <td colspan="6">
                                        <h4>{{ __("trans.address") }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("trans.country") }}</th>
                                    <td colspan="3">{{ $Order->address->country->title() }}</td>
                                </tr>
                                @if($Order->address->country_id == 1)
                                    <tr>
                                        <th colspan="3">{{ __("trans.block") }}</th>
                                        <td colspan="3">{{ $Order->address->block }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.road") }}</th>
                                        <td colspan="3">{{ $Order->address->road }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.building_no") }}</th>
                                        <td colspan="3">{{ $Order->address->building_no }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.floor_no") }}</th>
                                        <td colspan="3">{{ $Order->address->floor_no }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.apartment") }}</th>
                                        <td colspan="3">{{ $Order->address->apartment }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.apartmentType") }}</th>
                                        <td colspan="3">{{ $Order->address->apartmentType }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.additional_directions") }}</th>
                                        <td colspan="3">{{ $Order->address->additional_directions }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th colspan="3">{{ __("trans.city") }}</th>
                                        <td colspan="3">{{ $Order->address->city }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.address1") }}</th>
                                        <td colspan="3">{{ $Order->address->address1 }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.address2") }}</th>
                                        <td colspan="3">{{ $Order->address->address2 }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">{{ __("trans.state") }}</th>
                                        <td colspan="3">{{ $Order->address->state }}</td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <th colspan="3">{{ __("trans.branch") }}</th>
                                    <td colspan="3">{{ $Order->Branch?->title() }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th colspan="3">{{ __("trans.gift_color") }}</th>
                                <td colspan="3">{{ $Order->address?->gift_color }}</td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.gift_comment") }}</th>
                                <td colspan="3">{{ $Order->address?->gift_comment }}</td>
                            </tr>

                        </tbody>
                    </table>
    
                    <h4 class="text-center">{{ __("trans.products") }}</h4>
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>{{ __("trans.title") }}</th>
                                @if($Order->Products->sum('color_id') > 0)
                                <th>{{ __("trans.color") }}</th>
                                @endif
                                <th>{{ __("trans.quantity") }}</th>
                                <th>{{ __("trans.price") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Order->Products as $item )
                            <tr>
                                <td>{{ $item->title() }}</td>
                                @if($Order->Products->sum('color_id') > 0)
                                <td>{{ Color($item->pivot->color_id)?->title() }}</td>
                                @endif
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ format_number($item->price * $item->pivot->quantity * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('trans.close')</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    


@endsection


@section('js')
    <script type="text/javascript">
        $(document).on('change', '.select', function() {
            $.ajax({
                url: "{{ route('admin.orders.status') }}"
                , type: "GET"
                , data: {
                    _token: "{{ csrf_token() }}"
                    , id: $(this).find(':selected').attr('data-id')
                    , status: $(this).find(':selected').attr('data-status')
                    , follow: $(this).find(':selected').attr('data-follow')
                , },
                success: function(response) {
                    Swal.fire({
                        text: response.message, // This will display the response message
                        icon: response.status,
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        text: 'An error occurred: ' + error, // Display the error message
                        icon: response.status,
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endsection