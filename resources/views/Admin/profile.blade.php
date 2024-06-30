@extends('Admin.layout')

@section('content')
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title mb-30">
                <h2>{{ __('trans.My Profile') }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card-styles">
    <div class="card-content">
        <form action="{{ route('admin.profile.update') }}" method="POST" accept-charset="UTF-8" id="signUP">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="name">{{ __('trans.user_name') }}</label>
                        <input type="text" name="name" id="name" placeholder="{{ __('trans.user_name') }}" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="short_name">{{ __('trans.short_name') }}</label>
                        <input type="text" name="short_name" id="short_name" placeholder="{{ __('trans.short_name') }}" value="{{ old('short_name', auth()->user()->short_name) }}" required>
                        @error('short_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="phone">{{ __('trans.phone') }}</label>
                        <input type="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="email">{{ __('trans.email') }}</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="cpr">{{ __('trans.cpr') }}</label>
                        <input type="text" name="cpr" value="{{ old('cpr', auth()->user()->cpr) }}">
                        @error('cpr')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="birthdate">{{ __('trans.birthdate') }}</label>
                        <input type="date" name="birthdate" value="{{ old('birthdate', auth()->user()->birthdate) }}">
                        @error('birthdate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="gender">{{ __('trans.gender') }}</label>
                        <select id="gender" name="gender">
                            <option selected hidden disabled>-------</option>
                            <option @selected(auth()->user()->gender == 'M') value="M">@lang('trans.male')</option>
                            <option @selected(auth()->user()->gender == 'F') value="F">@lang('trans.female')</option>
                        </select>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="accent">{{ __('trans.accent') }}</label>
                        <input type="text" name="accent" value="{{ old('accent', auth()->user()->accent) }}">
                        @error('accent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="password">{{ __('trans.password')}}</label>
                        <input type="password" name="password" id="password" placeholder="{{  __('trans.password')}}">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="password_confirmation">{{ __('trans.confirmPassword')}}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{  __('trans.confirmPassword')}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-style-1">
                        <label for="bio">{{ __('trans.bio') }}</label>
                        <textarea name="bio" id="" cols="5" rows="5" class="form-control">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="col-12">
                    <div class="button-group d-flex justify-content-center flex-wrap">
                        <button type="submit" class="main-btn main-btn btn-hover w-100 text-center" id="submitform">
                            {{ __('trans.Submit') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection