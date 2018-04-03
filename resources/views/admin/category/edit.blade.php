@php($page_name = 'Kategorien')
@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('lang.category-index-edit') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.category.update', $model->id) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                        @include('admin.category._fields')

                        <button type="submit" class="btn-schoen">{{ __('lang.category-index-edit') }}</button>

                        <a href="{{ route('admin.category.index') }}" class="btn btn-default">{{ __('lang.cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    function showDeleteModal(id, name) {
        var url = "{{ URL::to('admin/category') }}";
        var action = url + '/' + id;
        $('#modal_form').attr('action', action);
        $('#category_name').html(name);
        $('#myModal').modal('show');
    }
</script>

<script>
    $(document).ready(function () {

        @if(session()->has('category'))
        $.notify({
            // options
            message: '{{ session('category') }}'
        },{
            // settings
            type: 'danger'
        });
        @endif
    });
</script>
@endpush