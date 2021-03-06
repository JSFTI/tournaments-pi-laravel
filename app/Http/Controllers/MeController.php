<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeProfilePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group Misc
 */
class MeController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:api');   
    }
    /**
     * Get Current User
     * 
     * Get current authenticated user.
     * 
     * @responseField id int Current authenticated user ID.
     * @responseField name string Current authenticated user username.
     * @responseField email string Current authenticated user email.
     * 
     * @authenticated
     * @response 200 scenario="Success" {"id": 1, "name": "username", "email": "name@example.com"}
     * @response 401 scenario="Unauthorized" {"message": "Unauthenticated"}
     */
    public function index(){
        $user = auth()->user();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    /**
     * Edit Current User
     * 
     * Edit current authenticated user.
     * 
     * @responseField token string Return a new JWT token.
     * 
     * @authenticated
     * @response 200 scenario="Success" {"id": "JWT Token"}
     * @response 401 scenario="Unauthorized" {"message": "Unauthenticated"}
     * @responseFile 422 scenario="Unprocessable Entity" ./responses/auth/editme.error.json
     */
    public function edit(EditProfileRequest $request){
        $user = User::find(auth()->user()->id);
        $user->name = $request->username;
        $user->email = $request->email;
        $user->save();

        $token = auth()->login($user);

        return response()->json(['token' => $token]);
    }

    /**
     * Edit Current Password
     * 
     * Change current authenticated user's password.
     * 
     * @responseField message string Status message.
     * 
     * @authenticated
     * @response 200 scenario="Success" {"message": "Password changed"}
     * @response 401 scenario="Unauthorized" {"message": "Unauthenticated"}
     * @responseFile 422 scenario="Unprocessable Entity" ./responses/auth/editpassword.error.json
     */
    public function editPassword(ChangeProfilePasswordRequest $request){
        $user = User::find(auth()->user()->id);
        $user->password = password_hash($request->password, PASSWORD_ARGON2ID);
        $user->save();

        return response()->json(['message' => 'Password changed']);
    }
}
