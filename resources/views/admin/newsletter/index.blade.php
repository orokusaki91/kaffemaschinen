@php($page_name = 'Newsletter')
@extends('admin.layouts.app')
@section('content')
   
        <h1>
            <span class="main-title-wrap">{{ __('lang.newsletter.index.title') }}</span>
            
        </h1>
   
    <div class="container">
        {!! $dataGrid->render() !!}
        <div class="text-right">
            <p>
                <a class="btn btn-schoen" style="text-decoration: none;" href="{{ route('csvview',['download'=>'csv']) }}">CSV Herunterladen</a>
            </p>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="cover">
                        <div class="cover-text">
                            <h1>Möchten Sie diesen Abonnennten "<strong><em id="subscriber_mail"></em></strong>" wirklich löschen?</h1>

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

@stop
@push('scripts')
<script>
    function showDeleteModal(id, email) {
        var url = "{{ URL::to('admin/newsletter') }}";
        var action = url + '/' + id;
        $('#modal_form').attr('action', action);
        $('#subscriber_mail').html(email);
        $('#myModal').modal('show');
    }
</script>
@endpush