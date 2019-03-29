<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\CustomerSession;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Session;
use App\Sale;
use App\VerifyCustomer;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','create','verifyUser']]);  
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

///////////////////////////////////////////////
protected function create(StoreCustomerRequest $request)
{
    Storage::put("app/public/images",$request->file('image'));
    $user = Customer::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'date_of_birth'=>$request->date_of_birth,
        'image'=> $request->image,
        'password' => bcrypt($request['password']),
    ]);

    $verifyUser = VerifyCustomer::create([
        'customer_id' => $user->id,
        'token' => str_random(40)
    ]);

    Mail::to($user->email)->send(new VerifyMail($user));

    return $user;
}

public function verifyUser($token)
    { 
        $verifyUser = VerifyCustomer::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->customer;
            if(!$user->is_verified) {
                $verifyUser->customer->is_verified = 1;
                $verifyUser->customer->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            //return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
            return response()->json(['message' => "Sorry your email cannot be identified."], 401);

        }

        return response()->json(['message' => $status], 401);

        //return redirect('/login')->with('status', $status);
    }

    
    public function login()
    {
        $credentials = request(['email', 'password']);
            
        if (! $token = auth('api')->attempt($credentials)) {
        //dd(auth('api')->attempt($credentials));
            return response()->json(['error' => 'Unauthorized'], 401);
        }elseif(!Customer::find(auth('api')->user()->id)->is_verified) {
            return response()->json(['message' =>   "you must verify your email"], 401);

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
         // dd($request->file('image')->getClientOriginalExtension());
         //$user=Customer::create($request->all());
        //  Storage::put("app/public/images",$request->file('image'));
        //  $user=Customer::create(['name' => $request->name,'email'=>$request->email,
        //  'password'=>bcrypt($request->password),'date_of_birth'=>$request->date_of_birth,
        //  'image'=> $request->image]);
        $this->index();
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
      try{

          $available_session=DB::table('sales')->where('customer_id', auth('api')->user()->id)
                                             ->orderBy('created_at', 'desc')->first()
                                             ->available_sessions;
        }catch(\ErrorException $e){
         return response()->json(['message' => 'you dont  buy package to have session']);

        }
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

