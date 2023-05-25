<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function batches($id){
        try {
            $batches = Batch::query()->firstWhere('num_batch', $id);
            if($batches == null){
                $res = [
                    'status' => '404',
                    'message' => 'This batch does not exist yet, a new one will be created',
                ];
                return response()->json($res);
            }
            return response()->json($batches);
        }
        catch(ModelNotFoundException $e){
            $res = [
                'status' => '404',
                'message' => 'This batch does not exist yet',
            ];
            return response()->json($res);
        }
    }
}
