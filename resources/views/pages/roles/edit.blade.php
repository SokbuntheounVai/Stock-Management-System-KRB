@extends('layouts.master')
@section('content')

@if(Session::has('success'))
<p id="ms-success" style="display: none">{{session('success')}}</p>
<script>
    var ms = document.getElementById('ms-success').value;
    Swal.fire(
        'Updated!',
        ms,
        'success'
    )
</script>
@endif
@if(Session::has('error'))
<p id="ms-error" style="display: none">{{session('error')}}</p>
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
        <li class="breadcrumb-item active" aria-current="page">Security</li>
        <li class="breadcrumb-item active" aria-current="page">Roles</li>
        <li class="breadcrumb-item active" aria-current="page">Update</li>
    </ol>
</nav>
@endsection
<form id="form-create" action="{{url('roles/update')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="card card-grey">
        <div class="card-block">
            <!-- <h1 class="text-secondary">USER</h1> -->
            <a href="{{url('roles')}}" class="btn btn-warning btn-small">Back <i class="fa fa-reply"></i></a>
            <button style="float : right"  class="btn btn-success btn-small">Save <i class="fa fa-database"></i></button>
        </div>
    </div>
    <hr>

    <div class="card card-gray">
        <div class="card-block">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            @foreach($roles as $u)
            <input type="hidden" name="id" value="{{$u->id}}">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3" style="font-size : 18px">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{$u->name}}" required>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</form>
@endsection
@section('js')
<script>
    // function preview(evt) {
    //     let checkedPhoto = document.getElementById('preview-photo');
    //     checkedPhoto.src = URL.createObjectURL(evt.target.files[0]);
    // }
</script>
@endsection