@extends('layouts.app')
@section('link')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection
@section('content')
<!-- Main Sidebar Container -->
@include('components.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 1345.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Images</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/asset') }}">Asset</a></li>
                        <li class="breadcrumb-item active">Images</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($images as $image)
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <img src="{{ asset('images/' . $image->image) }}" style="object-fit: cover; object-position: middle; height: 300px; width: 100%" alt="">
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary delete" data-id="{{ $image->id }}"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                @endforeach
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script>
    $(() => {
        $(".delete").on("click", function() {
            let id = $(this).data("id");
            let element = this;
            let asset_name = document.getElementById("asset_name")
            if (confirm(`Do you really want to delete that image ?`)) {
                $.ajax({
                    url: `{{ url('/asset/images/delete/${id}') }}`,
                    method: "post",
                    data: {
                        _token: `{{ csrf_token() }}`,
                    },
                    success: function(response) {
                        if (response) {
                            $(element).closest(".col-md-3").fadeOut();
                            toastr.success(`Asset image deleted successfully.`);
                        }
                    }
                });
            }
        });
    });
</script>
@if (session()->has('status'))
<script>
    toastr.success("{!! session('status') !!}");
</script>
@endif
@endsection