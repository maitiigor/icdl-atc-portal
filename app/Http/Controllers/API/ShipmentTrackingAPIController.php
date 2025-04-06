<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ShipmentTracking;

use App\Events\ShipmentTrackingCreated;
use App\Events\ShipmentTrackingUpdated;
use App\Events\ShipmentTrackingDeleted;

use App\Http\Requests\API\CreateShipmentTrackingAPIRequest;
use App\Http\Requests\API\UpdateShipmentTrackingAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class ShipmentTrackingController
 * @package App\Controllers\API
 */

class ShipmentTrackingAPIController extends AppBaseController
{

   // use ApiResponder;

    /**
     * Display a listing of the ShipmentTracking.
     * GET|HEAD /shipmentTrackings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ShipmentTracking::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        

        $shipmentTrackings = $this->showAll($query->get());

        return $this->sendResponse($shipmentTrackings->toArray(), 'Shipment Trackings retrieved successfully');
    }

    /**
     * Store a newly created ShipmentTracking in storage.
     * POST /shipmentTrackings
     *
     * @param CreateShipmentTrackingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateShipmentTrackingAPIRequest $request)
    {
        $input = $request->all();

        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::create($input);
        
        ShipmentTrackingCreated::dispatch($shipmentTracking);
        return $this->sendResponse($shipmentTracking->toArray(), 'Shipment Tracking saved successfully');
    }

    /**
     * Display the specified ShipmentTracking.
     * GET|HEAD /shipmentTrackings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::find($id);

        if (empty($shipmentTracking)) {
            return $this->sendError('Shipment Tracking not found');
        }

        return $this->sendResponse($shipmentTracking->toArray(), 'Shipment Tracking retrieved successfully');
    }

    /**
     * Update the specified ShipmentTracking in storage.
     * PUT/PATCH /shipmentTrackings/{id}
     *
     * @param int $id
     * @param UpdateShipmentTrackingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShipmentTrackingAPIRequest $request)
    {
        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::find($id);

        if (empty($shipmentTracking)) {
            return $this->sendError('Shipment Tracking not found');
        }

        $shipmentTracking->fill($request->all());
        $shipmentTracking->save();
        
        ShipmentTrackingUpdated::dispatch($shipmentTracking);
        return $this->sendResponse($shipmentTracking->toArray(), 'ShipmentTracking updated successfully');
    }

    /**
     * Remove the specified ShipmentTracking from storage.
     * DELETE /shipmentTrackings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::find($id);

        if (empty($shipmentTracking)) {
            return $this->sendError('Shipment Tracking not found');
        }

        $shipmentTracking->delete();
        ShipmentTrackingDeleted::dispatch($shipmentTracking);
        return $this->sendSuccess('Shipment Tracking deleted successfully');
    }
}
