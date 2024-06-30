
<div>
    <div class="row">
        @php $count = 1 @endphp
        @forelse($product->Gallery()->whereNotNull('color_id')->groupBy('color_id')->get() as $gallery)
            {{--   @if($count < 3)--}}
            <div class="col-sm-2 col-3 mx-1">
                <div class="m-0 p-0">
                    <div class="color-img" style="background-color: {{$gallery->color['hexa']}}"></div>
                    {{--  <img src="{{asset($gallery->image)}}" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="" data-image="{{$gallery->color['title_'.lang()]}}">--}}
                </div>
            </div>
        @empty
        <!-- No galleries found -->
        @endforelse
    </div>
</div>