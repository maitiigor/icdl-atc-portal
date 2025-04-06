<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ICDLApplication;

use App\Events\ICDLApplicationCreated;
use App\Events\ICDLApplicationUpdated;
use App\Events\ICDLApplicationDeleted;

use App\Http\Requests\API\CreateICDLApplicationAPIRequest;
use App\Http\Requests\API\UpdateICDLApplicationAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class ICDLApplicationController
 * @package App\Controllers\API
 */

class ICDLApplicationAPIController extends AppBaseController
{

   // use ApiResponder;

    /**
     * Display a listing of the ICDLApplication.
     * GET|HEAD /icdlApplication
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ICDLApplication::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
              

        $icdlApplication = $this->showAll($query->get());

        return $this->sendResponse($icdlApplication->toArray(), 'icdlApplication retrieved successfully');
    }

    /**
     * Store a newly created ICDLApplication in storage.
     * POST /icdlApplication
     *
     * @param CreateICDLApplicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateICDLApplicationAPIRequest $request)
    {
        $input = $request->all();

      

        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::create($input);
        
        ICDLApplicationCreated::dispatch($icdlApplication);
        return $this->sendResponse($icdlApplication->toArray(), 'ICDL Application saved successfully');
    }

    /**
     * Display the specified ICDLApplication.
     * GET|HEAD /icdlApplication/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::find($id);

        if (empty($icdlApplication)) {
            return $this->sendError('ICDLApplication not found');
        }

        return $this->sendResponse($icdlApplication->toArray(), 'ICDL Application retrieved successfully');
    }

    /**
     * Update the specified ICDLApplication in storage.
     * PUT/PATCH /icdlApplication/{id}
     *
     * @param int $id
     * @param UpdateICDLApplicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateICDLApplicationAPIRequest $request)
    {
        /** @var ICDLApplication $icdlApplication */
        $icdlApplication = ICDLApplication::find($id);

       

        $icdlApplication->fill($request->all());
        $icdlApplication->save();
        
        ICDLApplicationUpdated::dispatch($icdlApplication);
        return $this->sendResponse($icdlApplication->toArray(), 'ICDLApplication updated successfully');
    }

    /**
     * Remove the specified ICDLApplication from storage.
     * DELETE /icdlApplication/{id}
     *
     * @param int $id
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
            return $this->sendError('ICDLApplication not found');
        }

        $icdlApplication->delete();
        ICDLApplicationDeleted::dispatch($icdlApplication);
        return $this->sendSuccess('ICDLApplication deleted successfully');
    }
}
