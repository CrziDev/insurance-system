<div class="h-[100%] w-100 d-flex space-y-2">
    <div class="flex justify-between items-center mb-2 border-b">
        <x-table-title class="text-sm">{{$tableTitle}}</x-table-title>
    </div>

    <div class="h-[84%]">
        <canvas wire:ignore id="salesMonitoring"></canvas>
    </div>

    <div class="flex justify-end">
       
    </div>
</div>

@script 
<script>
    let chart = new Chart(
        document.getElementById('salesMonitoring'), {
            type: 'line',
            data: {
                labels: @json($saleLabel), // This will be updated to show years
                datasets: [@json($salesData)]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Status Count",
                        },
                        stacked: true,
                    },
                    x: {
                        title: {
                            display: true,
                            text: "Years",
                        },
                        stacked: true,
                    },
                },
            },
        }
    );

</script>
@endscript
