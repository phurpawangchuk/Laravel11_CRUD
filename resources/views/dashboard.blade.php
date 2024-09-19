<x-app-layout>

    <div class="container my-5">
        <div>
            This is implemented using AWS services. The following services are used:
            RDS, CE2 and S3
        </div>
        <!-- Students Section -->
        <div class="mb-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="h5 fw-semibold">Welcome</h2>
                </div>

                <div class="container mt-4">
                    <div class="row mb-3">
                        <!-- First Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Sales Chart 1</h5>
                                    <div class="chart-container">
                                        <canvas id="salesChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Second Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Sales Chart 2</h5>
                                    <div class="chart-container">
                                        <canvas id="salesChart4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Third Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Sales Chart 3</h5>
                                    <div class="chart-container">
                                        <canvas id="salesChart3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fourth Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Sales Chart 4</h5>
                                    <div class="chart-container">
                                        <canvas id="salesChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function renderChart(chartId, chartType) {
        const ctx = document.getElementById(chartId).getContext('2d');
        const data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Monthly Sales ($)',
                data: [1200, 1500, 1000, 2200, 3000, 1800],
                backgroundColor: [
                    '#ff6384', // Jan
                    '#36a2eb', // Feb
                    '#cc65fe', // Mar
                    '#ffce56', // Apr
                    '#ff9f40', // May
                    '#4bc0c0' // Jun
                ],
                borderColor: chartType === 'line' ? 'rgba(75, 192, 192, 1)' :
                'rgba(255, 255, 255, 1)', // Line chart needs border color
                fill: chartType === 'line' ? false : true, // Do not fill the area under the line
                borderWidth: 2 // Thicker line
            }]
        };
        const chart = new Chart(ctx, {
            type: chartType,
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: chartType !== 'bar' // Display legend for non-bar charts
                    }
                }
            }
        });
    }

    // Render charts with different types and unique colors
    renderChart('salesChart1', 'bar');
    renderChart('salesChart2', 'pie');
    renderChart('salesChart3', 'doughnut');
    renderChart('salesChart4', 'line');
    </script>
</x-app-layout>