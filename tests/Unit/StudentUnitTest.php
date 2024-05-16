<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\UploadedFile;

class StudentUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_student()
    {
        $student = Student::create([
            'full_name' => 'Test User',
            'user_name' => 'testuser',
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'user_image' => 'images/1.jpeg',
        ]);

        $this->assertInstanceOf(Student::class, $student);
        $this->assertEquals('testuser', $student->user_name);
    }

    /** @test */
    public function it_requires_a_unique_email()
    {
        $student1 = Student::create([
            'full_name' => 'Test User1',
            'user_name' => 'testuser1',
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuser1@example.com',
            'password' => bcrypt('password'),
            'user_image' => 'images/user_image.jpg',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        $student2 = Student::create([
            'full_name' => 'Test User2',
            'user_name' => 'testuser2',
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuser1@example.com', // Duplicate email
            'password' => bcrypt('password'),
            'user_image' => 'images/user_image.jpg',
        ]);
    }
    /** @test */

    public function it_requires_a_unique_username()
    {
        $student1 = Student::create([
            'full_name' => 'Test User1',
            'user_name' => 'testuser1',
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuser1@example.com',
            'password' => bcrypt('password'),
            'user_image' => 'images/user_image.jpg',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        $student2 = Student::create([
            'full_name' => 'Test User2',
            'user_name' => 'testuser1', // Duplicate email
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuser3@example.com',
            'password' => bcrypt('password'),
            'user_image' => 'images/user_image.jpg',
        ]);
    }
    /** @test */
    public function it_requires_a_valid_email_format()
    {
        session()->start();  // Start the session manually

        $response = $this->post('/register', [
            '_token' => csrf_token(),  
            'full_name' => 'Test User',
            'user_name' => 'testuser',
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'invalid-email-format',
            'password' => 'password!123',
            'password_confirmation' => 'password!123',
            'user_image' => UploadedFile::fake()->image('user_image.jpg'),
        ]);

        $response->assertSessionHasErrors(['email']);


    }

    /** @test */
    public function it_requires_a_password()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        $student = Student::create([
            'full_name' => 'Test User',
            'user_name' => 'testuser',
            'birthdate' => '2000-01-01',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'email' => 'testuser@example.com',
            'password' => null, // No password
            'user_image' => 'images/user_image.jpg',
        ]);
    }
}
