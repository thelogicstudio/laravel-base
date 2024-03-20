{{ html()->hidden('type_id')->value($user->role ?? null) }}
{{ html()->hidden('user_id')->value(Auth::user()->id ?? null) }}
@php
    $user_role_name = '';
    if($user->roles){
        $rolesArray = json_decode($user->roles, true);
        $user_role_name =  array_column($rolesArray, 'name');
    }
@endphp
{{--<h4 class="inner-view-h4">--}}
{{--    <i class="fa fa-info text-danger"> </i> User Details--}}
{{--</h4>--}}
<div class="row">
    <div class="col-xl-8 col-12">
        @if($user->name != '')
            <p><span class="mr-4"><span class="fw-bold">Name</span>: &nbsp;{{$user->name}}</span></p>
        @endif
        @if($user->roles)
            <p><span class="mr-4"><span class="fw-bold">Type</span>: &nbsp;{{$user_role_name[0]}}</span></p>
        @endif
        @if($user->email != '')
            <p><span class="mr-4"><span class="fw-bold">Login&nbsp;Email</span>:&nbsp;{{$user->email}}</span></p>
        @endif
        @if($user->created_at != '')
            <p><span class="mr-4"><span class="fw-bold">Created at</span>:&nbsp;{{date('Y-m-d h:i', strtotime($user->created_at))}}</span></p>
        @endif
        @if($user->updated_at != '')
            <p><span class="mr-4"><span class="fw-bold">Updated at</span>:&nbsp;{{date('Y-m-d h:i', strtotime($user->updated_at))}}</span></p>
        @endif
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12 py-2 editOptions mt-5">
    <a href="{{ route('users.index') }}" class="btn dropbtn btn-secondary btn-round">Back</a>
</div>

<div class="modal fade" id="addressToolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-address" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Address Formatting Tool</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="address-modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="copy-button" onclick="copyToClipboard('editor');">Copy</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
