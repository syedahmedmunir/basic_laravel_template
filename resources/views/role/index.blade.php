@extends('layout.app')

@section('title')
    Roles
@endsection


@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Role</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-title">Roles | All </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:10%">S.no</th>
                            <th>Role</th>
                            <th style="width:10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('role.edit',$role->id) }}"> <i class="fas fa-edit" title="Edit"></i></a>
                                    <a href="{{ route('role.delete',$role->id) }}"> <i  class="fas fa-trash" title="Delete"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
@endsection
