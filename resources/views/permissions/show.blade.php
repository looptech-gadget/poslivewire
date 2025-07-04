@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Permission Details') }}</span>
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Permissions
                    </a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">ID:</div>
                        <div class="col-md-9">{{ $permission->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Name:</div>
                        <div class="col-md-9">{{ $permission->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Created At:</div>
                        <div class="col-md-9">{{ $permission->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Updated At:</div>
                        <div class="col-md-9">{{ $permission->updated_at->format('Y-m-d H:i:s') }}</div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="btn-group" role="group">
                                @can('edit permissions')
                                <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @endcan
                                @can('delete permissions')
                                <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this permission?')">
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