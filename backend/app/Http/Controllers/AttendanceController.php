<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\AttendanceFormRequest;

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
    public function store(AttendanceFormRequest $request)
    {
        $att =  Attendance::create($request->all());
        return response()->json($att, 201);
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
    public function update(AttendanceFormRequest $request, $id)
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
    public function attendancesLastMonth()
    {
        $hoje = Carbon::now()->startOfDay();
        $month = Carbon::now()->subDays(30);
        
        $attendances = DB::table('attendances')
                        ->where('attendances.dateservice','<=',$hoje)
                        ->where('attendances.dateservice','>=',$month)
                        ->count();
        $values = DB::table('attendances')
                        ->leftJoin('services', 'services.id', '=', 'attendances.service_id')
                        ->where('attendances.dateservice','<=',$hoje)
                        ->where('attendances.dateservice','>=',$month)
                        ->sum('services.value');
        
        return response()->json([$attendances, $values], 200);
    }

    public function attendancesLastWeek()
    {
        $hoje = Carbon::now()->startOfDay();
        $week = Carbon::now()->subDays(7);
        
        $attendances = DB::table('attendances')
                        ->where('attendances.dateservice','<=',$hoje)
                        ->where('attendances.dateservice','>=',$week)
                        ->count();
        $values = DB::table('attendances')
                        ->leftJoin('services', 'services.id', '=', 'attendances.service_id')
                        ->where('attendances.dateservice','<=',$hoje)
                        ->where('attendances.dateservice','>=',$week)
                        ->sum('services.value');
        
        return response()->json([$attendances, $values], 200);
    }
    public function attendancesList()
    {
       

        $attendances = DB::table('attendances')
                        ->leftJoin('clients', 'clients.id', '=', 'attendances.client_id')
                        ->leftJoin('services', 'services.id', '=', 'attendances.service_id')
                        ->select('attendances.*', 'services.name as service', 'clients.name as client' )
                        ->get();
                        
        foreach($attendances as $a)
        {
            $a->dataservice= Carbon::parse($a->dateservice)->format('d/m/y');
        }
        
        return response()->json($attendances, 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAttendance($id)
    {
        $attendance = DB::table('attendances')
                        ->leftJoin('clients', 'clients.id', '=', 'attendances.client_id')
                        ->leftJoin('services', 'services.id', '=', 'attendances.service_id')
                        ->where('attendances.id','=',$id)
                        ->select('attendances.*', 'services.name as service', 'clients.name as client' )
                        ->get();
        
        return $attendance;
    }
}
