<?php

namespace App\Http\Controllers;

use App\Precification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrecificationController extends Controller
{
    public function index()
    {
        return Precification::where('active', 1)->get();
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name'    => ['required', 'string', 'max:30'],
            'price'   => ['required', 'numeric'],
            'comment' => ['max:100'],
        ])->validate();


        // Precification
        $precification = Precification::Create([
            'name'    => $request['name'],
            'price'   => $request['price'],
            'comment' => $request['comment'],
        ]);
        $precification->save();


        return $precification;
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name'    => ['required', 'string', 'max:30'],
            'price'   => ['required', 'numeric'],
            'comment' => ['max:100'],
        ])->validate();

        // modify Precification
        $precification = Precification::find($request['id']);
        $precification->name    = $request['name'];
        $precification->price   = $request['price'];
        $precification->comment = $request['comment'];
        $precification->save();


        return $precification;
    }

    public function destroy($id)
    {
        $precification = Precification::find($id);
        $precification->active = 0;
        $precification->save();

        return $precification;
    }
}
