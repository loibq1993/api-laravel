<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Services\UserService;

class PassportController extends Controller
{

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        // $this->middleware('auth:api');
    }

    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $data = $request->only([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $this->userService->create($data);
        $token = $user->createToken('TutsForWeb')->accessToken;

        return response()->json([
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $token->expires_at = Carbon::now()->addWeeks(1)
            )->toDateTimeString(),
            'status' => 200
        ]);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUser $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $getUserByEmail = $this->userService->findWhere($request->password, true)->get();
        $getUserByPassword = $this->userService->findWhere(['password' => Hash::make($request->password)], true)->get();
        if (auth()->attempt($credentials)) {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'status' => 200
            ]);
        } else {
            if (!$getUserByEmail) {
                return response()->json(
                    ['error' => ['email' => 'Email không chính xác']],
                    401
                );
            }
            if (!$getUserByPassword) {
                return response()->json(
                    ['error' => ['password' => "Password không chính xác"]],
                    401
                );
            }
        }
    }

    /**
     * Handles Logout
     *
     */
    public function logout(Request $request)
    {
        $request
            ->user()
            ->token()
            ->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
