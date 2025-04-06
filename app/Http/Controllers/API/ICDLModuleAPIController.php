<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ICDLModule;

use App\Events\ICDLModuleCreated;
use App\Events\ICDLModuleUpdated;
use App\Events\ICDLModuleDeleted;

use App\Http\Requests\API\CreateICDLModuleAPIRequest;
use App\Http\Requests\API\UpdateICDLModuleAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class ICDLModuleController
 * @package App\Controllers\API
 */

class ICDLModuleAPIController extends AppBaseController
{

   // use ApiResponder;

    /**
     * Display a listing of the ICDLModule.
     * GET|HEAD /icdlModule
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ICDLModule::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
              

        $icdlModule = $this->showAll($query->get());

        return $this->sendResponse($icdlModule->toArray(), 'icdlModule retrieved successfully');
    }

    /**
     * Store a newly created ICDLModule in storage.
     * POST /icdlModule
     *
     * @param CreateICDLModuleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateICDLModuleAPIRequest $request)
    {
        $input = $request->all();
        $file_name = null;
        if($request->hasFile('image_file')){
            $file_name  = time().".".$request->file('image_file')->getClientOriginalExtension();   
        }

        $request->file('image_file')->move(public_path('uploads'), $file_name);


        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::create(array_merge($input, $file_name ? [
            'image' => "uploads/".$file_name,
        ]: []));
       // dd($icdlModule);
        ICDLModuleCreated::dispatch($icdlModule);
        return $this->sendResponse($icdlModule->toArray(), 'ICDL Module saved successfully');
    }

    /**
     * Display the specified ICDLModule.
     * GET|HEAD /icdlModule/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::find($id);

        if (empty($icdlModule)) {
            return $this->sendError('ICDLModule not found');
        }

        return $this->sendResponse($icdlModule->toArray(), 'ICDL Module retrieved successfully');
    }

    /**
     * Update the specified ICDLModule in storage.
     * PUT/PATCH /icdlModule/{id}
     *
     * @param int $id
     * @param UpdateICDLModuleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateICDLModuleAPIRequest $request)
    {
        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::find($id);

        if (empty($icdlModule)) {
            return $this->sendError('ICDL Module not found');
        }
        $file_name = null;
        if($request->hasFile('image_file')){
            if(file_exists( public_path()."/".$icdlModule->image)){
                unlink(public_path()."/".$icdlModule->image);
            }
            $file_name  = time().".".$request->file('image_file')->getClientOriginalExtension();   
            $request->file('image_file')->move(public_path('uploads'), $file_name);
        }

        $icdlModule->fill(array_merge($request->all(),$file_name ? [
            "image" =>  "uploads/".$file_name,
        ]: []));
        $icdlModule->save();
        
        ICDLModuleUpdated::dispatch($icdlModule);
        return $this->sendResponse($icdlModule->toArray(), 'ICDLModule updated successfully');
    }

    /**
     * Remove the specified ICDLModule from storage.
     * DELETE /icdlModule/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::find($id);

        if (empty($icdlModule)) {
            return $this->sendError('ICDLModule not found');
        }

        $icdlModule->delete();
        ICDLModuleDeleted::dispatch($icdlModule);
        return $this->sendSuccess('ICDLModule deleted successfully');
    }
}
