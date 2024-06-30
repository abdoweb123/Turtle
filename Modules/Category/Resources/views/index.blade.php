@extends('Admin.layout')
@section('pagetitle', __('trans.categories'))
@section('content')


<div class="row">
    <div class="my-2 col-6">
        <a href="{{ route('admin.categories.create') }}" class="main-btn px-5">@lang('trans.add_new')</a>
    </div>
</div>
<table class="table text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.Categories')</th>
            <th>@lang('trans.title_ar')</th>
            <th>@lang('trans.title_en')</th>
            <th>@lang('trans.visibility')</th>
            <th>@lang('trans.appearInHomepage')</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="@auth('admin') row_position @endauth" data-table="categories">
        @foreach ($Models as $Model)
        <tr data-id="{{ $Model->id }}" data-position="{{ $Model->arrangement }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Model->children->count() }}</td>
            <td><a href="{{ route('admin.categories.show', $Model) }}">{{ $Model->title_ar }}</a></td>
            <td><a href="{{ route('admin.categories.show', $Model) }}">{{ $Model->title_en }}</a></td>
            <td>
                <input class="toggle" type="checkbox" onclick="toggleswitch({{ $Model->id }},'categories')" @if ($Model->status) checked @endif>
            </td>
            <td>
                <input type="radio" name="appearInHomepage" value="{{ $Model->id }}" @if ($Model->appearInHomepage) checked @endif>
            </td>
            <td>
                <a href="{{ route('admin.categories.show', $Model) }}"><i class="fas fa-eye"></i></a>
                <a href="{{ route('admin.categories.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route('admin.categories.destroy', $Model) }}">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // JavaScript function to handle AJAX request
        function updateAppearInHomepage(id) {
            $.ajax({
                url: '{{route('admin.appearInHomepage')}}', // Replace with your route
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update UI based on response
                    console.log(response);
                    Swal.fire({
                        title: 'Success',
                        icon: 'Success',
                        text: response.message,
                    });
                },
                error: function(xhr) {
                    // Handle error
                    Swal.fire({
                        title: 'Error!',
                        icon: 'Error',
                        text: response.message,
                    });
                }
            });
        }

        // Attach event listener to radio button
        $('input[name="appearInHomepage"]').on('change', function() {
            var id = $(this).val();
            updateAppearInHomepage(id);
        });
    </script>
@stop