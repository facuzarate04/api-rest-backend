<?php
namespace App\Services\Turn;

use App\Http\Resources\Turn\TurnResource;
use App\Models\Turn\Turn;

class TurnService {


    public function __construct(Turn $turn)
    {
        $this->turn = $turn;
    }

    public function store($data)
    {
        $turn = $this->turn->create([
            'client_id' => $data['client_id'],
            'date' => $data['date'],
            'duration' => $data['duration'],
            'status' => 'PENDING'
        ])->fresh();
        $turn->load('client');
        
        return [
            'message' => 'Turn has been store sucessfully',
            'turn' => TurnResource::make($turn)
        ];
    }

    public function update($data)
    {
        $this->turn->update([
            'date' => $data['date'],
            'duration' => $data['duration'], 
            'status' => strtoupper($data['status'])
        ]);
        $this->turn->load('client');
        return [
            'message' => 'Turn has been updated sucessfully',
            'turn' => TurnResource::make($this->turn)
        ];
    }

    public function destroy()
    {
        $this->turn->delete();
        return [
            'message' => 'Turn has been deleted sucessfully',
        ];
    }

}