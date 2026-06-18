<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Exception;
use App\Models\StockBalance;
use App\Models\StockMovement;
use App\Http\Requests\StockMovementRequest;


class StockMovementController extends Controller
{
       public function store(StockMovementRequest $request)
{
    try {

        DB::beginTransaction();

        $stock = StockBalance::where(
            'product_id',
            $request->product_id
        )
        ->lockForUpdate()
        ->first();

        // If stock record doesn't exist
        if (!$stock) {

            $stock = StockBalance::create([
                'product_id' => $request->product_id,
                'quantity' => 0
            ]);
        }

        $currentStock = $stock->quantity;

        switch ($request->movement_type) {

            case 'purchase':

            case 'sale_return':

                $newStock = $currentStock + $request->quantity;

                break;

            case 'sale':

            case 'purchase_return':

                if ($currentStock < $request->quantity) {

                    return response()->json([
                        'message' => 'Insufficient stock'
                    ], 422);
                }

                $newStock = $currentStock - $request->quantity;

                break;

            default:

                throw new Exception('Invalid movement type');
        }

        StockMovement::create([
            'product_id' => $request->product_id,
            'movement_type' => $request->movement_type,
            'quantity' => $request->quantity,
            'reference_no' => $request->reference_no,
            'notes' => $request->notes,
            // 'created_by' => auth()->id(),
            'created_by' => null,
        ]);

        $stock->update([
            'quantity' => $newStock
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Stock movement created successfully'
        ]);

    } catch (Exception $e) {

        DB::rollBack();

        return response()->json([
            'message' => $e->getMessage()
        ], 500);
    }
}



public function stock($id)
{
    $stock = StockBalance::where(
        'product_id',
        $id
    )->first();

    return response()->json([
        'product_id' => $id,
        'stock' => $stock ? $stock->quantity : 0
    ]);
}



public function movements($id)
{
    $movements = StockMovement::where(
        'product_id',
        $id
    )
    ->latest()
    ->get();

    return response()->json($movements);
}


}
