@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Settings') }}</h5>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-lg-6 col-md-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0">{{ __('Application Settings') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="app_name" class="form-label">{{ __('Application Name') }}</label>
                                            <input id="app_name" type="text" class="form-control @error('app_name') is-invalid @enderror" name="app_name" value="{{ $settings['app_name'] ?? config('app.name', 'Laravel Dashboard') }}" required>
                                            @error('app_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="app_logo" class="form-label">{{ __('Application Logo') }}</label>
                                            <input id="app_logo" type="file" class="form-control @error('app_logo') is-invalid @enderror" name="app_logo">
                                            @error('app_logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            @if(isset($settings['app_logo']) && $settings['app_logo'])
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="App Logo" class="img-thumbnail" style="max-height: 100px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0">{{ __('Theme Settings') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <label for="sidebar_color" class="form-label">{{ __('Sidebar Color') }}</label>
                                            <input id="sidebar_color" type="color" class="form-control form-control-color w-100 @error('sidebar_color') is-invalid @enderror" name="sidebar_color" value="{{ $settings['sidebar_color'] ?? '#343a40' }}" required>
                                            @error('sidebar_color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 form-check form-switch">
                                            <input id="dark_mode" type="checkbox" class="form-check-input @error('dark_mode') is-invalid @enderror" name="dark_mode" value="1" {{ isset($settings['dark_mode']) && $settings['dark_mode'] == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="dark_mode">{{ __('Dark Mode') }}</label>
                                            @error('dark_mode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> {{ __('Save Settings') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection