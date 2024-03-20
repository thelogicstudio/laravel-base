@extends('layouts.admin.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h1>View  Profile</h1>
        @endslot
        @slot('page_options')
            <div class="row">
                <div class="col-md-12 text-start">
                    <h3>My Profile</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        @endslot
    @endcomponent
    <section class="section">
        <div class="container-fluid">
            <div class="row starter-main">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-1 sm:p-8 bg-white dark:bg-gray-800">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-1 sm:p-8 bg-white dark:bg-gray-800 mt-5">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            {{--            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
                            {{--                <div class="max-w-xl">--}}
                            {{--                    @include('profile.partials.delete-user-form')--}}
                            {{--                </div>--}}
                            {{--            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

