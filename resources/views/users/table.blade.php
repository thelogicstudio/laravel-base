<div class="table-responsive-xxl">
    <table class="data-table table table-striped p-6 flex space-x-2 sortable" id="users-table">
        <thead>
        <tr class="table-header">
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Email</th>
            <th>Created At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Contact confirm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to confirm this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                <button type="button" id="confirmContact" data-id="" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var table = $('#users-table').DataTable({
            dom: 'fBlrtip',
            processing: true,
            serverSide: true,
            pageLength: 50,
            ordering: true,
            bLengthChange: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='/users/"+oData.id+"'>"+oData.id+"</a>");
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'}
            ],
            oLanguage: {
                sSearch: "Filter Entries:",
            },
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
