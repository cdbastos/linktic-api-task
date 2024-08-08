<?php

namespace Tests\Feature;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function can_fetch_a_single_task(): void
    {

        $task = Task::factory()->create();

        $response = $this->getJson(route('api.tasks.show', $task));

        $response->assertExactJson([
            'data' => [
                'type' => 'tasks',
                'id' => (string)$task->getRouteKey(),
                'attributes' => [
                    'title' => $task->title,
                    'description' => $task->description,
                    'status' => $task->status,
                    'due_date' => Carbon::parse($task->due_date)->format('Y-m-d H:i'),
                ],
                'links' => [
                    'self' => route('api.tasks.show', $task),
                ]
            ]
        ]);
    }

    /** @test */
    public function can_fetch_all_task()
    {
        $tasks = Task::all();

        $response = $this->getJson(route('api.tasks.index'));

        //itera sobre las tareas y las guarda en un array
        $data = [];
        foreach ($tasks as $item) {
            $data[] = [
                'data' => [
                    'type' => 'tasks',
                    'id' => (string)$item->getRouteKey(),
                    'attributes' => [
                        'title' => $item->title,
                        'description' => $item->description,
                        'status' => $item->status,
                        'due_date' => Carbon::parse($item->due_date)->format('Y-m-d H:i'),
                    ],
                    'links' => [
                        'self' => route('api.tasks.show', $item),
                    ]
                ]
            ];
        }

        $response->assertExactJson([
            'data' => $data,
            'links' => [
                'self' => route('api.tasks.index'),
            ]
        ]);
    }

    /** @test */
    public function can_fetch_task_by_status()
    {

        $response = $this->getJson(route('api.tasks.index', 'status=doing'));
        $tasks = Task::where('status', 'doing')->get();

        //itera sobre las tareas y las guarda en un array
        $data = [];
        foreach ($tasks as $item) {
            $data[] = [
                'data' => [
                    'type' => 'tasks',
                    'id' => (string)$item->getRouteKey(),
                    'attributes' => [
                        'title' => $item->title,
                        'description' => $item->description,
                        'status' => $item->status,
                        'due_date' => Carbon::parse($item->due_date)->format('Y-m-d H:i'),
                    ],
                    'links' => [
                        'self' => route('api.tasks.show', $item),
                    ]
                ]
            ];
        }

        $response->assertExactJson([
            'data' => $data,
            'links' => [
                'self' => route('api.tasks.index'),
            ]
        ]);

    }
}
