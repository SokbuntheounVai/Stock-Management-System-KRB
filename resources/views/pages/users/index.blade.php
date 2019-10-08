@extends('layouts.master')
@section('content')
@if(Session::has('success'))
<script>
    Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
    )
</script>
@endif
@if(Session::has('error'))
<script>
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
    })
</script>
@endif

<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php($i=1)

        @if(Session::has('have'))
        @foreach($users as $u)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->username}}</td>
            <td>{{$u->email}}</td>
            <td>
                <a id="remove" class="btn btn-oval btn-small btn-danger" onclick="confirmAction('Do you want to delete it?')">Remove
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
        @endif
        @if(Session::has('null'))
        <tr>
            <td colspan="5" class="text-danger">Data Not Found!</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection
@section('js')
<script>
    var idAuth = {{Auth::user()->id}};
    function confirmAction(massages) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: massages,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                alert(document.getElementById('remove').getAttribute('href')+ " " + "http://127.0.0.1:8000/users/delete/" + idAuth)
                var archor = document.getElementById('remove');
                archor.setAttribute('href', "{{url('users/delete/'.$u->id)}}");
                alert(document.getElementById('remove').getAttribute('href')+ " " + "http://127.0.0.1:8000/users/delete/" + idAuth)
                if (document.getElementById('remove').getAttribute('href') != "http://127.0.0.1:8000/users/delete/" + idAuth) {
                    archor.click();
                } else {
                    archor.setAttribute('href',"{{url('users')}}");

                    swalWithBootstrapButtons.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        confirmButtonText : 'OK',
                        preConfirm : () => {
                            archor.click()
                        }
                    })
                    // .then({
                    //     archor.click();
                    // })
                    
                }
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
@endsection