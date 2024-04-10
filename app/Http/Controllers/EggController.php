<?php

namespace App\Http\Controllers;

use App\Http\Response;
use App\Models\Egg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EggController extends Controller
{
    private function getTotalEgg()
    {
        $total = 0;
        $eggs = Egg::all();
        $keys = ["rotten_egg", "small_egg", "medium_egg", "large_egg"];

        foreach ($keys as $key) {
            $total += $eggs->sum($key);
        }

        return $total;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eggs = Egg::orderBy("date")->get();

        $result = [
            "eggs"  => $eggs,
            "total" => $this->getTotalEgg()
        ];
        return Response::success($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "rotten_egg"    => "required|integer|min:0",
            "small_egg"     => "required|integer|min:0",
            "medium_egg"    => "required|integer|min:0",
            "large_egg"     => "required|integer|min:0",
            "date"          => "required|date_format:Y-m-d"
        ]);
        if ($validator->fails()) return Response::errors($validator);

        $eggData = $validator->safe()->except("date");
        Egg::updateOrCreate([
            "date"  => $request->date
        ], $eggData);

        $egg = Egg::where("date", $request->date)->first();
        return Response::success($egg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Egg  $egg
     * @return \Illuminate\Http\Response
     */
    public function show(Egg $egg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Egg  $egg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egg $egg)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Egg  $egg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egg $egg)
    {
        // 
    }
}
