<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    use RefreshDatabase;

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Santosh Gurung',
            'email' => 'santosh@example.com',
            'phone' => '9800000000',
            'address' => 'Kathmandu',
            'date_of_birth' => '2003-05-10',
        ], $overrides);
    }

    private function makeStudent(array $overrides = []): Student
    {
        return Student::create($this->validData($overrides));
    }

    public function test_index_returns_all_students(): void
    {
        $this->makeStudent();
        $this->makeStudent(['email' => 'second@example.com']);

        $this->getJson('/api/students')
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure(['data' => [['id', 'name', 'email', 'phone', 'address', 'date_of_birth', 'age']]]);
    }

    public function test_store_creates_student_and_returns_201(): void
    {
        $this->postJson('/api/students', $this->validData())
            ->assertCreated()
            ->assertJsonPath('data.email', 'santosh@example.com')
            ->assertJsonPath('data.date_of_birth', '2003-05-10');

        $this->assertDatabaseHas('students', ['email' => 'santosh@example.com']);
    }

    public function test_store_with_invalid_data_returns_422(): void
    {
        $this->postJson('/api/students', ['name' => '', 'email' => 'not-an-email'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'phone']);
    }

    public function test_store_rejects_duplicate_email(): void
    {
        $this->makeStudent();

        $this->postJson('/api/students', $this->validData())
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_show_returns_student(): void
    {
        $student = $this->makeStudent();

        $this->getJson("/api/students/{$student->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $student->id);
    }

    public function test_show_missing_student_returns_404(): void
    {
        $this->getJson('/api/students/99999')->assertNotFound();
    }

    public function test_update_changes_student_and_keeps_own_email(): void
    {
        $student = $this->makeStudent();

        $this->putJson("/api/students/{$student->id}", $this->validData(['name' => 'Updated Name']))
            ->assertOk()
            ->assertJsonPath('data.name', 'Updated Name');

        $this->assertDatabaseHas('students', ['id' => $student->id, 'name' => 'Updated Name']);
    }

    public function test_destroy_deletes_student_and_returns_204(): void
    {
        $student = $this->makeStudent();

        $this->deleteJson("/api/students/{$student->id}")->assertNoContent();

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
