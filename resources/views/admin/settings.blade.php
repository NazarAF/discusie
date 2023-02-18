@extends('layouts.app')

@section('title', 'Settings')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Settings</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Routes</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted"><b>Clear</b> and <b>Cached</b> Route Application.</p>
                                <div class="buttons row">
                                    <div class="col">
                                        <a href="{{ route('route', ['action' => 'clear']) }}" class="btn btn-danger btn-block">Clear</a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('route', ['action' => 'cache']) }}" class="btn btn-info btn-block">Cached</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Cache</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted"><b>Clear</b> Cache Application.</p>
                                <div class="buttons row">
                                    <div class="col">
                                        <a href="{{ route('cache') }}" class="btn btn-danger btn-block">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Optimize</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted"><b>Optimize</b> Application.</p>
                                <div class="buttons row">
                                    <div class="col">
                                        <a href="{{ route('optimize') }}" class="btn btn-primary btn-block">Optimize</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Maintenance</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted"><b>Maintance</b> Application.</p>
                                <div class="buttons row">
                                    <div class="col">
                                        <a href="{{ route('maintenance', ['status' => $maintenance]) }}" class="btn btn-{{ $maintenance ? 'danger':'primary' }} btn-block">{{ $maintenance ? 'Stop':'Maintenance' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Sitemap</h4>
                            </div>
                            <div class="card-body">
                                <p class="text-muted"><b>Sitemap</b> Application.</p>
                                <div class="buttons row">
                                    <div class="col">
                                        <a href="{{ route('maintenance', ['status' => $maintenance]) }}" class="btn btn-primary btn-block">Sitemap</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')

@endpush
