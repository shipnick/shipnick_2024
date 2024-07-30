<table class="table table-hover">
    <thead>
        <tr>
            <th>
                <div class="custom-control custom-checkbox checkbox-primary check-lg me-3">
                    <input type="checkbox" class="custom-control-input" id="checkAll" onclick="toggle(this);">
                    <label class="custom-control-label" for="checkAll"></label>
                </div>
            </th>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Courier</th>
            <th>AWB Number</th>
            <th>Order Type</th>
            <th>Product Name</th>
            <th>Download</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>
                    <div class="custom-control custom-checkbox checkbox-primary check-lg me-3">
                        <input type="checkbox" class="custom-control-input" name="selectedorder[]" value="{{ $order->id }}" id="customCheckBox2{{ $order->id }}">
                        <label class="custom-control-label" for="customCheckBox2{{ $order->id }}"></label>
                    </div>
                </td>
                <td>{{ $order->ordernoapi }}</td>
                <td>{{ \Carbon\Carbon::parse($order->date_of_upload)->format('d-m-Y') }}</td>
                <td>{{ $order->awb_gen_by }}</td>
                <td>{{ $order->Awb_Number }}</td>
                <td>{{ $order->Order_Type }}</td>
                <td>{{ $order->Item_Name }}</td>
                <td>
                    <a href="#" class="btn btn-secondary light sharp btn-sm">
                        <i class="fa fa-download"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
