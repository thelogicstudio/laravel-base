@extends('layouts.admin.master')

@section('title')
 Contacts
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
@endpush

@section('content')
  @component('components.breadcrumb')
    @slot('page_options')
        <div class="row">
            <div class="col-md-7 text-start">
                <h3>Users</h3>
            </div>
            <div class="col-md-5 my-2">
                @can('create', \App\Models\User::class)
                    <div class="add-btn">
                        <a href="{{ route('users.create') }}" class="btn btn-secondary mt-1 form-btn">User <i
                                class="fa fa-plus ms-2"></i></a>
                    </div>
                @endcan
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
                    @include('users.table')
                </div>
            </div>
        </div>
    </div>
  </div>
  @push('scripts')
  <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
  <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
  <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
  <script src="{{asset('assets/js/tooltip-init.js')}}"></script>
  @endpush
@endsection
