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
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Super-admin </a></li>
                                <li class="breadcrumb-item"><a href="#!">Pincode</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Upload Pincode</h5>
                        </div>
                        <div class="card-body">
                            <form  action="super-picode-add" method="post" enctype="multipart/form-data" novalidate>@csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Select Courier </label>
                                        <select id="inputState" class="form-control" name="courier">
                                            <option value="" disabled selected>Select...</option>
											<option value="ecom">Ecom</option>
											<option value="xpress">xpress</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label" for="Text">Upload orders excel file (CSV
                                                only)</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="bulkpincode" accept=".csv" onchange="checkFileContent()" required>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <label class="custom-file-label" for="validatedCustomFile">Choose
                                                    file...</label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mt-4" >
                                        <div class="form-group mt-1"  >
                                            <button class="btn  btn-primary" type="submit">Submit form</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- [ stiped-table ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pincode Details</h5>
                            <span class="d-block m-t-5"></span>

                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Courier</th>
                                            <th>Total Pincode</th>
    
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pincode as $data)
                                        <tr>
                                            <td>1</td>
                                            <td>{{$data->courier}}</td>
                                            <td>{{$data->total_count}}</td>
                                            <td><a href="{{('pincode-bulk-delete')}}/{{$data->id}}" title="Click here to edit hub detail"><i class="far fa-edit me-2"></i>Delete</a>
    
                                            </td>
    
                                        </tr>
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