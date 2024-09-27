<?php
namespace App\Http\Controllers;

use App\Services\TaskAssignmentService;

class TaskController extends Controller
{
    protected $taskAssignmentService;

    public function __construct(TaskAssignmentService $taskAssignmentService)
    {
        $this->taskAssignmentService = $taskAssignmentService;
    }

    public function assignTasks()
    {
        $developerWorkload = $this->taskAssignmentService->assignTasks();

        $totalWeeks = $this->taskAssignmentService->calculateTotalWeeks($developerWorkload);

        return view('task_assignment', [
            'developerWorkload' => $developerWorkload,
            'totalWeeks' => $totalWeeks
        ]);
    }
}
