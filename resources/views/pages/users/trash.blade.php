@extends('layouts.master')
@section('content')

@if(Session::has('t-success'))
<p id="ms-success" style="display: none">{{session('t-success')}}</p>
<script>
    var ms = document.getElementById('ms-success').innerHTML;
    Swal.fire(
        'Restored!',
        ms,
        'success'
    )
</script>
@endif
@if(Session::has('t-error'))
<p id="ms-error" style="display: none">{{session('t-error')}}</p>
<script>
    var ms = document.getElementById('ms-error').value;
    Swal.fire({
        type: 'error',
        title: ms,
        text: 'Something went wrong!',
    })
</script>
@endif
@section('title-left')
<nav aria-label="breadcrumb" style="font-size : 20px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Trash</li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
        <?php 
            $page = @$_GET['page'];
            if(!$page){
                $page = 1;
            }

            $i = config('app.row') * ($page - 1) + 1;
        ?>
        @if(Session::has('found'))
        @foreach($users as $u)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->username}}</td>
            <td>{{$u->email}}</td>
            <td>
                <a id="restore" class="btn btn-oval btn-small btn-warning" onclick="confirmAction('Do you want to restore it?')">Restore
                    <i class="fa fa-reset"></i> <p id="user-id" hidden>{{$u->id}}</p>
                </a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5" class="text-danger text-center" style="font-size: 30px">Data Not Found!</td>
        </tr>
        @endif



    </tbody>
</table>
@endsection
@section('js')
<script>
    function confirmAction(massages) {
        var id = document.getElementById('user-id').innerHTML;
        var link = "{{url('users/restore')}}"+"/"+id
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
            confirmButtonText: 'Yes, restore it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                var archor = document.getElementById('restore');
                archor.setAttribute('href', link);
                archor.click();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    "Your imaginary file isn't restore :)",
                    'error'
                )
            }
        })
    }
</script>
@endsection