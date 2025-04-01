<!DOCTYPE html>
<html>
<head>
    <title>Datos del Sensor - Vista Combinada</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80%;
            margin: 30px auto;
        }
        .chart {
            margin-bottom: 50px;
            height: 400px;
        }
        .chart-title {
            text-align: center;
            margin: 20px 0;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Monitoreo de Sensor</h1>
    
    <!-- Gráfica combinada -->
    <div class="chart-container">
        <h2 class="chart-title">Temperatura y Humedad - Vista Combinada</h2>
        <div class="chart">
            <canvas id="combinedChart"></canvas>
        </div>
    </div>
    
    <!-- Gráficas separadas (originales) -->
    <div class="chart-container">
        <h2 class="chart-title">Vista Separada</h2>
        <div class="chart">
            <canvas id="temperatureChart"></canvas>
        </div>
        
        <div class="chart">
            <canvas id="humidityChart"></canvas>
        </div>
    </div>

    <script>
        const data = @json($data);
        
        // Preparar datos
        const labels = data.map(item => new Date(item.datetime).toLocaleTimeString());
        const temperatures = data.map(item => item.temperature);
        const humidities = data.map(item => item.humidity);
        
        // Configuración común para todas las gráficas
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Hora'
                    }
                },
                y: {
                    beginAtZero: false
                }
            }
        };

        // 1. Gráfica COMBINADA
        const combinedCtx = document.getElementById('combinedChart').getContext('2d');
        new Chart(combinedCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Temperatura (°C)',
                        data: temperatures,
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.1)',
                        tension: 0.1,
                        fill: false,
                        yAxisID: 'y',
                    },
                    {
                        label: 'Humedad (%)',
                        data: humidities,
                        borderColor: 'rgb(54, 162, 235)',
                        backgroundColor: 'rgba(54, 162, 235, 0.1)',
                        tension: 0.1,
                        fill: false,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                ...commonOptions,
                scales: {
                    ...commonOptions.scales,
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Temperatura (°C)'
                        },
                        min: Math.min(...temperatures) - 2,
                        max: Math.max(...temperatures) + 2
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Humedad (%)'
                        },
                        min: Math.min(...humidities) - 5,
                        max: Math.max(...humidities) + 5,
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });
        
        // 2. Gráfica de TEMPERATURA (separada)
        const tempCtx = document.getElementById('temperatureChart').getContext('2d');
        new Chart(tempCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Temperatura (°C)',
                    data: temperatures,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    ...commonOptions.scales,
                    y: {
                        title: {
                            display: true,
                            text: 'Temperatura (°C)'
                        },
                        min: Math.min(...temperatures) - 2,
                        max: Math.max(...temperatures) + 2
                    }
                }
            }
        });
        
        // 3. Gráfica de HUMEDAD (separada)
        const humidityCtx = document.getElementById('humidityChart').getContext('2d');
        new Chart(humidityCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Humedad (%)',
                    data: humidities,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    ...commonOptions.scales,
                    y: {
                        title: {
                            display: true,
                            text: 'Humedad (%)'
                        },
                        min: Math.min(...humidities) - 5,
                        max: Math.max(...humidities) + 5
                    }
                }
            }
        });
    </script>
</body>
</html>