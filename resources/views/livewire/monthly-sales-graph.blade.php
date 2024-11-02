<div>
<canvas id="combined-chart" class="rounded-md"></canvas>
</div>



<script>
    
var salesAndIncomeChart = document
    .getElementById("combined-chart")
    .getContext("2d");

// Example sales data for policies per month throughout the year
var motorcyclePolicyData = <?php echo json_encode($motorcyclePolicyData); ?>;
var privateCarPolicyData = <?php echo json_encode($privateCarPolicyData); ?>;
var commercialVehiclePolicyData = <?php echo json_encode($commercialVehiclePolicyData); ?>;
var landTransportationOperatorsPolicyData = <?php echo json_encode($landTransportationOperatorsPolicyData); ?>;


console.log(commercialVehiclePolicyData);

// Calculate the income per month as the sum of all policy sales
var incomeData = motorcyclePolicyData.map(
    (value, index) =>
        value +
        privateCarPolicyData[index] +
        commercialVehiclePolicyData[index] +
        landTransportationOperatorsPolicyData[index]
);

var combinedConfig = {
    type: "bar",
    data: {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ],
        datasets: [
            {
                type: "bar",
                label: "Motorcycle Policy",
                data: motorcyclePolicyData,
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1,
                stack: "combined",
            },
            {
                type: "bar",
                label: "Private Car Policy",
                data: privateCarPolicyData,
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
                stack: "combined",
            },
            {
                type: "bar",
                label: "Commercial Vehicle Policy",
                data: commercialVehiclePolicyData,
                backgroundColor: "rgba(255, 206, 86, 0.2)",
                borderColor: "rgba(255, 206, 86, 1)",
                borderWidth: 1,
                stack: "combined",
            },
            {
                type: "bar",
                label: "Land Transportation Operators Policy",
                data: landTransportationOperatorsPolicyData,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1,
                stack: "combined",
            },
            {
                type: "line",
                label: "Income per Month",
                data: incomeData,
                borderColor: "rgba(75, 192, 192, 1)",
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                tension: 0.5,
                borderWidth: 2,
                pointBackgroundColor: "rgba(75, 192, 192, 1)",
                pointRadius: 4,
                yAxisID: "y1",
            },
        ],
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
            y1: {
                beginAtZero: true,
                position: "right",
                title: {
                    display: true,
                    text: "Income (Peros)",
                },
                grid: {
                    drawOnChartArea: false,
                },
            },
            x: {
                title: {
                    display: true,
                    text: "Months",
                },
                stacked: true,
            },
        },
    },
};

var combinedChart = new Chart(salesAndIncomeChart, combinedConfig);
</script>