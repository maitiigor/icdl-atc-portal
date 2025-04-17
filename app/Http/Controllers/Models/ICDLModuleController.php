<?php

namespace App\Http\Controllers\Models;

use App\DataTables\ICDLModuleApplicationDataTable;
use App\Models\ICDLModule;

use App\Events\ICDLModuleCreated;
use App\Events\ICDLModuleUpdated;
use App\Events\ICDLModuleDeleted;

use App\Http\Requests\CreateICDLModuleRequest;
use App\Http\Requests\UpdateICDLModuleRequest;

use App\DataTables\ICDLModuleDataTable;

use  App\Http\Controllers\Controller as BaseController;
;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ICDLModuleResource;


class ICDLModuleController extends BaseController
{
    /**
     * Display a listing of the ICDLModule.
     *
     * @param ICDLModuleDataTable $icdlModuleDataTable
     * @return Response
     */
    public function index(ICDLModuleDataTable $icdlModuleDataTable)
    {
        $current_user = Auth()->user();

      
      
       
    
        return $icdlModuleDataTable->render('pages.icdl_modules.index',[
            'current_user'=>$current_user,

        ]);
    
    }

    /**
     * Show the form for creating a new ICDLModule.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.icdl_modules.create');
    }

    /**
     * Store a newly created ICDLModule in storage.
     *
     * @param CreateICDLModuleRequest $request
     *
     * @return Response
     */
    public function store(CreateICDLModuleRequest $request)
    {
        $input = $request->all();

        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::create($input);

        ICDLModuleCreated::dispatch($icdlModule);
        return redirect(route('icdl_modules.index'));
    }

    /**
     * Display the specified ICDLModule.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::find($id);

        if (empty($icdlModule)) {
            return redirect(route('icdl_modules.index'));
        }

        $parentModules = ICDLModule::where('parent_id', null)->get();

        $icdlModuleApplicationDatatable = new ICDLModuleApplicationDataTable($icdlModule);

        return $icdlModuleApplicationDatatable->render('pages.icdl_modules.show',[
            'icdlModule' => $icdlModule,
            'current_user' => $current_user,
            'parentModules' => $parentModules,
        ]);
       
    }

    /**
     * Show the form for editing the specified ICDLModule.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::find($id);

        if (empty($icdlModule)) {
            return redirect(route('icdl_modules.index'));
        }

        return view('pages.ICDLModules.edit')
                            ->with('ICDLModule', $icdlModule)
                            ->with('current_user', $current_user)
                            ->with('months_list', BaseController::monthsList())
                            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified ICDLModule in storage.
     *
     * @param  int              $id
     * @param UpdateICDLModuleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateICDLModuleRequest $request)
    {
        /** @var ICDLModule $icdlModule */
        $icdlModule = ICDLModule::find($id);

        if (empty($icdlModule)) {
            return redirect(route('ICDLModules.index'));
        }

        $icdlModule->fill($request->all());
        $icdlModule->save();
        
        ICDLModuleUpdated::dispatch($icdlModule);
        return redirect(route('icdl_modules.index'));
    }

    /**
     * Remove the specified ICDLModule from storage.
     *
     * @param  int $id
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
            return redirect(route('icdl_modules.index'));
        }

        $icdlModule->delete();

        ICDLModuleDeleted::dispatch($icdlModule);
        return redirect(route('icdl_modules.index'));
    }


    public function uploadResource(Request $request){

        $request->validate([
            'icdl_module_id' => 'required|exists:icdl_modules,id',
            'resource_name' => 'required|string|max:255',
            'resource_file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);

        $icdlModule = ICDLModule::find($request->icdl_module_id);

        if ($request->hasFile('resource_file')) {
            $file = $request->file('resource_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $icdlModule->resources()->create([
                'resource_name' => $request->resource_name,
                'file_path' => 'uploads/' . $filename,
            ]);
        }

        return $this->sendSuccess('Resource uploaded successfully');
    }

    public function deleteResource($id)
    {
        $resource = ICDLModuleResource::find($id);

        if ($resource) {
            $resource->delete();
            return $this->sendSuccess('Resource deleted successfully');
        }

        return $this->sendError('Resource not found');
    }

    
}
