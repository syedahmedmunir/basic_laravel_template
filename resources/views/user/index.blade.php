@extends('layout.app')

@section('title')
    User
@endsection


@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-title">Users | All </div>

            <div class="card-body">



                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit',$user->id) }}"> <i class="fas fa-edit" title="Edit"></i></a>
                                    <a href="{{ route('user.delete',$user->id) }}"> <i  class="fas fa-trash" title="Delete"></i></a>
                                </td>

                               
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>




            </div>
        </div>
    </div>
@endsection
