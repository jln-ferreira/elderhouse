<?php

namespace App\Http\Controllers;

use App\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeasurementController extends Controller
{
    public function index()
    {
        return Measurement::where('active', 1)->get();
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:30'],
            'measurement' => ['required', 'string', 'max:10'],
            'comment'     => ['max:100'],
        ])->validate();


        // MEASUREMENT
        $measurement = Measurement::Create([
            'name'        => $request['name'],
            'measurement' => $request['measurement'],
            'comment'     => $request['comment'],
        ]);
        $measurement->save();


        return $measurement;
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:30'],
            'measurement' => ['required', 'string', 'max:10'],
            'comment'     => ['max:100'],
        ])->validate();

        // modify measurement
        $measurement = Measurement::find($request['id']);
        $measurement->name = $request['name'];
        $measurement->measurement = $request['measurement'];
        $measurement->comment = $request['comment'];
        $measurement->save();


        return $measurement;
    }

    public function destroy($id)
    {
        $measurement = Measurement::find($id);
        $measurement->active = 0;
        $measurement->save();

        return $measurement;
    }
}
