<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index()
    {
        return view('sessions.index');
    }

    public function create()
    {
        $coaches = Coach::all();
        return view('sessions.create',[
            'coaches' => $coaches,
        ]);
    }

    public function store(StoreSessionRequest $request)
    {
        Session::create($request->all());
        return redirect()->route('sessions.index');
    }

    public function edit(Session $session)
    {
        $hasUsers=Attendence::where('session_id',$session->id)->get();
        if($hasUsers){
           return redirect()->route('sessions.error');
        } 
        $coaches = Coach::all();
        return view('sessions.edit', [
            'session' => $session,
            'coaches' => $coaches,
            ]);
    }

    public function update(UpdateSessionRequest $request,Session $session)
        {
            $session->update($request->all());
            return redirect()->route('sessions.index');
            

        }
        public function show(Session $session)
        {
            $coaches = Coach::all();
            return view('sessions.show',[
                'session' => $session,
                'coaches' => $coaches,
            ]);
        }
    

    public function destroy(Session $session)
    {
       $hasUsers=Attendence::where('session_id',$session->id)->get();
       if($hasUsers){
           return redirect()->route('sessions.error');
       } 
       $affectedRows = Session::where('id',$session->id)->delete();
       return redirect()->route('sessions.index');
    }    

}
