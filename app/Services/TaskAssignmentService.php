<?php
namespace App\Services;

use App\Models\Task;

class TaskAssignmentService
{
    protected $developers = [
        ['name' => 'DEV1', 'capacity' => 1, 'max_hours' => 45],
        ['name' => 'DEV2', 'capacity' => 2, 'max_hours' => 45],
        ['name' => 'DEV3', 'capacity' => 3, 'max_hours' => 45],
        ['name' => 'DEV4', 'capacity' => 4, 'max_hours' => 45],
        ['name' => 'DEV5', 'capacity' => 5, 'max_hours' => 45],
    ];

    public function assignTasks()
    {
        $tasks = Task::all();
        $tasks = $tasks->sortByDesc(function($task) {
            return $task->time * $task->level;
        });


        $developerWorkload = [];
        foreach ($this->developers as $developer) {
            $developerWorkload[$developer['name']] = [
                'hours_worked' => 0,
                'tasks' => []
            ];
        }

        foreach ($this->developers as $developer) {
            $task = $tasks->shift();
            if ($task) {
                $required_hours = $task->time / $developer['capacity'];
                $developerWorkload[$developer['name']]['hours_worked'] += $required_hours;
                $developerWorkload[$developer['name']]['tasks'][] = $task->title;
            }
        }

        foreach ($tasks as $task) {
            usort($this->developers, function ($a, $b) use ($developerWorkload) {
                return $developerWorkload[$a['name']]['hours_worked'] <=> $developerWorkload[$b['name']]['hours_worked'];
            });

            foreach ($this->developers as $developer) {
                if ($developer['capacity'] >= $task->level) {
                    $required_hours = $task->time / $developer['capacity'];
                    if (($developerWorkload[$developer['name']]['hours_worked'] + $required_hours) <= $developer['max_hours']) {
                        $developerWorkload[$developer['name']]['hours_worked'] += $required_hours;
                        $developerWorkload[$developer['name']]['tasks'][] = $task->title;
                        break;
                    }
                }
            }
        }

        return $developerWorkload;
    }

    public function calculateTotalWeeks($developerWorkload)
    {
        $total_hours = 0;
        foreach ($developerWorkload as $workload) {
            $total_hours += $workload['hours_worked'];
        }

        $total_weeks = ceil($total_hours / (45 * count($this->developers)));

        return $total_weeks;
    }
}
