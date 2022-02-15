 @extends('template.index')

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Add new alternative</h1>
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
                             <form action="{{route('alternatives.store')}}" method="POST">
                                 @csrf
                                 <h5>Biodata</h5>
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="form-group">
                                             <label for="name">Name :</label>
                                             <div class="input-group">
                                                 <input id="name" type="text" class="form-control"
                                                     placeholder="Someone or Something" name="name" required>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="form-group">
                                             <label for="birthdate">Birthdate :</label>
                                             <div class="input-group">
                                                 <input id="birthdate" type="date" class="form-control" name="birthdate"
                                                     required>
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
                                                     <option value="laki-laki">L</option>
                                                     <option value="perempuan">P</option>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="form-group">
                                             <label for="address">Address :</label>
                                             <div class="input-group">
                                                 <input id="address" type="text" class="form-control" name="address"
                                                     required>
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
                                                     <option value="Islam">Islam</option>
                                                     <option value="Kristen">Kristen</option>
                                                     <option value="Hindu">Hindu</option>
                                                     <option value="Buddha">Buddha</option>
                                                     <option value="Konghucu">Konghucu</option>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-4">
                                         <div class="form-group">
                                             <label for="marital_status">Marital Status :</label>
                                             <div class="input-group">
                                                 <select class="form-control" id="marital_status" name="marital_status">
                                                     <option value="Belum Kawin">Belum Kawin</option>
                                                     <option value="Sudah Kawin">Sudah Kawin</option>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-4">
                                         <div class="form-group">
                                             <label for="job">Job :</label>
                                             <div class="input-group">
                                                 <input id="job" type="text" class="form-control" name="job" required>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <hr>
                                 <h5>Scoring Criteria</h5>
                                 @foreach ($criteriaweights as $cw)
                                 <div class="form-group">
                                     <label for="criteria[{{$cw->id}}]">{{$cw->name}} :</label>
                                     <select class="form-control" id="criteria[{{$cw->id}}]"
                                         name="criteria[{{$cw->id}}]">
                                         <!--
                                        @php
                                            $res = $criteriaratings->where('criteria_id', $cw->id)->all();
                                        @endphp
                                        -->
                                         @foreach ($res as $cr)
                                         <option value="{{$cr->id}}">{{$cr->description}}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 @endforeach
                                 <button type="submit" class="btn btn-primary">Submit</button>
                             </form>
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
