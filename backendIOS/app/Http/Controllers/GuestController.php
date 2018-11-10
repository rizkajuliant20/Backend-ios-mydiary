<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guest=Guest::all();
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
        $guest = new Guest;
        $guest->name = $request->name;
        $guest->email = $request->email;
        $guest->username = $request->username;
        $guest->password = $request->password;
        $guest->no_hp = $request->no_hp;

        $success = $guest->save();

        if(!$success){
            return response()->json('Error Saving',500);
        }else{
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
        $guest=Guest::where('username',$id)->get();

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
    public function update(Request $request, $id)
    {
        $guest=Guest::where('username',$id)->first();

        if(!is_null($request->username)){
            $guest->username = $request->username;
        }if(!is_null($request->name)){
            $guest->name = $request->name;
        }if(!is_null($request->email)){
            $guest->email = $request->email;
        }if(!is_null($request->no_hp)){
            $guest->no_hp = $request->no_hp;
        }if(!is_null($request->password)){
            $guest->password = $request->password;
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
    public function destroy($id)
    {
        $guest=Guest::where('username',$id)->get()->each;

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
}
