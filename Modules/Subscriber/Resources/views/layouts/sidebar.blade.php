<li class="nav-item @if(str_contains(Route::currentRouteName(), 'subscribers')) active @endif">

    <a class="collapsed" href="{{ route('admin.subscribers.index') }}" class="" >
        <span class="icon text-center">
            <i style="width: 20px;" class="fa fa-user-plus mx-2"></i>
        </span>
        <span class="text">{{ __('trans.subscribers') }}</span>
    </a>

</li>
