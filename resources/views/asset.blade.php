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
                    <h1>Asset</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Asset</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <a href="{{ route('file-export') }}" class="btn btn-primary"><i class="fas fa-arrow-down mr-2"></i>Download</a>
                                </div>
                            </div>
                            <table id="example2" style="vertical-align: middle;" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Asset Name</th>
                                        <th>Asset uuid</th>
                                        <th>Asset Type</th>
                                        <th>Active/Inactive</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assets as $asset)
                                    <tr>
                                        <td id="asset_name">{{ $asset->asset_name }}</td>
                                        <td>{{ $asset->uuid }}</td>
                                        <td>{{ $asset->asset_type->type_name }}</td>
                                        @if($asset->active)
                                        <td>Active</td>
                                        @else
                                        <td>Inactive</td>
                                        @endif
                                        <td class="text-center">
                                            <a class="btn btn-primary edit mx-1" data-id="{{ $asset->id }}" href="{{ url('/asset/edit/' . $asset->id) }}"><i class="fas fa-pen mr-1"></i>Edit</a>
                                            <button class="btn btn-primary delete mx-1" data-id="{{ $asset->id }}"><i class="fas fa-trash-alt mr-1"></i>Delete</button>
                                            <a class="btn btn-primary show mx-1" href="{{ url('/asset/images/' . $asset->uuid) }}"><i class="far fa-images mr-1"></i>Images</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    {{ $assets->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
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
            if (confirm(`Do you really want to delete ${asset_name.innerHTML} ?`)) {
                $.ajax({
                    url: `{{ url('/asset/delete/${id}') }}`,
                    method: "post",
                    data: {
                        _token: `{{ csrf_token() }}`,
                    },
                    success: function(response) {
                        if (response) {
                            $(element).closest("tr").fadeOut();
                            toastr.success(`Asset type ${response} deleted successfully.`);
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