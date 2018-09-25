<?php

namespace App\Http\Controllers;

use App\status;
use Illuminate\Http\Request;

class statusController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return status::latest()->get();
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
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {

		date_default_timezone_set( 'Asia/Kolkata' );
		$store = status::create( [
			'user_id'    => '1',
			'author'    => $request->name,
			'body'       => $request->comment,
			'created_at' => date( "Y-m-d H:i:s" ),
			'updated_at' => date( "Y-m-d H:i:s" ),
		] );
		$rdata=status::where('id','=',$store->id)->first();
		return response()->json( [
			'status'  => $rdata,
			'message' => "Successfully added."
		], 200 );

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\status $status
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( status $status ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\status $status
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( status $status ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\status $status
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, status $status ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\status $status
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( status $status ) {
		$status->delete();
		return response()->json( [
			'message' => "Status Deleted Successfully"
		], 200 );
	}
}
