@extends('layout')

@section('content')

<style>
    td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

</style>
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Default Courier Rate List</h5>
                        <span class="d-block m-t-5">All Courier list </span>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Courier Name</th>
                                        <th>WITHIN CITY <br><span>(zone A)</span> </th>
                                        <th>WITHIN STATE <br><span>(zone B)</span></th>
                                        <th>REGIONAL <br><span>(zone C)</span></th>
                                        <th>METRO TO METRO <br><span>(zone D)</span></th>
                                        <th>REST OF INDIA <br><span>(zone E)</span></th>
                                        <th>NORTH EAST, J&K <br><span>(zone F)</span></th>
                                        <th>COD CHARGES</th>
                                        <th>COD %</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>1</td>
                                        <td>Xpressbees3</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>30</td>
                                        <td>2%</td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Xpressbees2</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>30</td>
                                        <td>2%</td>

                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Xpressbees</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>30</td>
                                        <td>2%</td>

                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>EcomExpress</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>30</td>
                                        <td>2%</td>

                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Bluedart</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>30</td>
                                        <td>2%</td>

                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Bluedart-sc</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>30</td>
                                        <td>2%</td>

                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>DTDC</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>70</td>
                                        <td>30</td>
                                        <td>2%</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Default Zone List</h5>
                        <span class="d-block m-t-5">Zone Details  </span>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Zone Division</th>
                                        <th>Area </th>
                                        <th>TAT (turn around time)</th>
                                        
                                    </tr>
                                </thead>
                                <tbody >
                                    
                                    <tr>
                                        <td>1</td>
                                        <td>Zone A</td>
                                        <td>Within City</td>
                                        <td>1-2 Days</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Zone B</td>
                                        <td>Within Satate</td>
                                        <td>2-3 Days</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Zone C</td>
                                        <td>With in Region</td>
                                        <td>3-4 Days</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Zone D</td>
                                        <td>Metro Cities</td>
                                        <td>4-5 Days</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Zone E</td>
                                        <td>ROI (rest of india)</td>
                                        <td>5-7 Days</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Zone F</td>
                                        <td>Special Zones(J&K, North East)</td>
                                        <td>6-9 Days</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Travel Guide Start -->

<!-- Travel Guide End -->
@endsection
