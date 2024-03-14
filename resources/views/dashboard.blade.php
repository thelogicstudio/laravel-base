@extends('layouts.admin.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('components.breadcrumb')
    @endcomponent
    <section class="section">
        <div class="section-body">
            <div class="container-fluid dashboard-default-sec">
                <div class="row">
                    <div class="col-sm-6 col-xl-2 col-lg-6">
{{--                        Content goes here--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
