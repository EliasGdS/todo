<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $task;

    public function __construct(Todo $task)
    {
        $this->task = $task;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->task->get();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), $this->task->rules());

        if ($validate->fails()) {
            $messages = $validate->errors();
            return response()->json(['errors' => $messages], 422);
        }

        if (!$insert = $request->user()
            ->tasks()
            ->create($request->all()))
            return response()->json(['error' => 'error_insert'], 500);

        return response()->json($insert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

        $validate = validator($request->all(), $this->task->rules());

        if ($validate->fails()) {
            $messages = $validate->errors();
            return response()->json(['validate.error', $messages]);
        }

        if (!$response = $this->task->find($id))
            return response()->json(['error' => 'not_found']);


        if ($response->update($request->all()))
            return response()->json(['error' => 'not_update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$response = $this->task->find($id))
            return response()->json(['error' => 'not_found']);

        if (!$delete = $response->delete())
            return response()->json(['error' => 'not_delete'], 500);
    }
}
