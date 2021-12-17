@extends('layouts.app')
@section('link')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection
@section('content')
<!-- Main Sidebar Container -->
@include('components.sidebar')
<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<div class="content-wrapper" style="min-height: 1345.31px;">
    <section class="content-header">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1>Edit Asset Type</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/asset-type') }}">Asset Type</a></li>
                            <li class="breadcrumb-item active">Edit Asset Type</li>
                        </ol>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <!-- form start -->
                            <form action="{{ url('/asset-type/update') }}" id="asset-type-form" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group ">
                                        <label for="asset-type">Asset Type</label>
                                        <input id="asset-type" type="text" class="form-control @error('asset_type') is-invalid @enderror" name="asset_type" id="asset-type" placeholder="Type" value="{{ $asset_type->type_name }}" disabled>
                                        @error('asset_type')
                                        <span class="invalid-feedback" id="asset-type-error" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="asset-description">Asset Description</label>
                                        <textarea class="form-control @error('asset_description') is-invalid @enderror" id="asset-description" rows="5" placeholder="Description..." name="asset_description">{{ $asset_type->description }}</textarea>
                                        <span class="invalid-feedback" id="asset-description-error" role="alert">
                                        </span>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $asset_type->id }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-pen mr-2"></i>Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </section>
</div>
<!-- /.content-wrapper -->
@endsection