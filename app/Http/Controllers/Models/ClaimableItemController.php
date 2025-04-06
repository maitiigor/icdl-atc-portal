<?php

namespace App\Http\Controllers\Models;

use App\DataTables\ClaimableItemShipmentDataTable;
use App\Models\ClaimableItem;

use App\Events\ClaimableItemCreated;
use App\Events\ClaimableItemUpdated;
use App\Events\ClaimableItemDeleted;

use App\Http\Requests\CreateClaimableItemRequest;
use App\Http\Requests\UpdateClaimableItemRequest;

use App\DataTables\ClaimableItemDataTable;

use  App\Http\Controllers\Controller as BaseController;
;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ClaimableItemController extends BaseController
{
    /**
     * Display a listing of the ClaimableItem.
     *
     * @param ClaimableItemDataTable $claimableItemDataTable
     * @return Response
     */
    public function index(ClaimableItemDataTable $claimableItemDataTable)
    {
        $current_user = Auth()->user();

      
       
    
        return $claimableItemDataTable->render('pages.claimable_items.index',[
            'current_user'=>$current_user,
        ]);
    
    }

    /**
     * Show the form for creating a new ClaimableItem.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('pages.claimable_items.create');
    }

    /**
     * Store a newly created ClaimableItem in storage.
     *
     * @param CreateClaimableItemRequest $request
     *
     * @return Response
     */
    public function store(CreateClaimableItemRequest $request)
    {
        $input = $request->all();

        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::create($input);

        ClaimableItemCreated::dispatch($claimableItem);
        return redirect(route('claimable_items.index'));
    }

    /**
     * Display the specified ClaimableItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::find($id);

        if (empty($claimableItem)) {
            return redirect(route('claimable_items.index'));
        }

       
        return view('pages.claimable_items.show',[
            'claimableItem' => $claimableItem,
            'current_user' => $current_user
        ]);
       
    }

    /**
     * Show the form for editing the specified ClaimableItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::find($id);

        if (empty($claimableItem)) {
            return redirect(route('claimable_items.index'));
        }

        return view('pages.claimable_items.edit')
                            ->with('claimableItem', $claimableItem)
                            ->with('current_user', $current_user)
                            ->with('months_list', BaseController::monthsList())
                            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified ClaimableItem in storage.
     *
     * @param  int              $id
     * @param UpdateClaimableItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClaimableItemRequest $request)
    {
        /** @var ClaimableItem $claimableItem */
        $claimableItem = ClaimableItem::find($id);

        if (empty($claimableItem)) {
            return redirect(route('claimable_items.index'));
        }

        $claimableItem->fill($request->all());
        $claimableItem->save();
        
        ClaimableItemUpdated::dispatch($claimableItem);
        return redirect(route('claimable_items.index'));
    }

    /**
     * Remove the specified ClaimableItem from storage.
     *
     * @param  int $id
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
            return redirect(route('claimable_items.index'));
        }

        $claimableItem->delete();

        ClaimableItemDeleted::dispatch($claimableItem);
        return redirect(route('claimable_items.index'));
    }
     

}
