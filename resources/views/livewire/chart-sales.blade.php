<div class="h-[100%] w-100 d-flex space-y-2">
    <div class="flex justify-between items-center mb-2 border-b">
        <x-table-title class="text-sm">{{$tableTitle}}</x-table-title>
        <div class="p-2 bg-white items-center mb-2 text-sm">
            <div>
                <select wire:model='year' wire:change="selectOptions($event.target.value)" class="focus:outline-none" name="" id="">
                    <option value="">Select Here</option>  
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
        <canvas wire:ignore id="myChart"></canvas>
    </div>

    <div class="flex justify-end">
        <x-button class="text-sm" wire:click="printSales()">
            Print
        </x-button>
    </div>
</div>

@script
<script>
    const chart = new Chart(
        document.getElementById('myChart'), {
            type: 'pie',
            data: {
                labels: @json($saleChartLabel),
                datasets: [{
                    data: @json($saleChartData),  // Dummy data for the pie chart
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1','#FF35A1','#FF53A1','#FF23A1'],  // Colors for the pie segments
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        }
    );

    Livewire.on('updateChart', (event) => {
        console.log(event);
        
        chart.data.datasets[0].data = event[0].datasets;
        chart.data.labels = event[0].labels;
        chart.update();
    });
</script>
@endscript
