@extends('super-admin.Layout')
@section('bodycontent')
<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Non-Delivery Reports 
	<span style="font-size:14px;color:#e91e63 !important;font-weight:600">&ensp;* Last 5 Days</span>
</h3>
</div>
<div class="col-auto">
<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">Upload NDR Report</a>
</a>
</div>
</div>
</div>

@if(session('status')=="NDR report successfully uploaded")
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

<div id="add_tax" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Upload Orders</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<!-- <form> -->
<div class="form-group">
<label>Upload orders via excel file<span class="text-danger">*</span></label>
</div>
<div class="form-group">
<label>Sample file is available for download<span class="text-danger">*</span>
<a href="{{ asset('/MISExcelFiles/NDR_Sample_File.csv') }}"><b>Download</b></a>
</label>
</div>
<div class="form-group">
<label>Please remove sample data before proceed<span class="text-danger">*</span></label>
</div>
<form method="POST" action="{{ asset('/AReturn_POD_ReportAdd') }}" enctype="multipart/form-data">
	<div class="form-group">
	<div id="error_msg" style="color:red;"></div>
	<label class="custom-file-container__custom-file">
	<!-- <input type="file"  class="custom-file-container__custom-file__custom-file-input" accept="image/*"> -->
    
	<input type="file" id="csvFile" name="bulkorders" class="form-control"  accept=".csv" onchange="checkFileContent()" required />
	<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
	
	</label>
	</div>
	<div class="submit-section">
	@csrf
	<button class="btn btn-primary submit-btn" id="btnSubmit" disabled >Upload</button>
	 </div>
</form>
<!-- </form> -->




</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-stripped table-hover datatable">
<thead class="thead-light">
<tr>
	<th>Sr no</th>
	<th>NDR Date</th>
	<th>Report</th>
	<th>Download</th>
</tr>
</thead>
</tbody>
    @php($i=1)
    @php($j=1)
    @foreach($days0 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate0 }} {{ $days->uploadtime }}</th>
    		<th>RTO Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_ExportN') }}/{{ $tdate0 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days1 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate1 }} {{ $days->uploadtime }}</th>
    		<th>RTO Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_ExportN') }}/{{ $tdate1 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days2 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate2 }} {{ $days->uploadtime }}</th>
    		<th>RTO Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_ExportN') }}/{{ $tdate2 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days3 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate3 }} {{ $days->uploadtime }}</th>
    		<th>RTO Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_ExportN') }}/{{ $tdate3 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days4 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate4 }} {{ $days->uploadtime }}</th>
    		<th>RTO Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_ExportN') }}/{{ $tdate4 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>




