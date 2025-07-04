@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Role Details') }}</span>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Roles
                    </a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">ID:</div>
                        <div class="col-md-9">{{ $role->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Name:</div>
                        <div class="col-md-9">{{ $role->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Permissions:</div>
                        <div class="col-md-9">
                            @foreach($role->permissions as $permission)
                                <span class="badge bg-info">{{ $permission->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Created At:</div>
                        <div class="col-md-9">{{ $role->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Updated At:</div>
                        <div class="col-md-9">{{ $role->updated_at->format('Y-m-d H:i:s') }}</div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="btn-group" role="group">
                                @can('edit roles')
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @endcan
                                @can('delete roles')
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection