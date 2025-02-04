@extends("UserPanel/userpanel_layout")
@section("userpanel")
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Hub Details</a></li>
					</ol>
                </div>
                <!-- row -->
                @if(session('status')=="Hub Details Delete Successfully")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status'))
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @endif 

                <div class="row">
                    
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Hub Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                            <th>Sno</th>
                                        <th>Hub Code</th>
                                        <!--<th>Logo</th>-->
                                        <th>Hub Name</th>
                                        <th>GST No.</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Pincode</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <!-- <th>Delivery Type</th> -->
                                        <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    @php($i = 1)
                                    @foreach($params as $param)
                                    <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                        <?php if($param->smartship_hubid=="" && $param->smartship_hubid=="R" ){ ?>
                                            <td class="text-danger">invalid details</td>
                                            <?php }elseif($param->smartship_hubid=="R"){ ?>
                                                <td>invalid details</td>
                                                <?php  }else{ ?>
                                        <td>{{ $param->hub_code }}</td>
                                        <?php }  ?>
                                        <!--<td><img src="{{ asset('HubDetails') }}/{{ $param->hub_folder }}/{{ $param->hub_img }}" title="Hub Image" alt="Not Available" style="width:50px;height:50px;"></td>-->
                                        <td>{{ Str::limit($param->hub_name, 20) }}</td>
                                        <td>{{ $param->hub_gstno }}</td>
                                        <td>{{ Str::limit($param->hub_address1, 20) }}</td>
                                        <td>{{ $param->hub_mobile }}</td>
                                        <td>{{ $param->hub_pincode }}</td>
                                        <td>{{ $param->hub_state }}</td>
                                        <td>{{ $param->hub_city }}</td>
                                        <!-- <td>{{ $param->hub_deliverytype }}</td> -->
                                        
                                       
                                        <td >
                                               <a href="{{ asset('UPHub_Edit/'.$param->hub_id) }}" title="Click here to edit hub detail">
                                                    <i class="far fa-edit me-2"></i>Edit
                                                </a>
                                                
                                        </td>
                                       
                                        <!--<td>-->
                                        <!--    <a href="{{ asset('/UPHub_Edit/'.$param->hub_id) }}" title="Click here to edit hub detail"><i class="far fa-edit me-2"></i>Edit</a>-->
                                        <!--</td>-->
                                    </tr>
                                    @php($i++)
                                    @endforeach
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    
                    
                    
                        <!-- /# card -->
                    </div>
                    
                    
                    
                    
                    
                    
						
                    
                </div>
            </div>
        <!--**********************************
            Content body end
        ***********************************-->
		
		 @endsection
	