@extends('Client.Layout.index')

@section('title')
  @lang('trans.my_account')
@stop


@section('style')
  <style>
    .form-check .form-check-input {
      margin-left: 0;
    }

    .toggle-password{
      float:{{lang()=='ar'? 'left' : 'right'}}
    }
  </style>
  <style>
    .alert-danger{
      display: none;
    }
    .errors{
      background-color: #cf2e2e;
      color: white;
    }

    @if(lang()== 'ar')
      .inside_sidebar{
      margin-right: 0 !important;
      margin-left: 1rem !important;
    }
    .text-start{
      text-align: right !important;
    }

    #otherCountries, #bahrain{padding-left: 0;}
    #otherCountries .col-sm-12, #bahrain .col-sm-12 {padding-left: 0;}
    @else
    #otherCountries, #bahrain{padding-right: 0;}
    #otherCountries .col-sm-12, #bahrain .col-sm-12{padding-right: 0;}
    @endif

  </style>
@stop


@section('content')
<!------------ header ------------>
<header class="header overflow-hidden bg-primary">
  <!-- header navbar -->
  @include('Client.Layout.MainNavigation')
  <!-- header content -->
  <div class="container py-md-4">
    <section class="row d-flex align-items-center justify-content-center flex-md-row pb-3">
      <!-- content >> text -->
      <div class="col-md-12 col-sm-12">
        <div class="py-6"></div>
      </div>
    </section>
  </div>
</header>
<!------------ header end ------------>

<!-- start My Account -->
<section class="py-3 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between">
          <h4 class="fw-semibold">@lang('trans.my_account')</h4>
          <div>
            <a href="{{route('Client.home')}}" class="text-decoration-none link-info text-danger">
              <i class="fa-solid fa-house"></i>
              <span class="mx-1">@lang('trans.home')</span>
            </a>
            <span class="mx-1">/</span>
            <span class="mx-1">@lang('trans.my_account')</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end My Account -->

<div class="errors mx-6">
  @if($errors->any())
    <div class="alert alert-error">
      @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif
</div>


