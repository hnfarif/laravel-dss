@extends('template.index')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Home</h1>
                    <br>
                    {{-- {{ dd(Session::get('success')) }} --}}
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif($message = Session::get('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
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
                    <a href="{{route('projects.create')}}" class='btn btn-primary mb-2'> <span
                            class='fa fa-plus'></span>Tambah Perhitungan </a>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Perhitungan BPNT</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project as $p)
                                    <tr>

                                        <td>{{ $p->title }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td class="w-25">
                                            <form action="{{ route('criteriaweights.index') }}">
                                                <input type="text" value="{{ $p->id }}" name="id" hidden="hidden">
                                                <input type="text" value="{{ $p->title }}" name="title" hidden="hidden">
                                                <button type="submit" class="btn btn-primary">Lihat Perhitungan</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
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
@section('script')
<script>
    $(document).ready(function () {
        $("#table").dataTable();
    })

</script>
@endsection
