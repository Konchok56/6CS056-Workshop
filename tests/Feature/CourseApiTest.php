<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseApiTest extends TestCase
{
    use RefreshDatabase;

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Web Development with Laravel',
            'description' => 'Build web applications and REST APIs with Laravel',
            'duration' => 12,
            'fee' => 25000,
            'difficulty' => 'Medium',
            'is_active' => true,
        ], $overrides);
    }

    private function makeCourse(array $overrides = []): Course
    {
        return Course::create($this->validData($overrides));
    }

    public function test_index_returns_all_courses(): void
    {
        $this->makeCourse();
        $this->makeCourse(['name' => 'Python for Beginners']);

        $this->getJson('/api/courses')
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure(['data' => [['id', 'name', 'description', 'duration', 'fee', 'difficulty', 'is_active']]]);
    }

    public function test_store_creates_course_and_returns_201(): void
    {
        $this->postJson('/api/courses', $this->validData())
            ->assertCreated()
            ->assertJsonPath('data.difficulty', 'Medium')
            ->assertJsonPath('data.is_active', true);

        $this->assertDatabaseHas('courses', ['name' => 'Web Development with Laravel']);
    }

    public function test_store_with_invalid_data_returns_422(): void
    {
        $this->postJson('/api/courses', ['name' => '', 'fee' => -5, 'difficulty' => 'Expert'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'duration', 'fee', 'difficulty']);
    }

    public function test_show_returns_course(): void
    {
        $course = $this->makeCourse();

        $this->getJson("/api/courses/{$course->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $course->id);
    }

    public function test_show_missing_course_returns_404(): void
    {
        $this->getJson('/api/courses/99999')->assertNotFound();
    }

    public function test_update_changes_course(): void
    {
        $course = $this->makeCourse();

        $this->putJson("/api/courses/{$course->id}", $this->validData(['difficulty' => 'Hard', 'is_active' => false]))
            ->assertOk()
            ->assertJsonPath('data.difficulty', 'Hard')
            ->assertJsonPath('data.is_active', false);
    }

    public function test_destroy_deletes_course_and_returns_204(): void
    {
        $course = $this->makeCourse();

        $this->deleteJson("/api/courses/{$course->id}")->assertNoContent();

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
