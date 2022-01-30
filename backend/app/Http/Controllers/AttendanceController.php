<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Attendance::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Attendance::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendance = Attendance::find($id);
        return $attendance;
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
        $attendance = Attendance::find($id);
        $attendance->update($request->all());
        return $attendance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Attendance::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchAttendances($id)
    {
        $hoje = Carbon::now()->startOfDay();
        $semana = Carbon::now()->addDays(5);
        
        $attendances = DB::table('attendances')
                        ->leftJoin('clients', 'clients.id', '=', 'attendances.client_id')
                        ->leftJoin('services', 'services.id', '=', 'attendances.service_id')
                        ->where('attendances.dateservice','>=',$hoje)
                        ->where('attendances.dateservice','<=',$semana)
                        ->where('clients.id','=',$id)
                        ->select('attendances.*', 'services.name')
                        ->get();
        
        foreach($attendances as $a)
        {
            $a->dataservice= Carbon::parse($a->dateservice)->format('d/m/y');
        }
        return response()->json($attendances, 200);
    }
}
