<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailVerif;
use App\User;
use Carbon\Carbon;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guest=User::all();
        return response()->json($guest,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guest = new User;
        $guest->name = $request->name;
        $guest->email = $request->email;
        $guest->username = $request->username;
        $guest->password = Hash::make($request->password);
        $guest->no_hp = $request->no_hp;
        $guest->email_token = str_random(10);

        $success = $guest->save();

        if(!$success){
            return response()->json('Error Saving',500);
        }else{
            Mail::to($guest->email)->send(new EmailVerif($request->email));
            return response()->json('Successed Saving the Data!', 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guest=User::where('username',$id)->get();

        if(is_null($guest)){
            return response()->json('Not Found', 404);
        }else{
            return response()->json($guest,200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $guest=User::where('username',$username)->first();

        if(!is_null($request->name)){
            $guest->name = $request->name;
        }if(!is_null($request->no_hp)){
            $guest->no_hp = $request->no_hp;
        }if(!is_null($request->password)){
            $guest->password = Hash::make($request->password);
        }

        $success = $guest->save();

        if(!$success){
            return response()->json('Error Updating',500);
        }else{
            return response()->json('Data Updated Successfully',200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $guest=User::where('username',$username)->get()->each;

        if(is_null($guest)){
            return response()->json('Not Found',404);
        }

        $success = $guest->delete();

        if(!$success){
            return response()->json('Error Deleting',500);
        }else{
            return response()->json('Delete Successed',200);
        }
    }

    public function verif($email_token)
    {
        $guest = User::where('email_token', $email_token)->where('email_verified_at', null)->first();
        if($guest->count()>0){
            $guest->email_verified_at = Carbon::now();
            $success = $guest->save();
            if($success)
                $message = "You are verified, enjoy our App... :)";
            else
                $message = "Verification failed...";
        }
    }

    public function login(Request $request){
        $guest = User::where('username', $request->username)->first();
        if($guest){
            if(Hash::check($request->password, $guest->password))
            {
                if($guest->email_verified_at==null)
                    return response()->json('Account has not been verified');
                else    
                    return response()->json('OK', 200);

            }else{
                return response()->response()->json('repeat', 202);
            }
        }else{
            return response()->json('repeat', 202);
        }
    }
}
