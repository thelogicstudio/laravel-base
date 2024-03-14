@extends('layouts.admin.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('components.breadcrumb')
    @endcomponent
    <section class="section">
        <div class="section-body">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
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
    </section>
@endsection

