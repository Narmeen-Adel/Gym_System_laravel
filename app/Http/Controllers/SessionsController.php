<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coach;
use App\Session;
use App\Package;
use App\Gym;
use App\Rules\DeleteSessionRule;
use App\Rules\OverlapValidateRule;
use App\Http\Requests\Session\StoreSessionRequest;

class SessionsController extends Controller
{
    public function index()
    {
        return view('sessions.index');
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
        return redirect()->route('sessions.index');
    }

    public function edit(Session $session)
    {
        $hasUsers=Attendence::where('session_id',$session->id)->get();
        if($hasUsers){
           return redirect()->route('sessions.index');
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

    public function update(Request $request,Session $session)
        {
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
    

    public function destroy(Session $session)
    {
       
        $session->validate([
            $session->id => new DeleteSessionRule
        ]);
       $affectedRows = Session::where('id',$session->id)->delete();
       return redirect()->route('sessions.index');
       
    }    

}
