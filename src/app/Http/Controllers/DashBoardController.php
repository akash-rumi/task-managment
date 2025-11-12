<?php 

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'Completed')->count();
        $pendingTasks = Task::where('status', 'Pending')->count();
        $inProgressTasks = Task::where('status', 'In Progress')->count();

        $employees = Employee::withCount([
            'tasks as pending_count' => function ($query) {
                $query->where('status', 'Pending');
            },
            'tasks as in_progress_count' => function ($query) {
                $query->where('status', 'In Progress');
            },
            'tasks as completed_count' => function ($query) {
                $query->where('status', 'Completed');
            }
        ])->get();

        // Prepare data for Chart.js
        $chartData = [
            'labels' => $employees->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Pending',
                    'data' => $employees->pluck('pending_count')->toArray(),
                    'backgroundColor' => '#fbbf24', // Yellow
                    'borderColor' => '#f59e0b',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'In Progress',
                    'data' => $employees->pluck('in_progress_count')->toArray(),
                    'backgroundColor' => '#60a5fa', // Blue
                    'borderColor' => '#3b82f6',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Completed',
                    'data' => $employees->pluck('completed_count')->toArray(),
                    'backgroundColor' => '#34d399', // Green
                    'borderColor' => '#10b981',
                    'borderWidth' => 1
                ]
            ]
        ];

        return view('dashboard.index', compact('totalEmployees', 'totalTasks', 'completedTasks', 'pendingTasks', 'inProgressTasks', 'employees', 'chartData'));
    }
}