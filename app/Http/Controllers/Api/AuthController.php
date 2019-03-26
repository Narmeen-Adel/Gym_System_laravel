<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

//////////////////
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Customer;

class AuthController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
            
        if (! $token = auth()->attempt($credentials)) {
        dd(auth()->attempt($credentials));
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function register(StoreCustomerRequest $request)
    {    
        //  dd('tesss2');
        // return response()->json(['data' => "jkjk"]);

      
        // $user= Customer::create([
        //      'email'    => $request->email,
        //      'password' => bcrypt($request->password),
        //      'name' =>$request->name,
        //  ]);
          $user=Customer::create($request->all());
        

         $token = auth()->login($user);
        // dd($token);
        return $this->respondWithToken($token);
        //return response()->json(['data' => $user]);

    }
    public function update(UpdateCustomerRequest $request)
    {    


        DB::table('customers')
            ->where('email', $request->email)
            ->update(['password' => bcrypt($request->password),
            'name' => $request->name,
            'date_of_birth '=>$request->date_of_birth,
            'gender' =>$request->gender]);
            
            return $this->response("data is updated");

        //dd("update");
        $customer->update($request->all());
        // $user= Customer::create([
        //      'email'    => $request->email,
        //      'password' => bcrypt($request->password),
        //      'name' =>$request->name,
        //  ]);
        return response()->json(auth()->user());

    }

}

