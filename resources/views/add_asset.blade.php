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
                        <h1>Add Asset</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/asset') }}">Asset</a></li>
                            <li class="breadcrumb-item active">Add Asset</li>
                        </ol>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <!-- form start -->
                            <form action="{{ url('/asset/add/insert') }}" id="asset-type-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group ">
                                        <label for="asset-name">Asset name</label>
                                        <input id="asset-name" type="text" class="form-control @error('asset_name') is-invalid @enderror" name="asset_name" id="asset-name" placeholder="Asset name" autofocus>
                                        @error('asset_name')
                                        <span class="invalid-feedback" id="asset-type-error" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label for="asset-type">Asset Type</label>
                                        <select name="asset_type" class="form-control" id="asset-type">
                                            <option selected disabled>--- Select Asset type ---</option>
                                            @foreach ($asset_types as $asset_type)
                                            <option value="{{ $asset_type->id }}">{{ $asset_type->type_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('asset_type'))
                                        <span class="invalid-feedback" id="asset-type-error" role="alert">{{ $errors->first('asset_type') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="asset-image">Asset Images</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="assset-images" name="asset_images[]" multiple accept="image/*">
                                                <label class="custom-file-label" for="asset-image">Choose file</label>
                                            </div>
                                        </div>
                                        @error('asset_images')
                                        <span class="invalid-feedback" id="asset-type-error" role="alert">{{ $message }}</span>
                                        @enderror
                                        <small id="emailHelp" class="form-text text-muted">(optional)</small>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked name="active">
                                        <label class="custom-control-label" for="customSwitch1">Active</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i>Add</button>
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
@section('script')
@if ( session()->has('status'))
<script>
    toastr.success("{!! session('status') !!}");
</script>
@endif
@endsection