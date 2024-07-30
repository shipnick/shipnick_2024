<div class="table-responsive fs-14">
    <table class="table card-table display mb-4 dataTablesCard text-black" id="example5">
        <thead>
            <tr>
                <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                        <label class="form-check-label" for="checkAll">
                        </label>
                    </div>
                </th>
                <th>AWB #</th>
                <th>ID Order(s)</th>
                <th>Date of upload</th>
                <th>Customer details</th>
                <th>Customer address</th>
                <th>Courier</th>
                <th>Status</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @foreach($params as $param)
            <tr class="gradeX">
                <td>{{ $param->Awb_Number }}</td>
                <td>{{ $param->orderno }}</td>
                <td>{{ $param->Rec_Time_Date }}</td>

                <td>{{ $param->Name }} <br>
                    {{ $param->Mobile }}
                </td>
                <td>{{ $param->Address }}</td>
                <td>{{ $param->awb_gen_by }}</td>


                <td>
                    @if($param->order_status_show == "Cancel")
                    {{ $param->order_status_show }}ed
                    @elseif($param->order_status_show == "Unexpected")
                    Unknown Error
                    @elseif($param->order_status_show == "Upload")
                    Not Picked
                    @else
                    {{ $param->order_status_show }}
                    @endif
                </td>

            </tr>
            @php($i++)
            @endforeach
        </tbody>
    </table>
</div>