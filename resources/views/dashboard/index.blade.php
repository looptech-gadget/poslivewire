@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Welcome to the Laravel Dashboard</h4>
                    <p>Use the sidebar to navigate through the different sections of the dashboard.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text display-4">{{ \App\Models\User::count() }}</p>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Manage Users</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Roles</h5>
                    <p class="card-text display-4">{{ \Spatie\Permission\Models\Role::count() }}</p>
                    <a href="{{ route('roles.index') }}" class="btn btn-light">Manage Roles</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Permissions</h5>
                    <p class="card-text display-4">{{ \Spatie\Permission\Models\Permission::count() }}</p>
                    <a href="{{ route('permissions.index') }}" class="btn btn-light">Manage Permissions</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection