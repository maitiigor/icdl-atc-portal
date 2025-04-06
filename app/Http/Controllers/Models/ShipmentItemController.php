<?php

namespace App\Http\Controllers\Models;

use App\Models\ShipmentItem;

use App\Events\ShipmentItemCreated;
use App\Events\ShipmentItemUpdated;
use App\Events\ShipmentItemDeleted;

use App\Http\Requests\CreateShipmentItemRequest;
use App\Http\Requests\UpdateShipmentItemRequest;

use App\DataTables\ShipmentItemDataTable;

use  App\Http\Controllers\Controller as BaseController;


use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ShipmentItemController extends BaseController
{
    /**
     * Display a listing of the ShipmentItem.
     *
     * @param ShipmentItemDataTable $shipmentItemDataTable
     * @return Response
     */
    public function index(ShipmentItemDataTable $shipmentItemDataTable)
    {
        $current_user = Auth()->user();

        $cdv_shipment_items = new \Maitiigor\FoundationCore\View\Components\CardDataView(ShipmentItem::class, "pages.shipment_items.card_view_item");
        $cdv_shipment_items->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search ShipmentItem');

        if (request()->expectsJson()){
            return $cdv_shipment_items->render();
        }

        return view('pages.shipment_items.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_shipment_items', $cdv_shipment_items);

        /*
        return $shipmentItemDataTable->render('pages.shipment_items.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new ShipmentItem.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('pages.shipment_items.create');
    }

    /**
     * Store a newly created ShipmentItem in storage.
     *
     * @param CreateShipmentItemRequest $request
     *
     * @return Response
     */
    public function store(CreateShipmentItemRequest $request)
    {
        $input = $request->all();

        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::create($input);

        ShipmentItemCreated::dispatch($shipmentItem);
        return redirect(route('shipmentItems.index'));
    }

    /**
     * Display the specified ShipmentItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::find($id);

        if (empty($shipmentItem)) {
            return redirect(route('shipmentItems.index'));
        }


        return view('pages.shipment_items.show')
                            ->with('shipmentItem', $shipmentItem)
                            ->with('current_user', $current_user)
                            ->with('months_list', BaseController::monthsList())
                            ->with('states_list', BaseController::statesList());
    }

    /**
     * Show the form for editing the specified ShipmentItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::find($id);

        if (empty($shipmentItem)) {
            return redirect(route('shipmentItems.index'));
        }

        return view('pages.shipment_items.edit')
                            ->with('shipmentItem', $shipmentItem)
                            ->with('current_user', $current_user)
                            ->with('months_list', BaseController::monthsList())
                            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified ShipmentItem in storage.
     *
     * @param  int              $id
     * @param UpdateShipmentItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShipmentItemRequest $request)
    {
        /** @var ShipmentItem $shipmentItem */
        $shipmentItem = ShipmentItem::find($id);

        if (empty($shipmentItem)) {
            return redirect(route('shipmentItems.index'));
        }

        $shipmentItem->fill($request->all());
        $shipmentItem->save();
        
        ShipmentItemUpdated::dispatch($shipmentItem);
        return redirect(route('shipmentItems.index'));
    }

    /**
     * Remove the specified ShipmentItem from storage.
     *
     * @param  int $id
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
            return redirect(route('shipmentItems.index'));
        }

        $shipmentItem->delete();

        ShipmentItemDeleted::dispatch($shipmentItem);
        return redirect(route('shipmentItems.index'));
    }

        
    public function processBulkUpload(Request $request){

        $attachedFileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $attachedFileName);
        $path_to_file = public_path('uploads').'/'.$attachedFileName;

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
        }else{
            $errors[] = 'The uploaded csv file is empty';
        }
        
        if (count($errors) > 0) {
            return $this->sendError($this->array_flatten($errors), 'Errors processing file');
        }
        return $this->sendResponse($subject->toArray(), 'Bulk upload completed successfully');
    }


}
