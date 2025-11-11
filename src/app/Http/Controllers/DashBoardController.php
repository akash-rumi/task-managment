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

        return view('dashboard.index', compact('totalEmployees', 'totalTasks', 'completedTasks', 'pendingTasks', 'inProgressTasks'));
    }
}