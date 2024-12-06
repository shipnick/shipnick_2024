@extends('super-admin.Layout')

@section('bodycontent')
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <!-- <h5 class="m-b-10">Bootstrap Basic Tables</h5> -->
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!">Super-Admin</a></li>
              <li class="breadcrumb-item"><a href="#!">Admin list</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">

      <!-- [ stiped-table ] start -->
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header">
            <h5>All Admins</h5>
            <span class="d-block m-t-5"> Admin list</span>
            <div class="card-header-right">
              <div class="btn-group card-option">
              <button onclick="window.history.back()" class="btn btn-primary">Back</button> &nbsp;&nbsp;
                <a href="{{ asset('/super-new-admin') }}" class="btn btn-primary">Add Admin</a>

              </div>
            </div>
          </div>
          <div class="card-body table-border-style">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Admins</th>
                    <th>Name</th>
                    <th>E-mail ID</th>
                    <th>Contact No.</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @php($i = 1)
                  @foreach($params as $param)
                  <tr class="gradeX">
                    <td>{{ $i }}</td>
                    <td>{{ $param->name }}</td>
                    <td>{{ $param->username }}</td>
                    <td>{{ $param->mobile }}</td>
                    <td>
                      @if($param->status)
                      <span style="color:green">Active</span>
                      @else
                      <span style="color:red">Deactive</span>
                      @endif
                    </td>
                    <td>
                        <a  href="{{ asset('/super-new-admin-delete/'.$param->id) }}">Delete</a>/
                      <a title="Click here to edit client details" href="{{ asset('/super-new-admin-edit/'.$param->id) }}"><i class="far fa-edit me-2"></i>Edit</a>
                      <!-- <a title="Client Details" href="{{ asset('/client-setting/'.$param->id) }}"><i data-feather="settings" class="me-2"></i></a> --> /
                      <a title="Click here to edit client details" href="{{ asset('/super-courier-assign/'.$param->id) }}"><i class="far fa-edit me-2"></i>Couriers-Assign</a>
                      / <a href="{{ asset('/super-courier-rate/'.$param->id) }}">Rate-Assign</a>
                    </td>
                  </tr>
                  @php($i++)
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- [ stiped-table ] end -->

    </div>
    <!-- [ Main Content ] end -->
  </div>
</section>

@endsection
