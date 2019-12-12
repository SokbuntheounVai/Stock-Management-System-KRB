@extends('layouts.master')
@section('content')
<script>
    function checkedPass(){
        var password = document.getElementById('password');
        var repassword = document.getElementById('re-password');

        if(password.value!=repassword.value){
            password.setAttribute('style' ,'border : 1px solid red');
            repassword.setAttribute('style' ,'border : 1px solid red');
        }else{
            var formCreate = document.getElementById('form-create');
            formCreate.setAttribute('action',"{{url('users/update')}}");
            // formCreate.click();

        }
    }
</script>
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
        <li class="breadcrumb-item active" aria-current="page">Users</li>
        <li class="breadcrumb-item active" aria-current="page">Update</li>
    </ol>
</nav>
@endsection
<form id="form-create" action="#"  method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('POST')}}
    <div class="card card-grey">
        <div class="card-block">
            <!-- <h1 class="text-secondary">USER</h1> -->
            <a href="{{url('users')}}" class="btn btn-warning btn-small">Back <i class="fa fa-reply"></i></a>
            <button style="float : right" onclick="checkedPass()" class="btn btn-success btn-small">Save <i class="fa fa-database"></i></button>
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
            @foreach($users as $u)
            <input type="hidden" name="id" value="{{$u->id}}">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3" style="font-size : 18px">Full Name <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" value="{{$u->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3" style="font-size : 18px">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{$u->username}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3" style="font-size : 18px">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{$u->email}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3" style="font-size : 18px">Password <span class="text-danger">*</span></label>
                        <div class="col-sm-8">  
                            <input type="password" id="password" name="password" onchange="checkPass()" class="form-control" placeholder="Password">
                            <p class="small-text">Keep it blank to use the password!</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="re-password" class="col-sm-3" style="font-size : 18px">Re-Password <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" id="re-password" name="re_password" class="form-control" placeholder="Re-Password">
                            <p class="small-text">Keep it blank to use the password!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label for="photo" style="font-size : 18px" class="col-sm-3">Photo</label>
                        <div class="col-sm-8">
                            <input type="file" name="photo" id="photo" class="form-control"  onchange="preview(event)" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                    </div>
                    <p style="margin-top: 9px; text-align: center">
                        <img id="preview-photo"  width="50%" src="{{asset($u->photo)}}" alt="">
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>
    function preview(evt){
        let checkedPhoto = document.getElementById('preview-photo');
        checkedPhoto.src = URL.createObjectURL(evt.target.files[0]);
    }
</script>
@endsection