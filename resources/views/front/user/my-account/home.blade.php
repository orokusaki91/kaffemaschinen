<?php $nav_home = 'active'; ?>

@extends('front.layouts.app')

@section('meta_title','Kundenbereich')
@section('meta_description','Kundenbereich')

@section('content')
<main class="padd">
    <div class="container">
        <div class="bat">
            <div class="row">

                @include('front.user.my-account.sidebar')

                <div class="col-sm-7 profile-info">
                    <h3 class="main-ttl"><span>{{ __('front.profile-details-panel') }}</span></h3>
                    <div class="row space">
                        <div class="auth-wrap">

                            <div class="col-sm-12 profile-info">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table myacc_table lwr">
                                            <tbody>
                                            <tr>
                                                <td>{{ __('front.account-title') }}</td>
                                                <td>{{ $user->title }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('front.account-first-name') }}</td>
                                                <td>{{ $user->first_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('front.account-last-name') }}</td>
                                                <td>{{ $user->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('front.email') }}</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('front.phone') }}</td>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('front.account-company-name') }}</td>
                                                <td>{{ $user->company_name }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    @media (min-width: 992px) {
        .lwr {
            width: 70%;
        }
    }
</style>

@endsection