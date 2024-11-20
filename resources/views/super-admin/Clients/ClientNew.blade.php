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
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Admin List</a></li>
                            <li class="breadcrumb-item"><a href="#!">Admin Registration</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        @if(session('status')=="New Client Added")
	<span class="alert alert-primary" role="alert">
        New client added
    </span>
	@elseif(session('status'))
    <div class="alert alert-primary" role="alert">
    {{ session('status') }}
						</div>
	<span class="text-primary" style="font-size:20px;">
		
	
	@endif
        <!-- [ Main Content ] start -->
        <div class="row">


            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Admin Registration</h5>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation" action="{{ asset('/super-new-admin') }}" method="post" enctype="multipart/form-data" novalidate>@csrf
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom01"> Company Name</label>
                                    <input type="text" name="companyname" class="form-control" id="validationCustom01" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02"> Email / Username</label>
                                    <input type="text" class="form-control" name="email" id="validationCustom02"
                                         required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Company Logo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profilepic" id="validatedCustomFile">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose
                                            file...</label>

                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustomUsername">Mobile</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">91</span>
                                        </div>
                                        <input type="text" class="form-control" name="mobile" id="validationCustomUsername"
                                             aria-describedby="inputGroupPrepend" required>
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Password</label>
                                    <input type="text" class="form-control" id="validationCustom02"
                                         name="password" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>


                            <button class="btn  btn-primary" type="submit">Submit</button>
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
