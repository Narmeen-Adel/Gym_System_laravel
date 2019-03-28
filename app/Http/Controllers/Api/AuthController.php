<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\CustomerSession;
//////////////////
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Session;
use App\Sale;

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
            
        if (! $token = auth('api')->attempt($credentials)) {
        //dd(auth('api')->attempt($credentials));
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
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function register(StoreCustomerRequest $request)
    {    
      
         //$user=Customer::create($request->all());
         $user=Customer::create(['name' => $request->name,'email'=>$request->email,
         'password'=>bcrypt($request->password),'date_of_birth'=>$request->date_of_birth]);

         $token = auth('api')->login($user);
         return $this->respondWithToken($token);
//////////////////////////////////////////////////////




    }
    public function update(UpdateCustomerRequest $request)
    { 
        Customer::find(auth('api')->user()->id)->update(['name' => $request->name,'email'=>$request->email,
        'password'=>bcrypt($request->password),'date_of_birth'=>$request->date_of_birth]);
         return response()->json(['message'=>"your updated successfully"]);

    }

    public function store(StoreAttendanceRequest $request)
    {
      $available_session=DB::table('sales')->where('customer_id', auth('api')->user()->id)->orderBy('created_at', 'desc')->first();
      ////////////////////////to validate available session
      if($available_session!=[]){
        $available_session=$available_session->available_sessions;
            if($available_session > 0)
            {
                $result= true;
            }
            else
            {
                
              return response()->json(['message' => 'you dont have sessions']);
            }
       }
       else
       {
        return response()->json(['message' => 'you dont have sessions']);
       }

       //////////////////////////////// to validate dateof session
       $session_date=Session::find($request->session_id)->day;
       if( $session_date != (Carbon::now())->format('Y-m-d'))
       {
        return response()->json(['message' => ' not available  to attend that session today ..']);
       }
       $query=CustomerSession::where([
                'customer_id'  =>   auth('api')->user()->id, 
                'session_id'   =>   $request->session_id,])->get();
                if($query->toArray()!= []){
                  return response()->json(['message' => ' you have already registered toattend this session ..']);
                }
/////////////////// insert data 
       DB::table('customer_session')->insert(
        [
            'customer_id'     =>   auth('api')->user()->id, 
           'session_id'   =>    $request->session_id,
          'attendance_date' =>  Carbon::now()
        ]
           ); 
           //////////
        Sale::where('customer_id',auth('api')->user()->id)
              ->orderBy('created_at', 'desc')->first()
              ->decrement('available_sessions',1);
            
        return response()->json([
        'message' => 'you are register to that  session ', ],201);

    }

    public function getSession(Request $request){
      
        $available_session=DB::table('sales')->where('customer_id', auth('api')->user()->id)
                                             ->orderBy('created_at', 'desc')->first()
                                             ->available_sessions;
       
        $total_session =DB::table('packages')
                        ->select('packages.sessionsNumber')   
                        ->join('sales as sal', 'packages.id', '=', 'sal.package_id')
                        ->where('customer_id',auth('api')->user()->id)
                        ->orderBy('sal.id', 'desc')->first()->sessionsNumber;
        return response()->json([
            'total_session'     => $total_session , 
            'available_session' =>$available_session,],201);             

    }


}

