<?php
namespace App\Services\Turn;

use App\Http\Resources\Turn\TurnResource;
use App\Models\Turn\Turn;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TurnService {


    public function __construct(Turn $turn)
    {
        $this->turn = $turn;
    }

    public function create()
    {
        $data = [
            'canCreate' => true
        ];
        return $data;
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

    public function edit()
    {
        $allowedDates = $this->getAllowedDates();
        $data = [
            'turn' => TurnResource::make($this->turn),
            'allowedDates' => $allowedDates
        ];
        return $data;
    }

    public function destroy()
    {
        $this->turn->delete();
        return [
            'message' => 'Turn has been deleted sucessfully',
        ];
    }

    protected function getAllowedDates()
    {
        $turns = Turn::select('date')
            ->whereMonth('date', $this->turn->month)
            ->get();
        $turnsDates = [];
        foreach ($turns as $turn)
        {
            array_push($turnsDates, $turn->date);
        }
        $startDate = Carbon::parse($this->turn->month)->startOfMonth();
        $endDate = Carbon::parse($this->turn->month)->endOfMonth();
        $periodDates = CarbonPeriod::create($startDate, $endDate);
        
        $monthDates = [];
        foreach($periodDates as $md)
        {
            array_push($monthDates, $md);
        }

        $dates = array_intersect($turnsDates, $monthDates);

        return $dates;
    }

}