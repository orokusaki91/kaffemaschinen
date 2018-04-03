@php($page_name = 'Kategorien')
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            {{ __('lang.category.index.title') }} <span class="text-muted" style="font-size: 18px">(Die maximale Anzahl der Hauptkategorien ist 9)</span>
            <a style="" href="{{ route('admin.category.create') }}" class="btn-schoen float-right">{{ __('lang.category.index.create') }}</a>
        </div>

        {!! $dataGrid->render() !!}

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="cover">
                            <div class="cover-text">
                                <h1>Möchten Sie diesen Kategorie "<strong><em id="category_name"></em></strong>" wirklich löschen?</h1>

                                <form id="modal_form" method="post" action="">

                                    {{ csrf_field() }}

                                    {{ method_field('delete') }}

                                    <button type="submit" name="yes" class="btn">Ja</button>
                                    <a href="#" onclick="$('#myModal').modal('hide')" class="btn btn-secondary">Nein</a>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
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
@endpush