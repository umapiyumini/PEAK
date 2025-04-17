<?php

class Groundcourts {
    use Model;
    
    protected $table = 'groundcourts';
    protected $fillable = ['courtid', 'event', 'duration', 'description', 'price']; // Include rating here

    public function getTable() {
        return $this->table;
    }

    // Assuming your controller is handling this
public function getPrice(Request $request) {
    $event = $request->input('event');
    $duration = $request->input('duration');
    $courtId = 24; // Always fixed as 24

    // Fetch the price from the database based on event and duration
    $priceData = DB::table('groundcourts')
                    ->where('courtid', $courtId)
                    ->where('event', $event)
                    ->where('duration', $duration)
                    ->first();

    if ($priceData) {
        return response()->json(['status' => 'success', 'price' => $priceData->price]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Price not found']);
    }
}
}
