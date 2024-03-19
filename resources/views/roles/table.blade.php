<div class="table-responsive-xxl max-w-2xl mx-auto px-sm-4 sm:p-6 lg:p-8">
    <table class="data-table table table-striped p-6 flex space-x-2 sortable" id="roles-table">
        <thead>
            <tr class="table-header">
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(function () {
        var table = $('#roles-table').DataTable({
            dom: 'fBlrtip',
            processing: true,
            serverSide: true,
            pageLength: 50,
            ordering: true,
            bLengthChange: true,
            ajax: "{{ route('roles.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='/roles/"+oData.id+"'>"+oData.id+"</a>");
                    }
                },
                {data: 'name', name: 'name'},
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
