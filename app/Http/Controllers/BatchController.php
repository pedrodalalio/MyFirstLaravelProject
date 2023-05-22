<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function batches(int $id){
        try {
            $batches = Batch::query()->findOrFail($id);
        }
        catch(ModelNotFoundException $e){
            $res = [
                'status' => '404',
                'message' => 'This batch does not exist yet',
            ];
            return response()->json($res);
        }
        return response()->json($batches);
    }
}
