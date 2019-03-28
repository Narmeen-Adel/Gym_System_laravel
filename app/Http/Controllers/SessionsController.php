<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coach;
use App\Session;
use App\Package;
use App\Gym;
use App\Attendance;
use App\Rules\HasUsersSessionRule;
use App\Rules\OverlapValidateRule;
use App\Http\Requests\Session\StoreSessionRequest;
use App\Http\Requests\Session\UpdateSessionRequest;
use App\CoachSession;
use DB;
use App\CustomerSession;
use Illuminate\Support\MessageBag;

class SessionsController extends Controller
{
    public function index()
    {
        return view('sessions.index',[
            'sessions' => Session::all()
        ]);
    }

    public function create()
    {
        $coaches = Coach::all();
        $gyms=Gym::all();
        $packages=Package::all();
        return view('sessions.create',[
            'coaches' => $coaches,
            'gyms' => $gyms,
            'packages' =>$packages
        ]);
    }

    public function store(StoreSessionRequest $request)
    {
        $this->validate($request, ['starts_at' => new OverlapValidateRule($request->finishes_at)]);
        $coaches=$request->get('coaches');
            Session::create([
                'name' => $request->name,
                'starts_at' =>$request->starts_at,
                'finishes_at'=>$request->finishes_at,
                'gym_id'=>$request->gym_id,
                'package_id'=>$request->package_id,
                'day'=>$request->day]);
                dd($request);
            foreach($coaches as $coach){
                DB::table('coaches_sessions')->insert(['session_id'=>Session::latest()->first()->id,'coach_id'=>$coach]);
                }
           return redirect()->route('sessions.index');
    }

    public function edit(Session $session)
    {       
        $hasUsers=DB::table('customer_session')->where('session_id', $session->id)->get();
        if(count($hasUsers)>0){
            $message_bag=new MessageBag();
            $message_bag->add('Attendence_Check','Can not Update this session');
            return redirect()->route('sessions.index')->withErrors($message_bag);
        }
        else{
                $coaches = Coach::all();
                $gyms=Gym::all();
                $packages=Package::all();
                return view('sessions.edit', [
                    'session' => $session,
                    'coaches' => $coaches,
                    'gyms' => $gyms,
                    'packages' =>$packages
                    ]);}
                }

    public function update(UpdateSessionRequest $request,Session $session)
        {
            $this->validate($request,
               [$session->id => new HasUsersSessionRule
            ]);
            $this->validate($request, ['starts_at' => new OverlapValidateRule($request->finishes_at)]);
            $session->update($request->all());
            return redirect()->route('sessions.index');
        }


    public function show(Session $session)
        {
            $coaches = Coach::all();
            $gyms=Gym::all();
            $packages=Package::all();
            return view('sessions.show',[
                'session' => $session,
                'coaches' => $coaches,
                'gyms' =>$gyms,
                'packages' =>$packages
            ]);
        }
    

    public function destroy(Request $request, Session $session)
    {
        $hasUsers=DB::table('customer_session')->where('session_id', $session->id)->get();
        if(count($hasUsers)>0){
            $message_bag=new MessageBag();
            $message_bag->add('Delete_session','Can not Delete this session');
            return redirect()->route('sessions.index')->withErrors($message_bag);
        }
        else{
        $affectedRows = Session::where('id',$session->id)->delete();
        $sessionsCoaches=DB::table('coaches_sessions')->where('session_id', $session->id)->get();
            foreach($sessionsCoaches as $session){
                $session->delete();
            }
        return redirect()->route('sessions.index');
       
        }
    }

        public function get_table(){
            return datatables()->of(Session::query())->toJson();
        }
    }
