@extends('layouts.admin.master')
@section('title')
    Create User
@endsection
@section('content')

    @component('components.breadcrumb')
    @slot('page_options')
        <div class="row">
            <div class="col-md-7 text-start">
                <h3>Create User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
            <div class="col-md-5 my-2">
                <div class="section-header-breadcrumb my-2  dropdown-basic">
                    <a href="{{ route('users.index') }}" class="btn dropbtn btn-secondary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
        </div>
    @endslot
  @endcomponent
    <section class="section">
        <div class="content">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body ">
                                {{ html()->form('POST', route('users.store'))->id('contact-form')->open() }}
                                    <div class="col-12">
                                        @include('users.fields')
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
