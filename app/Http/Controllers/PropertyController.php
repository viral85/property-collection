<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Services\Property\Contracts\PropertyRepository;
use Input;
use Redirect;
use Response;

class PropertyController extends Controller {
    /*
     * Initialize Repository @PropertyRepository
     */

    public function __construct(PropertyRepository $PropertyRepository) {
        $this->PropertyRepository = $PropertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $properties = $this->PropertyRepository->getAllProperty();

        return view('master', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Search resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $attributes = $request->all();
        $return = [];
        $return['message'] = 'Error';
        $return['status'] = 0;
        $return['data'] = [];

        $properties = $this->PropertyRepository->searchProperty($attributes);

        if ($properties) {
            $return['message'] = 'Success';
            $return['status'] = 1;
            $return['data'] = $properties;
        }

        echo json_encode($return);
        exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
