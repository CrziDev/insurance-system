<div class="h-[100%] w-100 d-flex space-y-2">
    <div class="flex justify-between items-center mb-2 border-b">
        <x-table-title class="text-sm">{{$tableTitle}}</x-table-title>
        <div class="p-2 bg-white items-center mb-2 text-sm">
            <div class="flex space-x-2">
                <select wire:model='startYear' wire:change="selectOptionsYearly($event.target.value)" class="focus:outline-none">
                    <option value="">Select Start Year</option>  
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>

                <select wire:model='endYear' wire:change="selectOptionsYearly($event.target.value)" class="focus:outline-none">
                    <option value="">Select End Year</option>  
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </div>
        </div>
    </div>

    <div class="h-[84%]">
        <canvas wire:ignore id="myChartYearly"></canvas>
    </div>

    <div class="flex justify-end">
       
    </div>
</div>

@script 
<script>
    let chart = new Chart(
        document.getElementById('myChartYearly'), {
            type: 'bar',
            data: {
                labels: @json($yearSet), // This will be updated to show years
                datasets: @json($dataYearly)
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Sales / Income (Peros)",
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

    Livewire.on('updateChartYearly', (event) => {
        chart.data.datasets = event[0].datasets;
        chart.data.labels = event[0].labels; // Update labels to show years
        chart.update();
    });

</script>
@endscript
