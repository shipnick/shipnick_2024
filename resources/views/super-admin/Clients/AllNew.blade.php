@extends('super-admin.Layout')

@section('bodycontent')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
    
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All Admins <center>

                @if(session('status')=="New Client Added")
                <span class="text-primary" style="font-size:20px;">
                  New client added
                </span>
                @elseif(session('status'))
                <span class="text-primary" style="font-size:20px;">
                  {{ session('status') }}
                </span>
                @endif
              </center>
            </h4>
            <p class="card-description">

              <a href="{{ asset('/super-new-admin') }}" class="btn btn-outline-primary btn-sm">+ New Admin</a>

            </p>
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
                      <a title="Click here to edit client details" href="{{ asset('/super-new-admin-edit/'.$param->id) }}"><i class="far fa-edit me-2"></i>Edit</a>
                      <!-- <a title="Client Details" href="{{ asset('/client-setting/'.$param->id) }}"><i data-feather="settings" class="me-2"></i></a> --> / 
                      <a title="Click here to edit client details" href="{{ asset('/super-courier-assign/'.$param->id) }}"><i class="far fa-edit me-2"></i>Couriers-Assign</a>
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
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:../../partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022.</span>
    </div>
  </footer>
  <!-- partial -->
</div>

@endsection