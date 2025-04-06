<?php

namespace App\Http\Controllers\Models;

use App\DataTables\ICDLApplicationShipmentDataTable;
use App\Models\ICDLApplication;

use App\Events\ICDLApplicationCreated;
use App\Events\ICDLApplicationUpdated;
use App\Events\ICDLApplicationDeleted;

use App\Http\Requests\CreateICDLApplicationRequest;
use App\Http\Requests\UpdateICDLApplicationRequest;

use App\DataTables\ClaimableItemDataTable;

use  App\Http\Controllers\Controller as BaseController;
;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ICDLApplicationController extends BaseController
{
    /**
     * Display a listing of the ClaimableItem.
     *
     * @param ICDLApplicationDataTable $cidlApplicationDataTable
     * @return Response
     */
    public function index(ICDLApplicationDataTable $icdlApplicationDataTable)
    {
        $current_user = Auth()->user();

      
       
    
        return $icdlApplicationDataTable->render('pages.icdl_applications.index',[
            'current_user'=>$current_user,
        ]);
    
    }

    /**
     * Show the form for creating a new ICDLApplication.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.icdl_applications.create');
    }

    /**
     * Store a newly created ICDLApplication in storage.
     *
     * @param CreateICDLApplicationRequest $request
     *
     * @return Response
     */
    public function store(CreateICDLApplicationRequest $request)
    {
        $input = $request->all();

        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::create($input);

        ICDLApplicationCreated::dispatch($icdlApplication);
        return redirect(route('icdl_applications.index'));
    }

    /**
     * Display the specified ICDLApplication.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::find($id);

        if (empty($icdlApplication)) {
            return redirect(route('icdl_applications.index'));
        }

       
        return view('pages.icdl_applications.show',[
            'icdlApplication' => $icdlApplication,
            'current_user' => $current_user
        ]);
       
    }

    /**
     * Show the form for editing the specified ICDLApplication.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::find($id);

        if (empty($icdlApplication)) {
            return redirect(route('icdl_applications.index'));
        }

        return view('pages.icdl_applications.edit')
                            ->with('icdlApplication', $icdlApplication)
                            ->with('current_user', $current_user)
                            ->with('months_list', BaseController::monthsList())
                            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified ICDLApplication in storage.
     *
     * @param  int              $id
     * @param UpdateICDLApplicationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateICDLApplicationRequest $request)
    {
        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::find($id);

        if (empty($icdlApplication)) {
            return redirect(route('icdl_applications.index'));
        }

        $icdlApplication->fill($request->all());
        $icdlApplication->save();
        
        ICDLApplicationUpdated::dispatch($icdlApplication);
        return redirect(route('icdl_applications.index'));
    }

    /**
     * Remove the specified ICDLApplication from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::find($id);

        if (empty($icdlApplication)) {
            return redirect(route('icdl_applications.index'));
        }

        $icdlApplication->delete();

        ICDLApplicationDeleted::dispatch($icdlApplication);
        return redirect(route('icdl_applications.index'));
    }
     

}
