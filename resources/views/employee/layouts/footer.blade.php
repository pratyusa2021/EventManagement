</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'department', name: 'department'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>
<script>
    function deleteEmployee(id){
    var url = '/delete/'+id;
    $.ajax({
      type: 'get',
      url: url,
      success: (data) => {
        alert('Employee Details Deleted Successfully');
      }
    });
    dataTableReload();
}
</script>
    <script>
        $('#createEmployee').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                },
                address: {
                    required: true,
                },
                date_of_birth: {
                    required: true,
                },
                department_id: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "This email field is required.",
                    email: "Please enter a valid email address"
                },
                name: {
                    required: "Name field is required.",
                },
                phone: {
                    required: "Phone field is required.",
                },
                address: {
                    required: "Address field is required.",
                },
                date_of_birth: {
                    required: "Date of Birth field is required.",
                },
                department_id: {
                    required: "Department field is required.",
                },
            },
            errorElement: "span",
            errorClass: "form-text text-danger is-invalid"
        });
    </script>