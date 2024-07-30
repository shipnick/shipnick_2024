@extends('Admin.Layout')

@section('bodycontent')

<div class="main-panel"> 
<div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">API Requirement Fields</h4>
                <p class="card-description">

                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">
                                    1
                                </th>
                                <th width="50%">
                                    Courier Name
                                </th>
                                <th>
                                    <div class="">
                                        <input type="text" class="form-control" name="remmitday" />
                                    </div>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    2
                                </td>
                                <th>
                                    Documentation File
                                </th>
                                <td>
                                    <div class="form-group col-md-12">

                                        <input type="file" name="img[]" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload  file ">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                    </div>

                            </tr>
                            <tr>
                                <td>
                                    3
                                </td>
                                <th>
                                    Live Secret Key
                                </th>
                                <td>
                                    <div class="">
                                        <input type="text" class="form-control" name="remmitday" />
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    4
                                </td>
                                <th>
                                    Live Token Key
                                </th>
                                <td>
                                    <div class="">
                                        <input type="text" class="form-control" name="remmitday" />
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    5
                                </td>
                                <th>
                                    Live Bearear Token
                                </th>
                                <td>
                                    <div class="">
                                        <input type="text" class="form-control" name="remmitday" />
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    6
                                </td>
                                <th>
                                    Testting Secret key
                                </th>
                                <td>
                                    <div class="">
                                        <input type="text" class="form-control" name="remmitday" />
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    7
                                </td>
                                <th>
                                    Testting Token Key
                                </th>
                                <td>
                                    <div class="">
                                        <input type="text" class="form-control" name="remmitday" />
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    8
                                </td>
                                <th>
                                    Testting Bearear Token
                                </th>
                                <td>
                                    <div class="">
                                        <input type="text" class="form-control" name="remmitday" height="8px" />
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td colspan="3"> <a href="javascript:void(0);" class="btn btn-outline-primary " >submit</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection