<div class="card">
    <div class="card-header">
        <h4>{{ $title }}</h4>
    </div>
    <div class="card-body">
        <canvas id="visitors-chart" class="col-6"></canvas>
    </div>
</div>

<script>
    var visitorsChart = new Chart($('#visitors-chart'), {
        data: {
            labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
            datasets: [{
                label:'入库订单',
                type: 'line',
                data: [100, 120, 170, 167, 180, 177, 160],
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
            },
                {
                    label:'出库订单',
                    type: 'line',
                    data: [60, 80, 70, 67, 80, 77, 100],
                    backgroundColor: 'tansparent',
                    borderColor: '#ced4da',
                    pointBorderColor: '#ced4da',
                    pointBackgroundColor: '#ced4da',
                    fill: false
                }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{}],
                xAxes: [{}]
            }
        }
    });
</script>

<style>
    #visitors-chart {
        height: 200px;
    }
</style>