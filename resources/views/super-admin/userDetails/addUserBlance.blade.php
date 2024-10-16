@extends('super-admin.Layout2')

@php(error_reporting(1))
@section('bodycontent')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Blance </a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">

        <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add User Blance </h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{url('user-wallet-blance-add')}}/{{ $params->id }}" method="post">@csrf
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label"> Name</label>
                                            <div class="col-sm-6">
                                               <h4>{{ $params->name }}</h4>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Emial</label>
                                            <div class="col-sm-6">
                                                <h4>{{ $params->username }}</h4>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">total Orders</label>
                                            <div class="col-sm-6">
                                                <h4>2000</h4>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Type of amount </label>
                                            <div class="col-sm-6">
                                                <input type="text" name="Type" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Add  Blance </label>
                                            <div class="col-sm-6">
                                                <input type="text" name="amount" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-6">
                                                
                                                <textarea name="description"  class="form-control" id=""></textarea>
                                            </div>
                                        </div>
                                        
                                       
                                        
                                        
                                        <div class="mb-3 row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
        </div>
    </div>
</div>




@endsection