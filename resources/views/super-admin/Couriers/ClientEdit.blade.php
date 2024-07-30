@extends('super-admin.Layout')
@section('bodycontent')
<div class="content container-fluid">

<div class="page-header" style="padding: 0px;margin: 0px;">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Courier price details
<span class="text-primary" style="float:right">
    <a href="{{ asset('/courier') }}" class="btn btn-danger">Back</a>
</span>
</h3>
</div>
</div>
</div>

@if(session('status'))
<section class="comp-section" id="returnmsgbox">
	<div class="alert alert-success alert-dismissible fade show" role="alert">
    	{{ session('status') }}
    	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</section>
@endif

<style type="text/css">
.newfornt{
    font-size: 14px;
}
.newfontcontrol{
     padding:0px 0px 0px 8px;
     height:25px;
}
</style>

<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<h4 class="card-title">Forward</h4>
<form method="post" action="{{ asset('/courier-priceing') }}">
<!-- Forwoard-Basic -->
<div class="row">
<div class="col-md-2">
    <div class="form-group"><br><br>
    <label>Forward - Basic</label>
    </div>
 </div>
<div class="col-md-2">
    <div class="form-group"><br>
    <label class="newfornt">Weight Slap</label>
    <select name="weightslap" class="form-control newfontcontrol">
        <option value="250gm">250 gm</option>
        <option value="500gm">500 gm</option>
        <option value="1kg">1 kg</option>
        <option value="2kg">2 kg</option>
    </select>
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With State</label>
    <input type="number" name="withstate" class="form-control newfontcontrol" value="{{ $params->fbwithstate }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With Zone</label>
    <input type="number" name="withzone" class="form-control newfontcontrol" value="{{ $params->fbwithzone }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Metro To Metro</label>
    <input type="number" name="metrotometro" class="form-control newfontcontrol" value="{{ $params->fbmtetrotometro }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Rest of india</label>
    <input type="number" name="restofindia" class="form-control newfontcontrol" value="{{ $params->fbrestofindia }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Ext. Location</label>
    <input type="number" name="extralocation" class="form-control newfontcontrol" value="{{ $params->fbextralocation }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Special Destination</label>
    <input type="number" name="special" class="form-control newfontcontrol" value="{{ $params->fbspecaildestination }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge</label>
    <input type="number" name="codcharge" class="form-control newfontcontrol" value="{{ $params->fbcodcharge }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge%</label>
    <input type="number" name="codpersent" class="form-control newfontcontrol" value="{{ $params->fbcodchargepersent }}" placeholder="xxx">
    </div>
</div>
</div>
<!-- Forwoard-Basic -->
<!-- Forwoard-Additional -->
<div class="row" style="font-size: 0.9rem !important;">
<div class="col-md-2">
    <div class="form-group"><br><br>
    <label>Forward - Additional</label>
    </div>
 </div>
<div class="col-md-2">
    <div class="form-group"><br>
    <label class="newfornt">Weight Slap</label>
    <select name="aweightslap" class="form-control newfontcontrol">
        <option value="250gm">250 gm</option>
        <option value="500gm">500 gm</option>
        <option value="1kg">1 kg</option>
        <option value="2kg">2 kg</option>
    </select>
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With State</label>
    <input type="number" name="awithstate" class="form-control newfontcontrol" value="{{ $params->fawithstate }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With Zone</label>
    <input type="number" name="awithzone" class="form-control newfontcontrol" value="{{ $params->fawihtzone }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Metro To Metro</label>
    <input type="number" name="ametrotometro" class="form-control newfontcontrol" value="{{ $params->fametrotometro }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Rest of india</label>
    <input type="number" name="arestofindia" class="form-control newfontcontrol" value="{{ $params->faresttoindia }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Ext. Location</label>
    <input type="number" name="aextralocation" class="form-control newfontcontrol" value="{{ $params->faextralocation }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Special Destination</label>
    <input type="number" name="aspecial" class="form-control newfontcontrol" value="{{ $params->faspecialdestination }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge</label>
    <input type="number" name="acodcharge" class="form-control newfontcontrol" value="{{ $params->facodcharge }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge%</label>
    <input type="number" name="acodpersent" class="form-control newfontcontrol" value="{{ $params->facodchargepersent }}" placeholder="xxx">
    </div>
