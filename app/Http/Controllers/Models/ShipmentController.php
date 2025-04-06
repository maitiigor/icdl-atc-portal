<?php

namespace App\Http\Controllers\Models;

use App\DataTables\ShipmentItemDataTable;
use App\Models\Customer;
use App\Models\Shipment;
use App\Models\ShipmentItem;


use App\Events\ShipmentCreated;
use App\Events\ShipmentUpdated;
use App\Events\ShipmentDeleted;

use App\Http\Requests\CreateShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;

use App\DataTables\ShipmentDataTable;

use App\Http\Controllers\Controller as BaseController;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ShipmentController extends BaseController
{
    /**
     * Display a listing of the Shipment.
     *
     * @param ShipmentDataTable $shipmentDataTable
     * @return Response
     */
    public function index(ShipmentDataTable $shipmentDataTable)
    {
        $current_user = Auth()->user();
        $customers = Customer::all();


        return $shipmentDataTable->render('pages.shipments.index', [
            'current_user' => $current_user,
            "customers" => $customers,
            'months_list' => BaseController::monthsList(),
            'states_list' => BaseController::statesList()
        ]);

    }

    /**
     * Show the form for creating a new Shipment.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('pages.shipments.create');
    }

    /**
     * Store a newly created Shipment in storage.
     *
     * @param CreateShipmentRequest $request
     *
     * @return Response
     */
    public function store(CreateShipmentRequest $request)
    {
        $input = $request->all();

        /** @var Shipment $shipment */
        $shipment = Shipment::create($input);

        ShipmentCreated::dispatch($shipment);
        return redirect(route('shipments.index'));
    }

    /**
     * Display the specified Shipment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var Shipment $shipment */
        $shipment = Shipment::find($id);

        if (empty($shipment)) {
            return redirect(route('shipments.index'));
        }
        $customers = Customer::all();
        $shipmentItmemsDatatable = new ShipmentItemDataTable($shipment);

        return $shipmentItmemsDatatable->render('pages.shipments.show', [
            'shipment' => $shipment,
            'customers' => $customers,
            'current_user' => $current_user,
        ]);
    }

    /**
     * Show the form for editing the specified Shipment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var Shipment $shipment */
        $shipment = Shipment::find($id);

        if (empty($shipment)) {
            return redirect(route('shipments.index'));
        }

        return view('pages.shipments.edit')
            ->with('shipment', $shipment)
            ->with('current_user', $current_user)
            ->with('months_list', BaseController::monthsList())
            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified Shipment in storage.
     *
     * @param  int              $id
     * @param UpdateShipmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShipmentRequest $request)
    {
        /** @var Shipment $shipment */
        $shipment = Shipment::find($id);

        if (empty($shipment)) {
            return redirect(route('shipments.index'));
        }

        $shipment->fill($request->all());
        $shipment->save();

        ShipmentUpdated::dispatch($shipment);
        return redirect(route('shipments.index'));
    }

    /**
     * Remove the specified Shipment from storage.
     *
     * @param  int $id
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
            return redirect(route('shipments.index'));
        }

        $shipment->delete();

        ShipmentDeleted::dispatch($shipment);
        return redirect(route('shipments.index'));
    }


    public function processBulkUpload( Request $request)
    {

        $attachedFileName = time() . '.' . $request->file->getClientOriginalExtension();

        if(!($request->hasFile('file'))){
            return $this->sendError('No file uploaded', 200);
        }

        if(!($request->input('container_number'))){
            return $this->sendError('No Container Number is Required', 200);
        }
        $request->file->move(public_path('uploads'), $attachedFileName);
        $path_to_file = public_path('uploads') . '/' . $attachedFileName;

        $loop = 0;
        $errors = [];

        if (($open = fopen($path_to_file, "r")) !== false) {
            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                if ($loop == 0) {
                    if (count($data) != 8) {
                        return $this->sendError("Invalid CSV file uploaded", 200);
                    }
                    $loop++;
                    continue;
                }

                $shipment = Shipment::firstOrCreate(['container_number' => $request->input('container_number')]);
                $phone_number =  str_pad(str_replace("-","",$data[2]), 11, "0", STR_PAD_LEFT);
                $customer = Customer::where("telephone",$phone_number)->first();

                if(empty($customer)){
                    $customer = new Customer();
                    $customer->name = $data[1];
                    $customer->telephone = $phone_number;
                }
                $customer->available_cbm = $customer->available_cbm + trim($data[6]);
                $customer->accumulated_cbm = $customer->accumulated_cbm + trim($data[6]);

                $customer->save();

                $shipment_item = ShipmentItem::create([
                    "reference_reciept" => str_pad(trim($data[7]), 7, "0", STR_PAD_LEFT),
                    "date" =>trim($data[0]),
                    "customer_id" => $customer->id,
                    "shipment_id" => $shipment->id,
                    "product_name" =>$data[3],
                    "quantity"=> $data[4],
                    "type" => $data[5],
                    "cbm" => trim($data[6]),
                ]);


            }
            
            unlink($path_to_file);
            return $this->sendResponse("Shipmen Data Uploaded successfully", 200);
        }

    }
}
