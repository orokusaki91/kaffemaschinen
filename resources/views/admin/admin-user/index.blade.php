@php($page_name = 'Admin-Benutzer')
@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="h1">
            {{ __('lang.admin-users') }}

                <a href="{{ route('admin.admin-user.create') }}"
                   class="float-right btn-schoen">
                    {{ __('lang.admin-create-admin-user-button-title') }}
                </a>

        </div>
        {!! $dataGrid->render() !!}

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="cover">
                            <div class="cover-text">
                                <h1>Möchten Sie diesen User "<strong><em id="admin_name"></em></strong>" wirklich löschen?</h1>

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
        var url = "{{ URL::to('admin/admin-user') }}";
        var action = url + '/' + id;
        $('#modal_form').attr('action', action);
        $('#admin_name').html(name);
        $('#myModal').modal('show');
    }
</script>
@endpush