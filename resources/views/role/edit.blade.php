@extends('layout.app')

@section('title')
    Role Update
@endsection


@section('content')
    <div class="pagetitle">
        <h1>Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Role</li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-title">Role | Update </div>

            <div class="card-body">


                <form class="row" method="POST" id="form_validation" action="{{ route('role.update',$role->id) }}"
                    autocomplete="off">

                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingName" name="name" value="{{ $role->name }}">
                                <label for="floatingName">Role Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        @php
                            $role_ids_arr = $role->permissions->pluck('id')->toArray();
                        @endphp

                        @foreach ($permissions as $permission)

                            <div class="col-md-2">
                                <input @if(in_array($permission->id,$role_ids_arr)) checked @endif type="checkbox" name="permission_ids[]"  value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                <label for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach

                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>

                </form>



            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        // alert('dfd');
    </script>
@endpush
