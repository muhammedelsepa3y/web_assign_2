<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use Illuminate\Http\UploadedFile;

class RegisterStudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_inserts_a_new_student_and_displays_success_message()
    {        session()->start();  // Start the session manually

    
        $response = $this->post('/register', [
            '_token' => csrf_token(),  // Include CSRF token

            'full_name' => 'Test User',
            'user_name' => 'testuser',
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuserFeature@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_image' => UploadedFile::fake()->image('user_image.jpg'),
        ]);

        $response->assertRedirect('/success');
        $this->assertDatabaseHas('students', ['email' => 'testuserFeature@example.com']);
    }
}
