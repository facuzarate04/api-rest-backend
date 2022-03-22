<?php

namespace App\Http\Controllers\Turn;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTurnRequest;
use App\Http\Requests\UpdateTurnRequest;
use App\Http\Resources\Turn\TurnResource;
use App\Models\Turn\Turn;
use App\Services\Turn\TurnService;

class TurnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turns = Turn::with('client')
            ->when(request()->from && request()->to, function ($q) {
                $q->whereBetween('date', [request()->from, request()->to]);
            })
            ->when(request()->duration, function ($q) {
                $q->where('duration', 'like', '%' . request()->duration . '%');
            })
            ->paginate(10);
        $turns = TurnResource::collection($turns);
        return response()->json($turns, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $turn = new Turn();
            $turnService = new TurnService($turn);
            $response = $turnService->create();
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTurnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTurnRequest $request)
    {
        try {
            $data = $request->validated();
            $turn = new Turn();
            $turnService = new TurnService($turn);
            $response = $turnService->store($data);
            return response()->json($response, 201);
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turn\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function show(Turn $turn)
    {
        $turn->load('client');
        $turn = TurnResource::make($turn);
        return response()->json($turn, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turn\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function edit(Turn $turn)
    {
        try {
            $turn->load('client');
            $turnService = new TurnService($turn);
            $response = $turnService->edit();
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTurnRequest  $request
     * @param  \App\Models\Turn\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTurnRequest $request, Turn $turn)
    {
        try {
            $data = $request->validated();
            $turnService = new TurnService($turn);
            $response = $turnService->update($data);
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turn\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turn $turn)
    {
        try {
            $turnService = new TurnService($turn);
            $response = $turnService->destroy();
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage()], 500);
        }
    }
}
