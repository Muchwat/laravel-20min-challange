<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

use App\Models\TodoList;

class TodoListTest extends TestCase
{
    /**
     * Summary of test_save_todo
     * @return void
     */
    public function test_save_todo(): void
    {
        $mock =  [
            'title' => fake()->realText(32),
            'description' => fake()->paragraph(1),
            'note' => fake()->paragraph(1),
        ];

        $response = $this->post('/api/save/todo', $mock);
        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'success' => true,
            'status' => 'success',
            'message' => 'saved successfully!',
        ]);
    }


    public function test_show_todos(): void
    {
        $response = $this->get('/api/show/todos');
        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'success' => true,
            'status' => 'success',
            'message' => 'todos shown successfully!',
        ]);
    }

    public function test_update_todo(): void
    {
        $todo = TodoList::factory()->create();

        $mock =  [
            'title' => fake()->realText(32),
            'description' => fake()->paragraph(1),
            'note' => fake()->paragraph(1),
        ];

        $response = $this->put("/api/update/todo/{$todo->id}", $mock);
        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'success' => true,
            'status' => 'success',
            'message' => 'updated successfully!',
        ]);
    }

    public function test_delete_todo(): void
    {
        $todo = TodoList::factory()->create();
        $response = $this->delete("/api/delete/todo/{$todo->id}");
        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'success' => true,
            'status' => 'success',
            'message' => 'deleted successfully!',
        ]);
    }
}
