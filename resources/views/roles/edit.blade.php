@extends('layouts.admin.master')
@section('title')
    Edit Role
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h1>Roles</h1>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                Home
            </a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item">Edit Role</li>

        @slot('page_options')
            <div class="section-header-breadcrumb py-1  dropdown-basic">
                <a href="{{ route('roles.show',$role->id)}}" class="btn dropbtn btn-primary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
        @endslot
    @endcomponent
    <section class="section">
        <div class="content">
{{--            @include('layouts.errors')--}}
            <div class="section-body">
                <div class="recordNavWrapper"></div>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card card-warning">
                            <div class="card-body ">
                                {{ html()->form('PATCH', route('roles.update', ['role' => $role->id]))->open() }}
                                    <div class="row">
                                        @include('roles.fields')
                                    </div>
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
