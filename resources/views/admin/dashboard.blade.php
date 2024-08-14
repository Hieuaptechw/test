@extends('admin.app')
@section('content')
<div class="admin-dashboard">
    @if(session('token'))
    <script>
        var token = "{{ session('token') }}";
        localStorage.setItem('adminToken', token);
    </script>
    @endif
    <div class="dashboard-content row">
        <div class="col-7">
            <h3>Today's Sales</h3>
            <div class="row">
                <div class="dashboard-item col-md-3">
                    <div class="dashboard-item-icon icont1">
                        <i class="bi bi-bar-chart-line-fill"></i>
                    </div>
                    <h3 class="m-0">$1k</h3>
                    <h5 class="m-0 p-0">Total Sales</h5>
                    <span>Last day +8%</span>
                </div>
                <div class="dashboard-item col-md-3">
                    <div class="dashboard-item-icon icont2">
                        <i class="bi bi-clipboard2-pulse-fill"></i>
                    </div>
                    <h3 class="m-0">300</h3>
                    <h5 class="m-0 p-0">Total Sales</h5>
                    <span>Last day +8%</span>
                </div>
                <div class="dashboard-item col-md-3">
                    <div class="dashboard-item-icon icont3">
                        <i class="bi bi-tag-fill"></i>
                    </div>
                    <h3 class="m-0">5</h3>
                    <h5 class="m-0 p-0">Total Sales</h5>
                    <span>Last day +8%</span>
                </div>
                <div class="dashboard-item col-md-3">
                    <div class="dashboard-item-icon icont4">
                        <i class="bi bi-person-add"></i>
                    </div>
                    <h3 class="m-0">8</h3>
                    <h5 class="m-0 p-0">Total Sales</h5>
                    <span>Last day +8%</span>
                </div>
            </div>
        </div>
        <div class="col-5">
            <h3>Today's Order</h3>
            <div id="piechart" style="width: 400px; height: 120px;"></div>
        </div>
    </div>
    <div class="dashboard-content row">

        <div class="col-6 product-performance">
            <h3>Top's Sales Product</h3>
            <table class="table product-performance-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>TV</td>
                        <td>1200</td>
                        <td>21</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Tu Lanh</td>
                        <td>3000</td>
                        <td>20</td>
                    </tr>
                    <tr>
                   
                        <th scope="row">3</th>
                        <td>Dieu Hoa</td>
                        <td>5000</td>
                        <td>34</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-6 dashboard-content-map">
        <div id="regions_div" style="width: 400px; height: 250px;"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', '6'],
            ['Tv', 15],
            ['Tv', 10],
            ['Water mill', 5],

        ]);

        var options = {
            title: ""
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['vietnam', 600],

        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }

</script>
@endsection