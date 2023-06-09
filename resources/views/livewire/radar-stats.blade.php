<div class="m-0">

    <div class="rounded-md shadow-md bg-white max-w-xs"
        x-data='{labels: @json(array_values($labels)),total: @json(array_values($data))}' x-init="new Chart($refs.myChart, {
            type: 'radar',
            data: {
                labels,
                datasets: [{
                    label: '',
                    data: total,
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                }]
            },

            options: {
                elements: {
                    line: {
                        borderWidth: 2
                    }
                },
                spanGaps: true,
                scales: {
                    r: {
                        min: 0,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                        }
                    },
                },
            },
        });">
        <div>
            <canvas id="myChart" x-ref="myChart"></canvas>
        </div>
    </div>
</div>
