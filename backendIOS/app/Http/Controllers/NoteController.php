<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note=Note::all();
        return response()->json($note,200);
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
        $note = new Note;
        $note->title = $request->title;
        $note->text = $request->text;

        $success = $note->save();

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
        $note=Note::where('title',$id)->get();

        if(is_null($note)){
            return response()->json('Not Found', 404);
        }else{
            return response()->json($note,200);
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
        $note=Note::where('title',$id)->first();

        if(!is_null($request->title)){
            $note->title = $request->title;
        }if(!is_null($request->text)){
            $note->text = $request->text;
        }

        $success = $note->save();

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
        $note=Note::where('title',$id)->get()->each;

        if(is_null($note)){
            return response()->json('Not Found',404);
        }

        $success = $note->delete();

        if(!$success){
            return response()->json('Error Deleting',500);
        }else{
            return response()->json('Delete Successed',200);
        }
    }
}
