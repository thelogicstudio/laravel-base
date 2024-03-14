@extends('layouts.admin.master')
@section('title')
    Create Contact
@endsection
@section('content')

    @component('components.breadcrumb')
    @slot('page_options')
        <div class="section-header-breadcrumb my-2  dropdown-basic">
            <a href="{{ route('users.index') }}" class="btn dropbtn btn-secondary btn-round"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
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
