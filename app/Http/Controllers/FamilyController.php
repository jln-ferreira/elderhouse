<?php

namespace App\Http\Controllers;

use App\Family;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function showClient($clientId)
    {
        return Family::activeClient($clientId);
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [

            'name'        => ['required', 'string', 'max:100'],
            'surname'     => ['required', 'string', 'max:100'],
            'parent'      => ['required', 'string', 'max:100'],
            'gender'      => ['required'],
            'phonenumber' => ['required', 'numeric'],
            'email'       => ['required', 'string', 'max:100'],
            'responsable' => ['required']

        ])->validate();


        // FAMILY
        $family = Family::Create([

            'client_id'   => $request['client_id'],
            'name'        => $request['name'],
            'surname'     => $request['surname'],
            'parent'      => $request['parent'],
            'gender'      => $request['gender'],
            'phonenumber' => $request['phonenumber'],
            'email'       => $request['email'],
            'responsable' => $request['responsable'],
        ]);
        $family->save();


        return $family;
    }


    public function show(Family $family)
    {
        //
    }


    public function edit(Family $family)
    {
        //
    }


    public function updateClient(Request $request)
    {

        Validator::make($request->all(), [

            'name'        => ['required', 'string', 'max:100'],
            'surname'     => ['required', 'string', 'max:100'],
            'parent'      => ['required', 'string', 'max:100'],
            'gender'      => ['required'],
            'phonenumber' => ['required', 'numeric'],
            'email'       => ['required', 'string', 'max:100'],
            'responsable' => ['required']

        ])->validate();

        // modify family
        $family = Family::find($request['id']);

        $family->name        = $request['name'];
        $family->surname     = $request['surname'];
        $family->parent      = $request['parent'];
        $family->gender      = $request['gender'];
        $family->phonenumber = $request['phonenumber'];
        $family->email       = $request['email'];
        $family->responsable = $request['responsable'];

        $family->save();

        return $family;
    }


    public function deleteClient(Request $request)
    {
        $family = Family::find($request['id']);
        $family->active = 0;
        $family->save();

        return $family;
    }


}
