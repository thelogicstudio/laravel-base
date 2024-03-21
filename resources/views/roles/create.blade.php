@extends('layouts.admin.master')
@section('title')
    Create Role
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('page_options')
            <div class="row">
                <div class="col-md-7 text-start">
                    <h3>Create Role</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
                <div class="col-md-5 my-2">
                    <div class="section-header-breadcrumb my-2 dropdown-basic">
                        <a href="{{ route('roles.index') }}" class="btn dropbtn btn-secondary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
    <section class="section">
        <div class="content">
{{--            @include('layouts.errors')--}}
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {{ html()->form('POST', route('roles.store'))->open() }}
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

