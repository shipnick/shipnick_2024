@extends('Admin.Layout')
@section('bodycontent')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Courier price details</h3>
                        @if(session('status'))
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @endif
                        <form class="form-sample" method="post" action="{{ asset('/courier-priceing') }}">
                            <p class="card-description">
                                Forward
                            </p>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">Forward - Basic
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Weight Slate</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="weightslap">
                                                    <option value="250gm">250 gm</option>
                                                    <option value="500gm">500 gm</option>
                                                    <option value="1kg">1 kg</option>
                                                    <option value="2kg">2 kg</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With State</label>
                                            <div class="col-sm-6">
                                                <input type="number" name="withstate" value="{{ $params->fbwithstate }}" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With Zone</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ $params->fbwithzone }}" name="withzone" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Metro To Metro</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="metrotometro" value="{{ $params->fbmtetrotometro }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Rest of india</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="restofindia" value="{{ $params->fbrestofindia }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Ext. Location</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="extralocation" value="{{ $params->fbextralocation }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Special Destination</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="special" value="{{ $params->fbspecaildestination }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="codcharge" value="{{ $params->fbcodcharge }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge %</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="codpersent" value="{{ $params->fbcodchargepersent }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">Forward - Additional
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Weight Slate</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="aweightslap">
                                                    <option value="250gm">250 gm</option>
                                                    <option value="500gm">500 gm</option>
                                                    <option value="1kg">1 kg</option>
                                                    <option value="2kg">2 kg</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With State</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="awithstate" value="{{ $params->fawithstate }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With Zone</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="awithzone" value="{{ $params->fawihtzone }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Metro To Metro</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="ametrotometro" value="{{ $params->fametrotometro }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Rest of india</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="arestofindia" value="{{ $params->faresttoindia }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Ext. Location</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="aextralocation" value="{{ $params->faextralocation }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Special Destination</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="aspecial" value="{{ $params->faspecialdestination }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="acodcharge" value="{{ $params->facodcharge }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge %</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="acodpersent" value="{{ $params->facodchargepersent }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description">
                                RTO
                            </p>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">RTO - Basic
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Weight Slate</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="rweightslap">
                                                    <option value="250gm">250 gm</option>
                                                    <option value="500gm">500 gm</option>
                                                    <option value="1kg">1 kg</option>
                                                    <option value="2kg">2 kg</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With State</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rwithstate" value="{{ $params->rbwithstate }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With Zone</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rwithzone" value="{{ $params->rbwithzone }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Metro To Metro</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rmetrotometro" value="{{ $params->rbmetrotometro }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Rest of india</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rrestofindia" value="{{ $params->rbresttoindia	 }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Ext. Location</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rextralocation" value="{{ $params->rbextralocation }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Special Destination</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rspecial" value="{{ $params->rbspeciladestination }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rcodcharge" value="{{ $params->rbcodcharge }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge %</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rcodpersent" value="{{ $params->rbcodchargepersent }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">RTO - Additional
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Weight Slate</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="raweightslap">
                                                    <option value="250gm">250 gm</option>
                                                    <option value="500gm">500 gm</option>
                                                    <option value="1kg">1 kg</option>
                                                    <option value="2kg">2 kg</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With State</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rawithstate"  value="{{ $params->rawithstate }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">With Zone</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rawithzone"  value="{{ $params->rawithzone }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Metro To Metro</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rametrotometro"  value="{{ $params->rametrotometro }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Rest of india</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="rarestofindia"  value="{{ $params->raresttoindia }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Ext. Location</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="raextralocation"  value="{{ $params->raextralocation }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <h4 class="col-sm-12 col-form-label">
                                            </h4>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Special Destination</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="raspecial"  value="{{ $params->raspecialdestination }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="racodcharge"  value="{{ $params->racodcharge }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Cod Charge %</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="racodpersent"  value="{{ $params->racodchargepersent }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="courieridis" value="{{ $params->courierid }}">
                            <button type="submit" class="btn btn-primary mr-2">Save Courier Price</button>

                            <a href="{{ asset('/courier') }}" class="btn btn-light">Back</a>
                        </form>
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