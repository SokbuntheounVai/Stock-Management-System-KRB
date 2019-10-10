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

@section('title-left')
<nav aria-label="breadcrumb" style="font-size : 20px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Security</li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
</nav>
@endsection

<div class="card card-grey">
    <div class="card-block">
        <!-- <h1 class="text-secondary">USER</h1> -->
        <a href="{{url('users/create')}}" class="btn btn-success btn-small">Create <i class="fa fa-plus"></i></a>
        <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="card card-gray">
    <div class="card-block">
        <table class="table table-sm table-bordered">
            <thead style="font-size : 15px">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size : 14px">
                <?php
                $page = @$_GET['page'];
                if (!$page) {
                    $page = 1;
                }

                $i = config('app.row') * ($page - 1) + 1;
                ?>

                @if(Session::has('have'))
                @foreach($users as $u)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->username}}</td>
                    <td>{{$u->email}}</td>
                    <td width="20%" class="text-center">
                        <a id="remove" class="btn btn-oval btn-small btn-danger" onclick="confirmAction('Do you want to delete it?',{{$u->id}})">Remove
                            <i class="fa fa-trash"></i>
                        </a>
                        <a id="edit" class="btn btn-oval btn-small btn-primary">Edit
                            <i class="fa fa-edit"></i>
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
    </div>
</div>
@endsection
@section('js')
<script>
    var idAuth = {{Auth::user()->id}}

    function confirmAction(massages, id) {
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
                var archor = document.getElementById('remove');
                archor.setAttribute('href', "{{url('users/delete')}}"+"/"+id);
                if (id != idAuth) {
                    archor.click();
                } else {
                    archor.setAttribute('href', "{{url('users')}}");

                    swalWithBootstrapButtons.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        confirmButtonText: 'OK',
                        preConfirm: () => {
                            archor.click()
                        }
                    })
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