</div>
</div>
<!-- Forward-Additional -->
<h4 class="card-title">RTO</h4>
<!-- RTO-Basic -->
<div class="row">
<div class="col-md-2">
    <div class="form-group"><br><br>
    <label>RTO - Basic</label>
    </div>
 </div>
<div class="col-md-2">
    <div class="form-group"><br>
    <label class="newfornt">Weight Slap</label>
    <select name="rweightslap" class="form-control newfontcontrol">
        <option value="250gm">250 gm</option>
        <option value="500gm">500 gm</option>
        <option value="1kg">1 kg</option>
        <option value="2kg">2 kg</option>
    </select>
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With State</label>
    <input type="number" name="rwithstate" class="form-control newfontcontrol" value="{{ $params->rbwithstate }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With Zone</label>
    <input type="number" name="rwithzone" class="form-control newfontcontrol" value="{{ $params->rbwithzone }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Metro To Metro</label>
    <input type="number" name="rmetrotometro" class="form-control newfontcontrol" value="{{ $params->rbmetrotometro }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Rest of india</label>
    <input type="number" name="rrestofindia" class="form-control newfontcontrol" value="{{ $params->rbresttoindia	 }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Ext. Location</label>
    <input type="number" name="rextralocation" class="form-control newfontcontrol" value="{{ $params->rbextralocation }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Special Destination</label>
    <input type="number" name="rspecial" class="form-control newfontcontrol" value="{{ $params->rbspeciladestination }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge</label>
    <input type="number" name="rcodcharge" class="form-control newfontcontrol" value="{{ $params->rbcodcharge }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge%</label>
    <input type="number" name="rcodpersent" class="form-control newfontcontrol" value="{{ $params->rbcodchargepersent }}" placeholder="xxx">
    </div>
</div>
</div>
<!-- RTO-Basic -->
<!-- RTO-Additional -->
<div class="row" style="font-size: 0.9rem !important;">
<div class="col-md-2">
    <div class="form-group"><br><br>
    <label>RTO - Additional</label>
    </div>
 </div>
<div class="col-md-2">
    <div class="form-group"><br>
    <label class="newfornt">Weight Slap</label>
    <select name="raweightslap" class="form-control newfontcontrol">
        <option value="250gm">250 gm</option>
        <option value="500gm">500 gm</option>
        <option value="1kg">1 kg</option>
        <option value="2kg">2 kg</option>
    </select>
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With State</label>
    <input type="number" name="rawithstate" class="form-control newfontcontrol" value="{{ $params->rawithstate }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">With Zone</label>
    <input type="number" name="rawithzone" class="form-control newfontcontrol" value="{{ $params->rawithzone }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Metro To Metro</label>
    <input type="number" name="rametrotometro" class="form-control newfontcontrol" value="{{ $params->rametrotometro }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Rest of india</label>
    <input type="number" name="rarestofindia" class="form-control newfontcontrol" value="{{ $params->raresttoindia }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Ext. Location</label>
    <input type="number" name="raextralocation" class="form-control newfontcontrol" value="{{ $params->raextralocation }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Special Destination</label>
    <input type="number" name="raspecial" class="form-control newfontcontrol" value="{{ $params->raspecialdestination }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge</label>
    <input type="number" name="racodcharge" class="form-control newfontcontrol" value="{{ $params->racodcharge }}" placeholder="xxx">
    </div>
</div>
<div class="col-md-1">
    <div class="form-group">
    <label class="newfornt">Cod Charge%</label>
    <input type="number" name="racodpersent" class="form-control newfontcontrol" value="{{ $params->racodchargepersent }}" placeholder="xxx">
    </div>
</div>
</div>
<!-- RTO-Additional -->

<div class="row">
<div class="col-md-8"></div>
<div class="col-md-4">
    <div class="text-end mt-4">
        @csrf
        <input type="hidden" name="courieridis" value="{{ $params->courierid }}">
        <button type="submit" class="btn btn-primary">Save Courier Price</button>
    </div>
</div>
</form>







</div>
</div>
</div>
</div>
</div>


@endsection
