<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ClaimableItem;

use App\Events\ClaimableItemCreated;
use App\Events\ClaimableItemUpdated;
use App\Events\ClaimableItemDeleted;

use App\Http\Requests\API\CreateClaimableItemAPIRequest;
use App\Http\Requests\API\UpdateClaimableItemAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class ClaimableItemController
 * @package App\Controllers\API
 */

class ClaimableItemAPIController extends AppBaseController
{

   // use ApiResponder;

    /**
     * Display a listing of the ClaimableItem.
     * GET|HEAD /claimableItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ClaimableItem::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
              

        $claimableItems = $this->showAll($query->get());

        return $this->sendResponse($claimableItems->toArray(), 'ClaimableItems retrieved successfully');
    }

    /**
     * Store a newly created ClaimableItem in storage.
     * POST /claimableItems
     *
     * @param CreateClaimableItemAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClaimableItemAPIRequest $request)
    {
        $input = $request->all();

        $file_name  = time().".".$request->file('product_image')->getClientOriginalExtension();   

        $request->file('product_image')->move(public_path('uploads'), $file_name);


        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::create(array_merge($input, [
            'image_path'=> "uploads/".$file_name,
        ]));
        
        ClaimableItemCreated::dispatch($claimableItem);
        return $this->sendResponse($claimableItem->toArray(), 'ClaimableItem saved successfully');
    }

    /**
     * Display the specified ClaimableItem.
     * GET|HEAD /claimableItems/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::find($id);

        if (empty($claimableItem)) {
            return $this->sendError('ClaimableItem not found');
        }

        return $this->sendResponse($claimableItem->toArray(), 'ClaimableItem retrieved successfully');
    }

    /**
     * Update the specified ClaimableItem in storage.
     * PUT/PATCH /claimableItems/{id}
     *
     * @param int $id
     * @param UpdateClaimableItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClaimableItemAPIRequest $request)
    {
        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::find($id);

        if (empty($claimableItem)) {
            return $this->sendError('Claimable Item not found');
        }
        $file_name = $claimableItem->image_path;
        if($request->hasFile('product_image')){
            if(file_exists( public_path()."/".$file_name)){
                unlink(public_path()."/".$file_name);
            }
            $file_name  = time().".".$request->file('product_image')->getClientOriginalExtension();   
            $request->file('product_image')->move(public_path('uploads'), $file_name);
        }

        $claimableItem->fill(array_merge($request->all(),[
            "image_path" =>  "uploads/".$file_name,
        ]));
        $claimableItem->save();
        
        ClaimableItemUpdated::dispatch($claimableItem);
        return $this->sendResponse($claimableItem->toArray(), 'ClaimableItem updated successfully');
    }

    /**
     * Remove the specified ClaimableItem from storage.
     * DELETE /claimableItems/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::find($id);

        if (empty($claimableItem)) {
            return $this->sendError('ClaimableItem not found');
        }

        $claimableItem->delete();
        ClaimableItemDeleted::dispatch($claimableItem);
        return $this->sendSuccess('ClaimableItem deleted successfully');
    }
}
