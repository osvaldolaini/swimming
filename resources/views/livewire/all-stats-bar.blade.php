<div>
<div class="card-body rounded-md shadow-md sm:col-span-2 col-span-1 bg-white mx-auto">
    <h2 class="card-title w-full justify-center">
        {{ $titles }}
    </h2>
        <div class="w-full p-2 mx-3 bg-white"
         x-data='{labels: @json(array_values($labels)),total: @json(array_values($data))}'
            x-init="
                    new Chart($refs.myChart, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [{
                                label: '(Segundos)',
                                data: total,
                                borderWidth: 1,
                                {{-- borderColor: 'rgb(201, 203, 207)',
                                backgroundColor: 'rgba(201, 203, 207, 0.9)', --}}
                                tension: 0.1,
                                axis: 'y',
                            }]
                        },
                        options: {
                            animations: {
                            tension: {
                                duration: 3000,
                                easing: 'easeOutCubic',
                                from: 1,
                                to: 0,
                                loop: true
                            }
                            },

                        }
                    });
            ">
                <div >
                    <canvas id="myChart" x-ref="myChart"></canvas>
                </div>
    </div>
</div>

</div>