<section class="py-5 border-bottom">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between">
      <div class="col-md-3 col-12">
        <div class="nav flex-column nav-pills me-3 border inside_sidebar" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="nav-link border-bottom text-secondary py-3 text-start active" id="v-pills-Orders-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Orders" type="button" role="tab" aria-controls="v-pills-Orders" aria-selected="false">
            <i class="fa-solid fa-file-lines mx-1"></i>@lang('trans.orders')
          </button>
          <button class="nav-link border-bottom text-secondary py-3 text-start" id="v-pills-Addresses-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Addresses" type="button" role="tab" aria-controls="v-pills-Addresses" aria-selected="false">
            <i class="fa-solid fa-pen-to-square mx-1"></i>@lang('trans.addresses')
          </button>
          <button class="nav-link border-bottom text-secondary py-3 text-start" id="v-pills-Account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Account" type="button" role="tab" aria-controls="v-pills-Account" aria-selected="false">
            <i class="fa-solid fa-pen-to-square mx-1"></i>@lang('trans.account_details')
          </button>
          <a href="{{route('Client.logout')}}" class="nav-link border-bottom text-secondary py-3 text-start cursor-pointer">
            <i class="fa-solid fa-right-from-bracket mx-1"></i>
            @lang('trans.logout')
          </a>
        </div>
      </div>
      <div class="col-md-9 col-12">
        <div class="tab-content" id="v-pills-tabContent">
          <!-- orders -->
          <div class="tab-pane fade show active" id="v-pills-Orders" role="tabpanel" aria-labelledby="v-pills-Orders-tab" tabindex="0">
            <!-- if no orders -->

            @forelse($Orders as $Order)
            <div class="alert alert-primary blue-alert d-flex justify-content-between rounded-0" role="alert">
               <span> #{{$Order->id}} - {{$Order->created_at->format('Y-m-d')}} - @lang('trans.net_total'): {{format_number($Order->net_total * Country()->currancy_value)}}</span>
               <span>
                   <a class="text-white text-decoration-none" data-bs-toggle="modal" data-bs-target="#order-{{ $Order['id'] }}" href="#">@lang('trans.details')</a>
               </span>
              </div>
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
                          <td colspan="8">
                            <h4>{{ __("trans.client") }}</h4>
                          </td>
                        </tr>
{{--                        Order Number	Order Status	Order Date	Net Total--}}
                        <tr>
                          <th colspan="2">{{ __("trans.order_no") }}</th>
                          <th colspan="2">{{ __("trans.order_status") }}</th>
                          <th colspan="2">{{ __("trans.order_date") }}</th>
                          <th colspan="2">{{ __("trans.net_total") }}</th>
                        </tr>
                        <tr>
                          <td colspan="2">{{ $Order->id }}</td>
                          <td colspan="2">
                            {{$Order->delivery_id == 2 ? __('trans.Receipt_shop') : $Order->orderStatus()}}
                          </td>
                          <td colspan="2">{{$Order->created_at->format('Y-m-d')}}</td>
                          <td colspan="2">{{ format_number($Order->net_total * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                        </tr>

                        <tr>
                          <th colspan="4">{{ __("trans.name") }}</th>
                          <td colspan="4">{{ $Order->Client ? $Order->Client->name : $Order->address->first_name.$Order->address->last_name }}</td>
                        </tr>
                        <tr>
                          <th colspan="4">{{ __("trans.email") }}</th>
                          <td colspan="4">{{ $Order->Client ? $Order->Client->email : $Order->address->email }}</td>
                        </tr>
                        <tr>
                          <th colspan="4">{{ __("trans.phone") }}</th>
                          <td colspan="4">{{ $Order->Client ? $Order->Client->phone_code . $Order->Client->phone : $Order->address->phone }}</td>
                        </tr>
                        <tr>
                          <td colspan="8">
                            <h4>{{ __("trans.Payment") }}</h4>
                          </td>
                        </tr>
                        <tr>
                          <th colspan="4">{{ __("trans.sub_total") }}</th>
                          <td colspan="4">{{ format_number($Order->sub_total * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                        </tr>
                        @if($Order->charge_cost > 0)
                          <tr>
                            <th colspan="4">{{ __("trans.charge_cost") }}</th>
                            <td colspan="4">{{ format_number($Order->charge_cost * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                          </tr>
                        @endif
                        @if($Order->discount > 0)
                          <tr>
                            <th colspan="4">{{ __("trans.discount") }}</th>
                            <td colspan="4">{{ format_number($Order->discount * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                          </tr>
                        @endif
                        <tr>
                          <th colspan="4">{{ __("trans.vat") }}</th>
                          <td colspan="4">{{ format_number($Order->vat * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                        </tr>
                        @if($Order->coupon > 0)
                          <tr>
                            <th colspan="4">{{ __("trans.coupon") }} ({{ $Order->coupon_text }})</th>
                            <td colspan="4">{{ format_number($Order->coupon * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                          </tr>
                        @endif
                        <tr>
                          <th colspan="4">{{ __("trans.net_total") }}</th>
                          <td colspan="4">{{ format_number($Order->net_total * Country()->currancy_value) . ' '. Country()->currancy_code }}</td>
                        </tr>
                        @if ($Order->address)
                          <tr>
                            <td colspan="8">
                              <h4>{{ __("trans.address") }}</h4>
                            </td>
                          </tr>
                          <tr>
                            <th colspan="4">{{ __("trans.country") }}</th>
                            <td colspan="4">{{ $Order->address->country->title() }}</td>
                          </tr>

                          @if($Order->address->country_id == 1)
                            <tr>
                              <th colspan="4">{{ __("trans.block") }}</th>
                              <td colspan="4">{{ $Order->address->block }}</td>
                            </tr>
                             <tr>
                              <th colspan="4">{{ __("trans.road") }}</th>
                              <td colspan="4">{{ $Order->address->road }}</td>
                            </tr>
                             <tr>
                              <th colspan="4">{{ __("trans.building_no") }}</th>
                              <td colspan="4">{{ $Order->address->building_no }}</td>
                            </tr>
                             <tr>
                              <th colspan="4">{{ __("trans.floor_no") }}</th>
                              <td colspan="4">{{ $Order->address->floor_no }}</td>
                            </tr>
                             <tr>
                              <th colspan="4">{{ __("trans.apartment") }}</th>
                              <td colspan="4">{{ $Order->address->apartment }}</td>
                            </tr>
                             <tr>
                              <th colspan="4">{{ __("trans.apartmentType") }}</th>
                              <td colspan="4">{{ $Order->address->apartmentType }}</td>
                            </tr>
                             <tr>
                              <th colspan="4">{{ __("trans.additional_directions") }}</th>
                              <td colspan="4">{{ $Order->address->additional_directions }}</td>
                            </tr>
                          @else
                            <tr>
                              <th colspan="4">{{ __("trans.city") }}</th>
                              <td colspan="4">{{ $Order->address->city }}</td>
                            </tr>
                            <tr>
                              <th colspan="4">{{ __("trans.address1") }}</th>
                              <td colspan="4">{{ $Order->address->address1 }}</td>
                            </tr>
                            <tr>
                              <th colspan="4">{{ __("trans.address2") }}</th>
                              <td colspan="4">{{ $Order->address->address2 }}</td>
                            </tr>
                            <tr>
                              <th colspan="4">{{ __("trans.state") }}</th>
                              <td colspan="4">{{ $Order->address->state }}</td>
                            </tr>
                          @endif
                        @else
                          <tr>
                            <th colspan="4">{{ __("trans.branch") }}</th>
                            <td colspan="4">{{ $Order->Branch?->title() }}</td>
                          </tr>
                        @endif
                        <tr>
                          <th colspan="4">{{ __("trans.gift_color") }}</th>
                          <td colspan="4">{{ $Order->address?->gift_color }}</td>
                        </tr>
                        <tr>
                          <th colspan="4">{{ __("trans.gift_comment") }}</th>
                          <td colspan="4">{{ $Order->address?->gift_comment }}</td>
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
            @empty
              <div class="alert alert-primary blue-alert d-flex justify-content-between rounded-0" role="alert">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-circle-exclamation fs-5 "></i>
                  <span class="text-white mx-2">@lang('trans.no_orders_yet')</span>
                </div>
                <div class="">
                  <a href="{{route('Client.shop')}}" class="btn btn-light rounded-1 py-1 fs-7">@lang('trans.browse_products')</a>
                </div>
              </div>
            @endforelse




          </div>
          <!-- addresses -->
          <div class="tab-pane fade" id="v-pills-Addresses" role="tabpanel" aria-labelledby="v-pills-Addresses-tab" tabindex="0">
            <div>
              <p class="text-secondary">@lang('trans.following_address_used_on_checkout_page_default')
              </p>
              <div class="row">
                <h5 class="card-title">@lang('trans.shipping_address')</h5>
                <div class="col-md-12">
                  <div class="card mt-3 bg-white rounded-0 card-Billing">
                    </div>
                    <div class="card mt-5 bg-white rounded-0">
                      <div class="card-body">
                          <form action="{{route('Client.updateShippingAddress')}}" method="post">
                            @csrf
                            <div class="row">
                              <div class="col-sm-6 mb-3">
                                <label for="" class="text-secondary">@lang('trans.first_name') <span class="red-label">*</span>
                                </label>
                                <input type="text" class="form-control rounded-0" name="first_name" id="" value="{{old('first_name_shipping',addressShipping()?addressShipping()->first_name:'')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                              </div>
                              <div class="col-sm-6 mb-3">
                                <label for="" class="text-secondary">@lang('trans.last_name') <span class="red-label">*</span>
                                </label>
                                <input type="text" class="form-control rounded-0" name="last_name" id="" value="{{old('last_name_shipping',addressShipping()?addressShipping()->last_name:'')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                              </div>

                              <div class="col-sm-12 mb-3">
                                <label for="" class="text-secondary">@lang('trans.country')<span class="red-label">*</span>
                                </label>
                                <select class="rounded-0 form-select" name="country_id" id="country_id" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
{{--                                  <option value="">@lang('trans.select_country')</option>--}}
                                  @foreach(Countries() as $country)
                                    <option value="{{$country->id}}" {{ old('country_id', addressShipping() ? addressShipping()->country_id : '') == $country->id ? 'selected' : '' }}>{{ $country['title_'.lang()] }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div id="otherCountries" class="row" style="{{addressShipping()?->country_id !== '1' ? 'display:block' : 'display:none' }}">
                                <div class="col-sm-12 mb-3">
                                  <label for="" class="text-secondary">@lang('trans.city')   <span class="red-label">*</span>
                                  </label>
                                  <input type="text" class="form-control rounded-0" name="city" id="" value="{{ addressShipping() ? addressShipping()->city : old('city', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                                </div>
                                <div class="col-sm-12 mb-3">
                                  <label for="" class="text-secondary">@lang('trans.state')  (@lang('trans.optional'))
                                  </label>
                                  <input type="text" class="form-control rounded-0" name="state" id="" value="{{ addressShipping() ? addressShipping()->state : old('state', '') }}">
                                </div>
                                <div class="col-sm-12 mb-3">
                                  <label for="" class="text-secondary">@lang('trans.street_address') <span class="red-label">*</span>
                                  </label>
                                  <input type="text" class="form-control rounded-0 mb-3" name="address1" id="" placeholder="@lang('trans.address1')" value="{{old('address1',addressShipping()?addressShipping()->address1:'')}}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                                  <input type="text" class="form-control rounded-0" name="address2" id="" placeholder="@lang('trans.address2')" value="{{old('address1',addressShipping()?addressShipping()->address2:'')}}">
                                </div>
                                <div class="col-4">
                                  <button type="submit" class="btn btn-info rounded-0 px-3">@lang('trans.save_changes')</button>
                                </div>
                              </div>

                              <div id="bahrain"  style="{{addressShipping()?->country_id == '1' ? 'display:none' : 'display:block' }}">
                                <div class="row">
                                  <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.region')
                                    </label>
                                    <select class="rounded-0 form-select" name="region_id" id="region_id" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                                      <option value="">@lang('trans.select_region')</option>
{{--                                      <option value="{{ old('region_id', addressShipping() ? (addressShipping()->region_id ?? '') : '') }}" selected>{{addressShipping() ? (addressShipping()->region_id ? addressShipping()->region['title_'.lang()] : '') : ''}}</option>--}}
                                      @php
                                        $selectedRegionId = old('region_id', addressShipping() ? (addressShipping()->region_id ?? '') : '');
                                      @endphp
                                      @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ $region->id == $selectedRegionId ? 'selected' : '' }}>
                                          {{ $region['title_'.lang()] }}
                                        </option>
                                      @endforeach
                                    </select>
                                </div>
                                  <div class="col-sm-6 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.block')
                                    </label>
                                    <input type="number" class="form-control rounded-0" name="block" value="{{ addressShipping() ? addressShipping()->block : old('block', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                                  </div>
                                  <div class="col-sm-6 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.road')
                                    </label>
                                    <input type="number" class="form-control rounded-0" name="road" value="{{ addressShipping() ? addressShipping()->road : old('road', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                                  </div>
                                  <div class="col-sm-6 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.building_no')
                                    </label>
                                    <input type="number" class="form-control rounded-0" name="building_no" value="{{ addressShipping() ? addressShipping()->building_no : old('building_no', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                                  </div>
                                  <div class="col-sm-6 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.floor_no')
                                    </label>
                                    <input type="number" class="form-control rounded-0" name="floor_no" value="{{ addressShipping() ? addressShipping()->floor_no : old('floor_no', '') }}" required oninvalid="this.setCustomValidity(@lang('trans.this_field_required'))" title="@lang('trans.this_field_required')">
                                  </div>
                                  <div class="col-sm-6 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.apartment')
                                    </label>
                                    <input type="number" class="form-control rounded-0" name="apartment" value="{{ addressShipping() ? addressShipping()->apartment : old('apartment', '') }}">
                                  </div>
                                  <div class="col-sm-6 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.apartmentType')
                                    </label>
                                    <input type="text" class="form-control rounded-0" name="apartmentType" value="{{ addressShipping() ? addressShipping()->apartmentType : old('apartmentType', '') }}">
                                  </div>
                                  <div class="col-sm-6 col-md-6 mb-3">
                                    <label for="" class="text-secondary">@lang('trans.additional_directions')
                                    </label>
                                    <input type="text" class="form-control rounded-0" name="additional_directions" value="{{ addressShipping() ? addressShipping()->additional_directions : old('additional_directions', '') }}">
                                  </div>
                              </div>

                              <div class="col-4">
                                <button type="submit" class="btn btn-info rounded-0 px-3">@lang('trans.save_changes')</button>
                              </div>

                            </div>

                            </div>
                        </form>

                        </div>
                      </div>
                </div>
              </div>
            </div>
          </div>
          <!-- account details -->
          <div class="tab-pane fade" id="v-pills-Account" role="tabpanel" aria-labelledby="v-pills-Account-tab" tabindex="0">
            <div class="row">
              <div class="col-md-12">
                  <div class="card bg-white rounded-0 p-4">
                    <div class="card-body">
                        <form action="{{route('Client.updateAccountDetails')}}" method="post">
                          @csrf
                          <div class="row">
                            <div class="col-sm-12 mb-3">
                              <label for="" class="text-secondary">@lang('trans.name') <span class="red-label">*</span>
                              </label>
                              <input type="text" class="form-control rounded-0" name="name" placeholder="@lang('trans.name')" value="{{auth()->user()->name}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                              <label for="" class="text-secondary">@lang('trans.phone')<span class="red-label">*</span>
                              </label>
                              <input type="text" class="form-control rounded-0" name="phone" placeholder="Ex: 973 32188288" value="{{auth()->user()->phone}}">
                              @error('phone')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                              <label for="" class="text-secondary">@lang('trans.email')<span class="red-label">*</span>
                              </label>
                              <input type="email" class="form-control rounded-0" name="email" placeholder="@lang('trans.email')" value="{{auth()->user()->email}}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <h5 class="text-danger mt-3">@lang('trans.change_password')
                            </h5>
                            <div class="col-sm-12 mb-3">
                              <label for="" class="text-secondary">@lang('trans.current_password') (@lang('trans.leave_blank_to_leave_unchanged'))
                              </label>
                              <input type="password" class="form-control rounded-0" name="current_password" placeholder="@lang('trans.current_password')" id="current-password">
                              <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                              <label for="" class="text-secondary">@lang('trans.new_password') (@lang('trans.leave_blank_to_leave_unchanged'))
                              </label>
                              <input type="password" class="form-control rounded-0" name="password" placeholder="@lang('trans.new_password')" id="current-password">
                              <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                              <label for="" class="text-secondary">@lang('trans.confirm_new_password')
                              </label>
                              <input type="password" class="form-control rounded-0" name="password_confirmation" placeholder="@lang('trans.confirm_new_password')" id="current-password">
                              <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div>
                              <button type="submit" class="btn btn-info rounded-0 px-3">@lang('trans.save_changes')</button>
                            </div>
                          </div>
                      </form>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@stop



@section('script')
<script>
    function showCard(cardClass) {
      // Hide all cards
      const allCards = document.querySelectorAll('.card-Billing, .card-Shipping');
      allCards.forEach(card => {
        card.style.display = 'none';
      });

      // Show the selected card
      const selectedCard = document.querySelector('.' + cardClass);
      selectedCard.style.display = 'block';
    }
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var togglePasswords = document.querySelectorAll('.toggle-password');

    togglePasswords.forEach(function(icon) {
      icon.addEventListener('click', function() {
        var passwordInput = this.parentElement.querySelector('input[type="password"]'); // Get the password input within the same parent element
        passwordInput.classList.toggle('show-password');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });
    });
  });
</script>

<script>
  $(document).ready(function() {
    // Function to toggle between the two address sections
    function toggleAddressSections(countryValue) {
      if (countryValue == 1) {
        $('#otherCountries').hide(); // Hide otherCountries section
        $('#bahrain').show(); // Show bahrain section
        // Add 'required' attribute to inputs in bahrain section
        $('#bahrain').find('input, select').prop('required', true);
        $('#bahrain').find('input[name="additional_directions"],input[name="apartment"],input[name="apartmentType"]').prop('required', false);
        // Remove 'required' attribute from inputs in otherCountries section
        $('#otherCountries').find('input, select').prop('required', false);

        // Fetch regions for country 1
        fetchRegionsForCountry(countryValue);
      }
      else {
        $('#otherCountries').show(); // Show otherCountries section
        $('#bahrain').hide(); // Hide bahrain section
        // Add 'required' attribute to inputs in otherCountries section
        $('#otherCountries').find('input, select').not('[name="state"], [name="address2"]').prop('required', true);
        // Remove 'required' attribute from inputs in bahrain section
        $('#bahrain').find('input, select').prop('required', false);
      }
    }

    // Call the function initially to set the correct section based on the selected country
    toggleAddressSections($('#country_id').val());

    // Event listener to detect changes in the selected country
    $('#country_id').change(function() {
      var selectedCountryValue = $(this).val();
      toggleAddressSections(selectedCountryValue);
    });


    // Function to fetch regions for country 1 using AJAX
    function fetchRegionsForCountry(countryValue) {
      $.ajax({
        url: '{{ route("Client.fetchRegionsForCountry") }}', // Route for fetching regions
        type: 'GET',
        data: { country_id: countryValue }, // Pass the country_id as data
        success: function(response) {
          // Populate the select box with regions
          var $regionSelect = $('#region_id');
          var selectedRegionId = '{{ $selectedRegionId }}'; // Get the selected region ID from PHP variable
          $regionSelect.empty(); // Clear existing options
          $regionSelect.append('<option value="">{{ __('trans.select_region') }}</option>'); // Add default option
          $.each(response.regions, function(index, region) {
            var isSelected = region.id == selectedRegionId ? 'selected' : '';
            $regionSelect.append('<option value="' + region.id + '" ' + isSelected + '>' + region.title + '</option>');
          });
        }
      });
    }
  });
</script>

@stop
