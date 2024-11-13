<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<form method="GET" action="">
    <label for="from">From:</label>
    <input type="date" id="from" name="from" value="{{ request()->has('from') ? request()->get('from') : '' }}">
    <label for="to">To:</label>
    <input type="date" id="to" name="to" value="{{ request()->has('to') ? request()->get('to') : '' }}">

    <button type="submit">Filter</button>
</form>

<div class="charts-wrap" style="display: flex;">
    <div class="canvas-wrap" style="height: 373px; width: 746px; padding-bottom: 100px; display: flex; flex-wrap: wrap">
        @foreach ($data as $key => $collection)
            <canvas id="{{ $key }}_chart" width="400" height="400"></canvas>
    
            <script>
                $(function() {
                    var ctx = document.getElementById("{{ $key }}_chart").getContext('2d');
    
                    var {{ $key }}_chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: @json($collection->keys()),
                            datasets: [{
                                label: 'Total Orders by {{ $key }}',
                                data: @json($collection->values()),
                                backgroundColor: ['#3c8dbc', '#f39c12', '#00c0ef'],
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });
            </script>
        @endforeach
    </div>
    
    <div class="canvas-wrap" style="height: 373px; width: 746px; padding-bottom: 100px; display: flex; flex-wrap: wrap">
        @foreach ($dataBySum as $key => $collection)
            <canvas id="{{ $key }}_chart_sum" width="400" height="400"></canvas>
    
            <script>
                $(function() {
                    var ctx = document.getElementById("{{ $key }}_chart_sum").getContext('2d');
    
                    var {{ $key }}_chart_sum = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: @json($collection->keys()),
                            datasets: [{
                                label: 'Total Sum by {{ $key }}',
                                data: @json($collection->values()),
                                backgroundColor: ['#3c8dbc', '#f39c12', '#00c0ef'],
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });
            </script>
        @endforeach
    </div>
</div>

