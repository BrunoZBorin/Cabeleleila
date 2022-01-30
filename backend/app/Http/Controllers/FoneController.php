<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fone;

class FoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Fone::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Fone::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fone = Fone::find($id);
        return $fone;
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
        $fone = Fone::find($id);
        $fone->update($request->all());
        return $fone;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Fone::destroy($id);
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  str  $numero
     * @return \Illuminate\Http\Response
     */
    public function search($numero)
    {
        return Fone::where('numero','like',  '%'.$numero.'%')->get();
    }
}
