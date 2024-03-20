{{ html()->hidden('user_id')->value(Auth::user()->id ?? null) }}
{{ html()->hidden('id')->value($user->id ?? null) }}
@php
    $user_types = \App\Models\Role::orderBy('name', 'asc')
        ->get();
    $all_user_types = [];
    foreach ($user_types as $user_type) {
        $all_user_types[$user_type->id] = $user_type->name;
    }

    if(isset($user->roles)){
        $rolesArray = json_decode($user->roles, true);
        $user_role_id =  array_column($rolesArray, 'id');
    }
@endphp
<div class="row">
    <div class="col-xl-8 col-12">
{{--        <h4 class="inner-h4">--}}
{{--            <i class="fa fa-info text-danger"> </i> User Details--}}
{{--        </h4>--}}
        <!-- Name Field -->
        <div class="form-group row">
            <div class="col-sm-6 col-md-6 col-xxl-3 col-12 mb-2">
                <label for="name"> Name</label>
                {{ html()->text('name')->class('form-control max-width-300')->required()->autofocus()->value($user->name ?? null) }}
            </div>
            <div class="col-sm-6 col-xxl-3 col-12 mb-2">
                <label for="email"> Login Email</label>
                {{ html()->email('email')->id('email')->class('form-control max-width-300')->required()->value($user->email ?? null) }}
            </div>
            <div class="col-sm-6 col-xxl-3 col-12 mb-2">
                <label for="type_id">User Type</label><br>
                @if(isset($user))
                    {{ html()->select('type_id')->class('form-select max-width-300')->required()->placeholder('Select Type')->options($all_user_types)->value($user_role_id) }}
                @else
                    {{ html()->select('type_id')->class('form-select max-width-300')->required()->placeholder('Select Type')->options($all_user_types) }}
                @endif
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 py-2 editOptions mt-3">
    @if(isset($user))
        <button type="submit" id="save_data" data-ref="contact" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger cancel-edit" data-id="{{$user->id}}" data-link="/users/{{$user->id}}" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
    @else
        <button type="submit" id="" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger cancel-edit" data-id="" data-link="/users" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
    @endif
</div>

<div class="modal fade" id="deletePersonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                <button type="button" id="deletePerson" data-id="" data-ref="" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePhoneModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                <button type="button" id="deletePhone" data-id="" data-ref="" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                <button type="button" id="deleteAddress" data-id="" data-ref="" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteEmailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                <button type="button" id="deleteEmail" data-id="" data-ref="" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
