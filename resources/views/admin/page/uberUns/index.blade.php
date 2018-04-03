@extends('admin.layouts.app')
@section('content')
    <div class="main-content p-3" style="margin-left: 200px; ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0 text-center">
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="h1">Uber Uns Details</div>
                    </div>
                </div>

                <form id="product-save-form" action="{{ route('admin.uber-uns.update.text', $text->id) }}" method="post" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}

                    <div class="row" id="product-save-accordion" data-children=".product-card">
                        <div class="col-12 mb-2 mt-2">
                            <div class="card product-card  mb-2 mt-2">
                                <div class="card-header">
                                    Text Details
                                </div>
                                <div class="card-body collapse show" id="basic">

                                    <div class="form-group">
                                        <label for="body">Text</label><br>
                                        <textarea id="description" name="body" type="text" cols="60" rows="5">{{ $text->value }}</textarea>

                                    </div>
                                </div>

                                @if ($errors->any())
                                    <div class="row justify-content-center text-center">
                                        <div class="col-6 alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn-schoen">
                           {{ __('lang.admin-update-text') }}
                        </button>
                    </div>

                </form>

            </div>

            <br><br>
            <div class="container">
                <div class="h2">
                    Banners

                    <a href="{{ route('admin.uber-uns.create') }}"
                       class="float-right btn-schoen">
                       {{ __('lang.admin-create-new-banner') }}
                    </a>

                </div>
                {!! $dataGrid->render() !!}

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="cover">
                                    <div class="cover-text">
                                        <h1>Möchten Sie diesen Banner "<strong><em id="banner_name"></em></strong>" wirklich löschen?</h1>

                                        <form id="modal_form" method="post" action="">

                                            {{ csrf_field() }}

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

            <div class="container">
                @if(Session::has('success'))
                    <div class="containter">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="alert alert-success text-center">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@stop
@push('scripts')
<script>
    function showDeleteModal(id, name) {
        var url = "{{ URL::to('admin/page/uber-uns/destroy') }}";
        var action = url + '/' + id;
        $('#modal_form').attr('action', action);
        $('#banner_name').html(name);
        $('#myModal').modal('show');
    }
</script>
@endpush