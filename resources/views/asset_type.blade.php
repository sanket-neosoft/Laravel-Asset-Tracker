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
                    <h1>Asset Type</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Asset Type</li>
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
                            <table id="example2" style="vertical-align: middle;" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Asset Type</th>
                                        <th>Asset Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sr = 0;
                                    @endphp
                                    @foreach ($asset_types as $asset_type)
                                    @php
                                    $sr++ ;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $sr }}</td>
                                        <td id="type_name">{{ $asset_type->type_name }}</td>
                                        <td>{{ $asset_type->description }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary edit mx-1" data-id="{{ $asset_type->id }}" href="{{ url('/asset-type/edit/' . $asset_type->id) }}"><i class="fas fa-pen mr-2"></i>Edit</a>
                                            <button class="btn btn-primary delete mx-1" data-id="{{ $asset_type->id }}"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    {{ $asset_types->links() }}
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
            let type_name = document.getElementById("type_name");
            let element = this;
            if(confirm(`All assets related to ${type_name.innerHTML} will be deleted. Do you want to Delete ${type_name.innerHTML} asset type`)) {
                $.ajax({
                url: `{{ url('/asset-type/delete/${id}') }}`,
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