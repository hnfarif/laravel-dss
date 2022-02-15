@extends('template.index')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit alternative</h1>
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
                        {{-- <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                        @endforeach
                        </ul>

                    </div>
                    @endif
                    <form action="{{route('alternatives.update', $alternative->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <div class="input-group">
                                <input id="name" type="text" class="form-control" placeholder="e.g. Speed" name="name"
                                    value="{{ $alternative->name }}" disabled>
                            </div>
                        </div>
                        @foreach ($criteriaweights as $key => $cw)
                        <div class="form-group">
                            <label for="criteria[{{$cw->id}}]">{{$cw->name}} :</label>
                            <select class="form-control" id="criteria[{{$cw->id}}]" name="criteria[{{$cw->id}}]">
                                <!--
                                        @php
                                            $res = $criteriaratings->where('criteria_id', $cw->id)->all();
                                        @endphp
                                        -->
                                @foreach ($res as $cr)
                                <option value="{{$cr->id}}"
                                    {{ $cr->id == $alternativescores[$key]->rating_id ? "selected=selected" : "" }}>

                                    {{$cr->description}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> --}}
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{route('alternatives.update', $alternative->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <h5>Biodata</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name :</label>
                                    <div class="input-group">
                                        <input id="name" type="text" class="form-control"
                                            value="{{ $alternative->name }}" placeholder="Someone or Something"
                                            name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="birthdate">Birthdate :</label>
                                    <div class="input-group">
                                        <input id="birthdate" type="date" value="{{ $alternative->birthdate }}"
                                            class="form-control" name="birthdate" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="gender">Gender :</label>
                                    <div class="input-group">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="laki-laki"
                                                {{ $alternative->gender == "laki-laki" ? "selected=selected":"" }}>L
                                            </option>
                                            <option value="perempuan"
                                                {{ $alternative->gender == "perempuan" ? "selected=selected":"" }}>P
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Address :</label>
                                    <div class="input-group">
                                        <input id="address" type="text" value="{{ $alternative->address }}"
                                            class="form-control" name="address" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="religion">Religion :</label>
                                    <div class="input-group">
                                        <select class="form-control" id="religion" name="religion">
                                            <option value="Islam"
                                                {{ $alternative->religion == "Islam" ? "selected=selected":"" }}>Islam
                                            </option>
                                            <option value="Kristen"
                                                {{ $alternative->religion == "Kristen" ? "selected=selected":"" }}>
                                                Kristen</option>
                                            <option value="Hindu"
                                                {{ $alternative->religion == "Hindu" ? "selected=selected":"" }}>Hindu
                                            </option>
                                            <option value="Buddha"
                                                {{ $alternative->religion == "Buddha" ? "selected=selected":"" }}>Buddha
                                            </option>
                                            <option value="Konghucu"
                                                {{ $alternative->religion == "Konghucu" ? "selected=selected":"" }}>
                                                Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="marital_status">Marital Status :</label>
                                    <div class="input-group">
                                        <select class="form-control" id="marital_status" name="marital_status">
                                            <option value="Belum Kawin"
                                                {{ $alternative->marital_status == "Belum Kawin" ? "selected=selected":"" }}>
                                                Belum Kawin</option>
                                            <option value="Sudah Kawin"
                                                {{ $alternative->marital_status == "Sudah Kawin" ? "selected=selected":"" }}>
                                                Sudah Kawin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="job">Job :</label>
                                    <div class="input-group">
                                        <input id="job" type="text" value="{{ $alternative->job }}" class="form-control"
                                            name="job" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Scoring Criteria</h5>
                        @foreach ($criteriaweights as $key => $cw)
                        <div class="form-group">
                            <label for="criteria[{{$cw->id}}]">{{$cw->name}} :</label>
                            <select class="form-control" id="criteria[{{$cw->id}}]" name="criteria[{{$cw->id}}]">
                                <!--
                                        @php
                                            $res = $criteriaratings->where('criteria_id', $cw->id)->all();
                                        @endphp
                                        -->
                                @foreach ($res as $cr)
                                <option value="{{$cr->id}}"
                                    {{ $cr->id == $alternativescores[$key]->rating_id ? "selected=selected" : "" }}>

                                    {{$cr->description}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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
