@extends('super-admin.Layout')

@section('bodycontent')
<?php
// error_reporting(1);
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<!-- Status Switch Code -->
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 17px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(13px);
        -ms-transform: translateX(13px);
        transform: translateX(13px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 17px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .table td img,
    .jsgrid .jsgrid-table td img {
        border-radius: 0px;
    }
</style>
<!-- Status Switch Code -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-6 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">API Assing Admin-Wise</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Courier </th>
                                        <th>Active/Deactive Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $crtusers['username'];
                                    $useridisa = $crtusers['id'];
                                    ?>

                                    <tr class="gradeX">
                                        <td>
                                            <img src="{{ asset('Couriers/parclex@gmail.com/parclex.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['Parclex']) {
                                            ?>
                                                <b style='color:green'> - Parclex</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - Parclex</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='Parclex'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['Parclex']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td>
                                            <img src="{{ asset('Couriers/shiprocket@gmail.com/shiprocket.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['Shiprocket']) {
                                            ?>
                                                <b style='color:green'> - Shiprocket</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - Shiprocket</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='Shiprocket'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['Shiprocket']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td>
                                            <img src="{{ asset('Couriers/intargos1@gmail.com/intargos.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['Intargos1']) {
                                            ?>
                                                <b style='color:green'> - Intargos1</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - Intargos1</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='Intargos1'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['Intargos1']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>

                                    </tr>
                                    <tr class="gradeX">

                                        <td>
                                            <img src="{{ asset('Couriers/shadowfax@gmail.com/shadowfax.png') }}" style="width:50px;height:50px">

                                            <?php
                                            if ($crtusers['Shadowfax']) {
                                            ?>
                                                <b style='color:green'> - Shadowfax</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - Shadowfax</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='Shadowfax'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['Shadowfax']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="gradeX">

                                        <td>
                                            <img src="{{ asset('Couriers/ecomexpress@gmail.com/ecomexpress.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['EcomExpress']) {
                                            ?>
                                                <b style='color:green'> - EcomExpress</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - EcomExpress</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='EcomExpress'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['EcomExpress']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="gradeX">

                                        <td>
                                            <img src="{{ asset('Couriers/nimbus@gmail.com/nimbis.jpg') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['Nimbus']) {
                                            ?>
                                                <b style='color:green'> - Nimbus</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - Nimbus</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='Nimbus'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['Nimbus']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="gradeX">

                                        <td>
                                            <img src="{{ asset('Couriers/intargos@gmail.com/intargos.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['Intargos']) {
                                            ?>
                                                <b style='color:green'> - Intargos</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - Intargos</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='Intargos'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['Intargos']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="gradeX">

                                        <td>
                                            <img src="{{ asset('Couriers/smartship@gmail.com/smartship.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['SmatShip']) {
                                            ?>
                                                <b style='color:green'> - SmartShip</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - SmartShip</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='SmartShip'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['SmartShip']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="gradeX">

                                        <td>
                                            <img src="{{ asset('Couriers/smartship@gmail.com/xpressbees.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['Xpressbees']) {
                                            ?>
                                                <b style='color:green'> - Xpressbees</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - Xpressbess</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='Xpressbees'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['Xpressbees']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    <tr class="gradeX">

                                        <td>
                                            <img src="{{ asset('Couriers/bluedart@gmail.com/bluedart.png') }}" style="width:50px;height:50px">
                                            <?php
                                            if ($crtusers['bluedart']) {
                                            ?>
                                                <b style='color:green'> - BlueDart</b>
                                            <?php
                                            } else {
                                            ?>
                                                <b style='color:red'> - BlueDart</b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{ asset('/super-courier-assign-updated') }}">
                                                <input type='hidden' name='courname' value='bluedart'>
                                                <input type='hidden' name='clientidisause' value='<?= $useridisa ?>'>
                                                <?php
                                                if ($crtusers['bluedart']) {
                                                ?>
                                                    <button class='btn btn-warning'>Deactive</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button class='btn btn-success'>Active</button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>



                                </tbody>
                                <script type="text/javascript">
                                    function docstatus(valis, courname) {
                                        //   alert(valis);
                                        //   alert(courname);
                                        $.ajax({
                                            type: "GET",
                                            url: "super-courier-assign-updated",
                                            data: {
                                                clientidisause: valis,
                                                courname: courname
                                            },
                                            success: function(data) {
                                                // location.reload();
                                                alert(data);
                                                // $("#Select_Desingnation").html(data);
                                            },
                                            error: function(data) {
                                                // location.reload();
                                                alert(data);
                                                // console.log('Error:', data);
                                            }
                                        });
                                    }
                                </script>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">rate list Admin-Wise</h4>
                        <a href="{{ url('add-rate/' . $useridisa) }}" class="btn btn-primary">Add Rate List</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Courier </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                        @foreach ($params1 as $post)
                                    <tr>
                                        <td>{{ $post->courier_name }} {{ $post->weight }}</td>
                                        <td><a href="/edit-rate/{{$post->id }}"> Edit</a><a href="/rate-delete/{{$post->id }}"> Delete</a> </td>

                                    </tr>
                                    @endforeach
                                    </tr>




                                </tbody>
                                <script type="text/javascript">
                                    function docstatus(valis, courname) {
                                        //   alert(valis);
                                        //   alert(courname);
                                        $.ajax({
                                            type: "GET",
                                            url: "super-courier-assign-updated",
                                            data: {
                                                clientidisause: valis,
                                                courname: courname
                                            },
                                            success: function(data) {
                                                // location.reload();
                                                alert(data);
                                                // $("#Select_Desingnation").html(data);
                                            },
                                            error: function(data) {
                                                // location.reload();
                                                alert(data);
                                                // console.log('Error:', data);
                                            }
                                        });
                                    }
                                </script>


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