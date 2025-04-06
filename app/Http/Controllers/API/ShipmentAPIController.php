<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Shipment;

use App\Events\ShipmentCreated;
use App\Events\ShipmentUpdated;
use App\Events\ShipmentDeleted;

use App\Http\Requests\API\CreateShipmentAPIRequest;
use App\Http\Requests\API\UpdateShipmentAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class ShipmentController
 * @package App\Controllers\API
 */

class ShipmentAPIController extends AppBaseController
{

   // use ApiResponder;

    /**
     * Display a listing of the Shipment.
     * GET|HEAD /shipments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Shipment::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        

        $shipments = $this->showAll($query->get());

        return $this->sendResponse($shipments->toArray(), 'Shipments retrieved successfully');
    }

    /**
     * Store a newly created Shipment in storage.
     * POST /shipments
     *
     * @param CreateShipmentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateShipmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Shipment $shipment */
        $shipment = Shipment::create($input);
        
        ShipmentCreated::dispatch($shipment);
        return $this->sendResponse($shipment->toArray(), 'Shipment saved successfully');
    }

    /**
     * Display the specified Shipment.
     * GET|HEAD /shipments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Shipment $shipment */
        $shipment = Shipment::find($id);

        if (empty($shipment)) {
            return $this->sendError('Shipment not found');
        }

        return $this->sendResponse($shipment->toArray(), 'Shipment retrieved successfully');
    }

    /**
     * Update the specified Shipment in storage.
     * PUT/PATCH /shipments/{id}
     *
     * @param int $id
     * @param UpdateShipmentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShipmentAPIRequest $request)
    {
        /** @var Shipment $shipment */
        $shipment = Shipment::find($id);

        if (empty($shipment)) {
            return $this->sendError('Shipment not found');
        }

        $shipment->fill($request->all());
        $shipment->save();
        
        ShipmentUpdated::dispatch($shipment);
        return $this->sendResponse($shipment->toArray(), 'Shipment updated successfully');
    }

    /**
     * Remove the specified Shipment from storage.
     * DELETE /shipments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Shipment $shipment */
        $shipment = Shipment::find($id);

        if (empty($shipment)) {
            return $this->sendError('Shipment not found');
        }

        $shipment->shipment_items()->delete();

        $shipment->delete();
        ShipmentDeleted::dispatch($shipment);
        return $this->sendSuccess('Shipment deleted successfully');
    }
}
