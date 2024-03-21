@extends('layouts.admin.master')
@section('title')
    Edit Role
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h1>Edit Role</h1>
        @endslot
        @slot('page_options')
            <div class="row">
                <div class="col-md-7 text-start">
                    <h3>Edit Role</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <div class="col-md-5 my-2">
                    <div class="section-header-breadcrumb py-1  dropdown-basic">
                        <a href="{{ route('roles.show',$role->id)}}" class="btn dropbtn btn-primary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
    @include('layouts.admin.partials.flash-message')
    <section class="section">
        <div class="container-fluid">
            <div class="row starter-main">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
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
