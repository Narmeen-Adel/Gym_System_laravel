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
        Session::create($request->all());
        //CoachSession::create('insert into coaches_sessions session_id,coach_id values',[$request->id,$request->coache_id]);
        return redirect()->route('sessions.index');
    }

    public function edit(Session $session)
    {
        //$hasUsers=Attendance::select('select * from attendance where session_id=:id',['id'=>$session->id]);
        //$arr=$hasUsers->pluck('id')->toArray();
        //if($arr!=[]){
          // return redirect()->route('sessions.index');
        //}
        //else{ 
                $coaches = Coach::all();
                $gyms=Gym::all();
                $packages=Package::all();
                return view('sessions.edit', [
                    'session' => $session,
                    'coaches' => $coaches,
                    'gyms' => $gyms,
                    'packages' =>$packages
                    ]);}
    //}

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
        $hasUsers=Attendance::select('select * from attendance where session_id=:id',['id'=>$session->id]);
        // dd($hasUsers);
        //$this->validate($request,
          //     [$session->id => new HasUsersSessionRule
           // ]);
    
           if(isEmpty($hasUsers))
           {
               $h=true;
           }
           dd("hhhhhhhhhhhhhhhhh",$h);
        // if($hasUsers->count())
        // $affectedRows = Session::where('id',$session->id)->delete();
        return redirect()->route('sessions.index');
       
        }

        public function get_table(){
            return datatables()->of(Session::query())->toJson();
        }
    }
