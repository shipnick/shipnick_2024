
@php(error_reporting(1))

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
                            <!-- <h5 class="m-b-10">Form Elements</h5> -->
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Admin List</a></li>
                            <li class="breadcrumb-item"><a href="#!">Blance Limit</a></li>
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
                        <h5>Add User Blance Limit</h5>
                    </div>
                    <div class="card-body">
                      
                        <form action="{{url('user-wallet-limit-add')}}/{{$params->id}}" method="post">@csrf
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <h5>{{ $params->name }}</h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Emial</label>
                                <div class="col-sm-9">
                                    <h5>{{ $params->username }}</h5>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Set Limit Blance</label>
                                <div class="col-sm-4">
                                    <input type="text" name="amount" class="form-control" id="inputEmail3" placeholder="Enter Amount">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn  btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                    var forms = document.getElementsByClassName('needs-validation');
                                    // Loop over them and prevent submission
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                        form.addEventListener('submit', function(event) {
                                            if (form.checkValidity() === false) {
                                                event.preventDefault();
                                                event.stopPropagation();
                                            }
                                            form.classList.add('was-validated');
                                        }, false);
                                    });
                                }, false);
                            })();
                        </script>
                       
                    </div>
                </div>
               
            </div>
            <!-- [ form-element ] end -->
        </div>
        <!-- [ Main Content ] end -->

    </div>
</section>




@endsection