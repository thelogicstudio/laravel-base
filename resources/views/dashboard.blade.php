@extends('layouts.admin.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('page_options')
            <div class="row">
                <div class="col-md-7 text-start my-2">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-md-5 my-2">

                </div>
            </div>
        @endslot
    @endcomponent
    @include('layouts.admin.partials.flash-message')
    <div class="container-fluid">
        <div class="row starter-main">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
