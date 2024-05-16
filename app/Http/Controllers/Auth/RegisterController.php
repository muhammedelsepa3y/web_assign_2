<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:students,user_name',
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email',
            'password' => 'required|string|min:8|confirmed',
            'user_image' => 'required|image|max:2048',
        ]);

        $user = Student::create([
            'full_name' => $request->full_name,
            'user_name' => $request->user_name,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_image' => $request->file('user_image')->store('images', 'public'),
        ]);
        $file_name = time() . '.' . request()->user_image->getClientOriginalExtension();
        request()->user_image->move(public_path('images'), $file_name);
        // Send email to the registered user
        Mail::raw("A new user {$user->user_name} is registered to the system", function ($message) use ($user) {
            $message->to("muhammedelsepa3y@gmail.com")->subject("New registered user");
        });

        // Store user data in session
        Session::put('registered_user', $user);

        return redirect()->route('success')->with('status', __('messages.registration_success'));
    }
}
