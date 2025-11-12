@extends('layouts.dashboard')

@section('header', 'Dashboard')

@section('dashboard_content')
    <div class="row mt-4 p-3 mx-0">
        <div class="col-md-6 mx-0">
            <div class="card text-center" style="background-color: #e3f2fd;">
                <div class="card-body">
                    <h5 class="card-title">Total Employees</h5>
                    <p class="card-text">{{ $totalEmployees }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center" style="background-color: #f3e5f5;">
                <div class="card-body">
                    <h5 class="card-title">Total Tasks</h5>
                    <p class="card-text">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 p-3 mx-0">
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #e8f5e9;">
                <div class="card-body">
                    <h5 class="card-title">In Progress Tasks</h5>
                    <p class="card-text">{{ $inProgressTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #fff3e0;">
                <div class="card-body">
                    <h5 class="card-title">Completed Tasks</h5>
                    <p class="card-text">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center" style="background-color: #fce4ec;">
                <div class="card-body">
                    <h5 class="card-title">Pending Tasks</h5>
                    <p class="card-text">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 p-3 mx-0">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    Task Status 
                </div>
                <div class="card-body">
                    <canvas id="taskStatusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    Tasks per Employee (by Status)
                </div>
                <div class="card-body">
                    <canvas id="tasksChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pie Chart: Task Status Distribution
        const ctxPie = document.getElementById('taskStatusChart').getContext('2d');
        const taskStatusChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Pending', 'In Progress', 'Completed'],
                datasets: [{
                    label: 'Task',
                    data: [{{ $pendingTasks }}, {{ $inProgressTasks }}, {{ $completedTasks }}],
                    backgroundColor: ['#fbbf24', '#60a5fa', '#34d399'],
                    borderColor: ['#f59e0b', '#3b82f6', '#10b981'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Total Tasks: ' +  {{$totalTasks}},
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const percentage = ((value /  {{$totalTasks}}) * 100).toFixed(1);
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });

        // Stacked Bar Chart: Tasks per Employee
        const chartData = @json($chartData);
        const ctxBar = document.getElementById('tasksChart').getContext('2d');
        const tasksChart = new Chart(ctxBar, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Number of Tasks'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Task Distribution by Employee',
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        callbacks: {
                            footer: function(tooltipItems) {
                                let total = 0;
                                tooltipItems.forEach(function(tooltipItem) {
                                    total += tooltipItem.parsed.y;
                                });
                                return 'Total: ' + total;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush