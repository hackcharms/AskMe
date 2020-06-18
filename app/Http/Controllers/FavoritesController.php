<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question)
    {
        $question->favorites()->attach(auth()->id());
        return back()->with('success','Favorite Marked');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Question  $question
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Question $question)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Question  $question
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Question $question)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Question  $question
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Question $question)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());
        return back();
    }
}