<script>
function isValidDate(date) {
    var temp = date.split('-');
    var d = new Date(temp[2] + '-' + temp[1] + '-' + temp[0]);
     return (d && (d.getMonth() + 1) == temp[1] && d.getDate() == Number(temp[0]) && d.getFullYear() == Number(temp[2]));
}
function checkFileContent(){
    const csvFile = document.getElementById("csvFile");
    const input = csvFile.files[0];
    const reader = new FileReader();
    $("#btnSubmit").prop('disabled', true);
    
    $('#error_msg').hide();
    $('#error_msg').html('');
    
    reader.onload = function (e) {
        const text = e.target.result;
        
        console.log(text);
        const data = csvToArray(text);
        var totallen = data.length-1;

        
        var Awb_No;
        var Order_No;
        var Item_Name;
        var PickUp_Date;
        var Order_Status;
        var Courier_Remark;
        var Last_Status_date;
        var Delivery_Date;
        var FirstScanDate;
        var FirstAttemptDate;
        var EDD;
        var Origin_City;
        var Origin_pincode;
        var Destination_City;
        var Destination_Pincode;
        var Client_Name;
        var Customer_Contact;
        var Customer_Name;
        var Payment_Mode;
        var COD_Amount;
        var Order_Ageing;
        var AttemptCount;
        var CourierName;
        var RTO_Date;
        var RTOReason;
        var ZoneName;

        var message='';
        var cnt=0;
        var crtno=2;
        
        var checkString='Awb_No*,Order_No*,Item_Name*,PickUp_Date*,Order_Status*,Courier_Remark,Last_Status_date*,Delivery_Date,FirstScanDate*,FirstAttemptDate,EDD*,Origin_City*,Origin_pincode*,Destination_City*,Destination_Pincode*,Client_Name*,Customer_Contact*,Customer_Name*,Payment_Mode*,COD_Amount,Order_Ageing*,AttemptCount,CourierName*,RTO_Date,RTOReason,ZoneName*';
        if (text.indexOf(checkString) == 0 ) {
            for(var i=0; i< totallen; i++ ){

                 Awb_No = data[i]['Awb_No*'].trim();
                 Order_No = data[i]['Order_No*'].trim();
                 Item_Name = data[i]['Item_Name*'].trim();
                 PickUp_Date = data[i]['PickUp_Date*'].trim();
                 
                 Order_Status = data[i]['Order_Status*'].trim();
                 Courier_Remark = data[i]['Courier_Remark'].trim();
                 Last_Status_date = data[i]['Last_Status_date*'].trim();
                    
                 Delivery_Date = data[i]['Delivery_Date'].trim();
                 FirstScanDate = data[i]['FirstScanDate*'].trim();
                 FirstAttemptDate = data[i]['FirstAttemptDate'].trim();
                 EDD = data[i]['EDD*'].trim();
                 Origin_City = data[i]['Origin_City*'].trim();
                 Origin_pincode = data[i]['Origin_pincode*'].trim();
                 Destination_City = data[i]['Destination_City*'].trim();
                 Destination_Pincode = data[i]['Destination_Pincode*'].trim();
                 Client_Name = data[i]['Client_Name*'].trim();
                 Customer_Contact = data[i]['Customer_Contact*'].trim();
                 Customer_Name = data[i]['Customer_Name*'].trim();
                 Payment_Mode = data[i]['Payment_Mode*'].trim();
                 COD_Amount = data[i]['COD_Amount'].trim();
                 Order_Ageing = data[i]['Order_Ageing*'].trim();
                 AttemptCount = data[i]['AttemptCount'].trim();
                 CourierName = data[i]['CourierName*'].trim();
                 RTO_Date = data[i]['RTO_Date'].trim();
                 RTOReason = data[i]['RTOReason'].trim();
                 ZoneName = data[i]['ZoneName*\r'].replace("\r", "").trim();
        
                if(Awb_No=='' || Awb_No=='0'){
                    message='Line no '+crtno+', AWB can not be blank....!';
                    break;  
                }
                if(Order_No=='' || Order_No=='0'){
                    message='Line no '+crtno+', Order no can not be blank....!';
                    break;  
                }
                if(Item_Name=='' || Item_Name=='0'){
                    message='Line no '+crtno+', Item name can not be blank....!';
                    break;  
                }
                if(PickUp_Date==''){
                    message='Line no '+crtno+', Pickup date can not be blank....!';
                    break;  
                }
                if(!isValidDate(PickUp_Date)){
                    message='Line no '+crtno+', Pickup date is not valid....!';
                    break;  
                }
                
                if(Order_Status==''){
                    message='Line no '+crtno+', Order status can not be blank....!';
                    break;  
                }
                if(Last_Status_date==''){
                    message='Line no '+crtno+', Last status date can not be blank....!';
                    break;  
                }
                if(!isValidDate(Last_Status_date)){
                    message='Line no '+crtno+', Last status date is not valid....!';
                    break;  
                }
                
                if(Delivery_Date !=''){
                    if(!isValidDate(Delivery_Date)){
                        message='Line no '+crtno+', Delivery date is not valid....!';
                        break;  
                    }
                }
                if(FirstScanDate==''){
                    message='Line no '+crtno+', First scan date can not be blank....!';
                    break;  
                }
                if(!isValidDate(FirstScanDate)){
                    message='Line no '+crtno+', First scan date is not valid....!';
                    break;  
                }
                if(FirstAttemptDate !=''){
                    if(!isValidDate(FirstAttemptDate)){
                        message='Line no '+crtno+', First attempt date is not valid....!';
                        break;  
                    }
                }
                if(EDD==''){
                    message='Line no '+crtno+', First scan date can not be blank....!';
                    break;  
                }
                if(!isValidDate(EDD)){
                    message='Line no '+crtno+', EDD date is not valid....!';
                    break;  
                }
                
                if(Origin_City=='' || Origin_City=='0'){
                    message='Line no '+crtno+', Origin City can not be blank....!';
                    break;  
                }
                
                if(Origin_pincode=='' || Origin_pincode=='0'){
                    message='Line no '+crtno+' Origin Pincode can not be blank....!';
                    break;  
                }
                if(!/^[0-9]+$/.test(Origin_pincode)){
                    message='Line no '+crtno+', Origin Pincode allow only numeric characters....!';
                    break; 
                }
                
                if(Destination_City=='' || Destination_City=='0'){
                    message='Line no '+crtno+', Destination city can not be blank....!';
                    break;  
                }
                if(Destination_Pincode=='' || Destination_Pincode=='0'){
                    message='Line no '+crtno+' Destination Pincode can not be blank....!';
                    break;  
                }
                if(!/^[0-9]+$/.test(Destination_Pincode)){
                    message='Line no '+crtno+', Destination Pincode allow only numeric characters....!';
                    break; 
                }
                if(Client_Name=='' || Client_Name=='0'){
                    message='Line no '+crtno+', Client name can not be blank....!';
                    break;  
                }
                if(Customer_Contact=='' || Customer_Contact=='0'){
                    message='Line no '+crtno+', Customer contact can not be blank....!';
                    break;  
                }
                if(!/^[0-9]+$/.test(Customer_Contact)){
                    message='Line no '+crtno+', Custome contact allow only numeric characters....!';
                    break; 
                }
                if(Customer_Name=='' || Customer_Name=='0'){
                    message='Line no '+crtno+' Customer name can not be blank....!';
                    break;  
                }
                if(Payment_Mode=='' || Payment_Mode=='0'){
                    message='Line no '+crtno+', Payment mode can not be blank....!';
                    break;  
                }
                if(Payment_Mode !='COD' && Payment_Mode !='PP'){              
                    message='Line no '+crtno+', Payment mode must be either COD or PP ....!';
                    break;  
                }
                if(COD_Amount==''){
                    message='Line no '+crtno+', COD amount can not be blank....!';
                    break;  
                }
                if(Order_Ageing=='' || Order_Ageing=='0'){
                    message='Line no '+crtno+', Order ageing can not be blank....!';
                    break;  
                }
                if(CourierName=='' || CourierName=='0'){
                    message='Line no '+crtno+', Courier name can not be blank....!';
                    break;  
                }
                if(RTO_Date !=''){
                    if(!isValidDate(RTO_Date)){
                        message='Line no '+crtno+', RTO date is not valid....!';
                        break;  
                    }
                }
                
                if(ZoneName=='' || ZoneName=='0'){
                    message='Line no '+crtno+', Zone name can not be blank....!';
                    break;  
                }
    
                cnt++;
                crtno++;
            }
        } else {
            message='Please download the sample file and use that formated file........!';
        }
        
        
        
        
        if(message==''){
            if(cnt ==totallen){
               $("#btnSubmit").prop('disabled', false); 
            }     
        } else {
            $('#error_msg').show();
            $('#error_msg').html(message);
            
            document.getElementById("csvFile").value = "";
            $("#btnSubmit").prop('disabled', true); 
        }
        
        
    }
    
    reader.readAsText(input);
    
}


function csvToArray(str, delimiter = ",") {

const headers = str.slice(0, str.indexOf("\n")).split(delimiter);

const rows = str.slice(str.indexOf("\n") + 1).split("\n");
const arr = rows.map(function (row) {
  const values = row.split(delimiter);
  const el = headers.reduce(function (object, header, index) {
    object[header] = values[index];
    return object;
  }, {});
  return el;
});
return arr;
}

</script>



@endsection

