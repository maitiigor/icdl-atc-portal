<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ShipmentItem;

use App\Events\ShipmentItemCreated;
use App\Events\ShipmentItemUpdated;
use App\Events\ShipmentItemDeleted;

use App\Http\Requests\API\CreateShipmentItemAPIRequest;
use App\Http\Requests\API\UpdateShipmentItemAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class ShipmentItemController
 * @package App\Controllers\API
 */

class ShipmentItemAPIController extends AppBaseController
{

  //  use ApiResponder;

    /**
     * Display a listing of the ShipmentItem.
     * GET|HEAD /shipmentItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ShipmentItem::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        

        $shipmentItems = $this->showAll($query->get());

        return $this->sendResponse($shipmentItems->toArray(), 'Shipment Items retrieved successfully');
    }

    /**
     * Store a newly created ShipmentItem in storage.
     * POST /shipmentItems
     *
     * @param CreateShipmentItemAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateShipmentItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::create($input);
        
        ShipmentItemCreated::dispatch($shipmentItem);
        return $this->sendResponse($shipmentItem->toArray(), 'Shipment Item saved successfully');
    }

    /**
     * Display the specified ShipmentItem.
     * GET|HEAD /shipmentItems/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::find($id);

        if (empty($shipmentItem)) {
            return $this->sendError('Shipment Item not found');
        }

        return $this->sendResponse($shipmentItem->toArray(), 'Shipment Item retrieved successfully');
    }

    /**
     * Update the specified ShipmentItem in storage.
     * PUT/PATCH /shipmentItems/{id}
     *
     * @param int $id
     * @param UpdateShipmentItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShipmentItemAPIRequest $request)
    {
        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::find($id);

        if (empty($shipmentItem)) {
            return $this->sendError('Shipment Item not found');
        }

        $shipmentItem->fill($request->all());
        $shipmentItem->save();
        
        ShipmentItemUpdated::dispatch($shipmentItem);
        return $this->sendResponse($shipmentItem->toArray(), 'ShipmentItem updated successfully');
    }

    /**
     * Remove the specified ShipmentItem from storage.
     * DELETE /shipmentItems/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::find($id);

        if (empty($shipmentItem)) {
            return $this->sendError('Shipment Item not found');
        }

        $shipmentItem->delete();
        ShipmentItemDeleted::dispatch($shipmentItem);
        return $this->sendSuccess('Shipment Item deleted successfully');
    }

    public function bulkDelete(Request $request){

        $shipment_item_ids = explode(",",$request->input('selected_items'));

        ShipmentItem::whereIn("id", $shipment_item_ids)->delete();

        return $this->sendResponse([],"Items Deleted Successfully");
    }
}
