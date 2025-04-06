<?php

namespace App\Http\Controllers\Models;

use App\Models\ShipmentTracking;

use App\Events\ShipmentTrackingCreated;
use App\Events\ShipmentTrackingUpdated;
use App\Events\ShipmentTrackingDeleted;

use App\Http\Requests\CreateShipmentTrackingRequest;
use App\Http\Requests\UpdateShipmentTrackingRequest;

use App\DataTables\ShipmentTrackingDataTable;

use App\Http\Controllers\Controller as BaseController;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ShipmentTrackingController extends BaseController
{
    /**
     * Display a listing of the ShipmentTracking.
     *
     * @param ShipmentTrackingDataTable $shipmentTrackingDataTable
     * @return Response
     */
    public function index(ShipmentTrackingDataTable $shipmentTrackingDataTable)
    {
        $current_user = Auth()->user();



        return $shipmentTrackingDataTable->render('pages.shipment_trackings.index', compact(
            'current_user'
        ));



        /*
        return $shipmentTrackingDataTable->render('pages.shipment_trackings.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new ShipmentTracking.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('pages.shipment_trackings.create');
    }

    /**
     * Store a newly created ShipmentTracking in storage.
     *
     * @param CreateShipmentTrackingRequest $request
     *
     * @return Response
     */
    public function store(CreateShipmentTrackingRequest $request)
    {
        $input = $request->all();

        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::create($input);

        ShipmentTrackingCreated::dispatch($shipmentTracking);
        return redirect(route('shipmentTrackings.index'));
    }

    /**
     * Display the specified ShipmentTracking.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::find($id);

        if (empty($shipmentTracking)) {
            return redirect(route('shipmentTrackings.index'));
        }

        return view('pages.shipment_trackings.show')
            ->with('shipmentTracking', $shipmentTracking)
            ->with('current_user', $current_user)
            ->with('months_list', BaseController::monthsList())
            ->with('states_list', BaseController::statesList());
    }

    /**
     * Show the form for editing the specified ShipmentTracking.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::find($id);

        if (empty($shipmentTracking)) {
            return redirect(route('shipmentTrackings.index'));
        }

        return view('pages.shipment_trackings.edit')
            ->with('shipmentTracking', $shipmentTracking)
            ->with('current_user', $current_user)
            ->with('months_list', BaseController::monthsList())
            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified ShipmentTracking in storage.
     *
     * @param  int              $id
     * @param UpdateShipmentTrackingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShipmentTrackingRequest $request)
    {
        /** @var ShipmentTracking $shipmentTracking */
        $shipmentTracking = ShipmentTracking::find($id);

        if (empty($shipmentTracking)) {
            return redirect(route('shipmentTrackings.index'));
        }

        $shipmentTracking->fill($request->all());
        $shipmentTracking->save();

        ShipmentTrackingUpdated::dispatch($shipmentTracking);
        return redirect(route('shipmentTrackings.index'));
    }

    /**
     * Remove the specified ShipmentTracking from storage.
     *
     * @param  int $id
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
            return redirect(route('shipmentTrackings.index'));
        }

        $shipmentTracking->delete();

        ShipmentTrackingDeleted::dispatch($shipmentTracking);
        return redirect(route('shipmentTrackings.index'));
    }


    public function processBulkUpload(Request $request)
    {

        $attachedFileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $attachedFileName);
        $path_to_file = public_path('uploads') . '/' . $attachedFileName;

        //Process each line
        $loop = 1;
        $errors = [];
        $lines = file($path_to_file);

        if (count($lines) > 1) {
            foreach ($lines as $line) {

                if ($loop > 1) {
                    $data = explode(',', $line);
                    // if (count($invalids) > 0) {
                    //     array_push($errors, $invalids);
                    //     continue;
                    // }else{
                    //     //Check if line is valid
                    //     if (!$valid) {
                    //         $errors[] = $msg;
                    //     }
                    // }
                }
                $loop++;
            }
        } else {
            $errors[] = 'The uploaded csv file is empty';
        }

        if (count($errors) > 0) {
            return $this->sendError($this->array_flatten($errors), 'Errors processing file');
        }
        return $this->sendResponse($subject->toArray(), 'Bulk upload completed successfully');
    }
}
