@extends('layouts.master')
@section('content')

@if(Session::has('success'))
<script>
    swalWithBootstrapButtons.fire(
        'Restore!',
        'Your Data has been restored.',
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
@section('title-left')
<nav aria-label="breadcrumb" style="font-size : 20px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Security</li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
        <li class="breadcrumb-item active" aria-current="page">Trash</li>
    </ol>
</nav>
@endsection
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
        @if($users)
        @foreach($users as $u)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->username}}</td>
            <td>{{$u->email}}</td>
            <td>
                <a id="restore" class="btn btn-oval btn-small btn-danger" onclick="confirmAction('Do you want to restore it?')">Remove
                    <i class="fa fa-reset"></i>
                </a>
            </td>
        </tr>
        @endforeach
        
        @else
        <tr>
            <td colspan="5" class="text-danger">Data Not Found!</td>
        </tr>
        @endif


    </tbody>
</table>
@endsection
@section('js')
<script>
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
                var archor = document.getElementById('restore');
                archor.setAttribute('href',"{{url('users/restore/'.$u->id)}}");
                archor.click();
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