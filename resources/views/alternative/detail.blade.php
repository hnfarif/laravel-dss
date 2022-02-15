@extends('template.index')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Biodata Alternatif</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <label for="">Name : {{ $alternatives->name }}</label>
                            </div>
                            <div class="row">

                                <label for="">Birthdate : {{ $alternatives->birthdate }}</label>
                            </div>
                            <div class="row">

                                <label for="">Gender : {{ $alternatives->gender }}</label>
                            </div>
                            <div class="row">

                                <label for="">Address : {{ $alternatives->address }}</label>
                            </div>
                            <div class="row">

                                <label for="">Religion : {{ $alternatives->religion }}</label>
                            </div>
                            <div class="row">

                                <label for="">Marital Status : {{ $alternatives->marital_status }}</label>
                            </div>
                            <div class="row">

                                <label for="">Job : {{ $alternatives->job }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
