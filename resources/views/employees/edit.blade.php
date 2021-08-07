@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
    <h1>Employee</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Employee Info</h3>
            <div class="card-tools">
                <a href="{{ route('employees.index') }}">
                    <button class="btn btn-tool" data-title="Back">
                    <i class="fas fa-list"></i>
                    </button>
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <form method="POST" action="{{ route('employee.update', $employee) }}" name="update_employee" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $employee->name }}"class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('profile_image') is-invalid @enderror" name="profile_image" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            </div>
                            @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            @php  $url = isset($employee->image)? '/employee/img/'.$employee->image:asset('/employee/img/dummy.png'); @endphp
                            <img class="profile-user-img img-fluid img-circle" src="{{ $url }}" alt="profile picture">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $employee->email }}" id="email" placeholder="Enter email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Designation</label>
                            <select class="form-control @error('designation_id') is-invalid @enderror" name="designation_id">
                                <option value="">Select Any</option>
                                @foreach ($designations as $designation)
                                <option value="{{ $designation->id}}" {{($designation->id==$employee->designation_id)?'selected':''}}>{{ $designation->title}}</option>
                                @endforeach
                            </select>
                            @error('designation_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.row -->
</div>
@stop

@section('css')
@stop

@section('js')
@stop