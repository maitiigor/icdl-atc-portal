<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;

use App\Events\CustomerCreated;
use App\Events\CustomerUpdated;
use App\Events\CustomerDeleted;

use App\Http\Requests\API\CreateCustomerAPIRequest;
use App\Http\Requests\API\UpdateCustomerAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class CustomerController
 * @package App\Controllers\API
 */

class CustomerAPIController extends AppBaseController
{

   // use ApiResponder;

    /**
     * Display a listing of the Customer.
     * GET|HEAD /customers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
              

        $customers = $this->showAll($query->get());

        return $this->sendResponse($customers->toArray(), 'Customers retrieved successfully');
    }

    /**
     * Store a newly created Customer in storage.
     * POST /customers
     *
     * @param CreateCustomerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Customer $customer */
        $customer = Customer::create($input);
        
        CustomerCreated::dispatch($customer);
        return $this->sendResponse($customer->toArray(), 'Customer saved successfully');
    }

    /**
     * Display the specified Customer.
     * GET|HEAD /customers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id);

        if (empty($customer)) {
            return $this->sendError('Customer not found');
        }

        return $this->sendResponse($customer->toArray(), 'Customer retrieved successfully');
    }

    /**
     * Update the specified Customer in storage.
     * PUT/PATCH /customers/{id}
     *
     * @param int $id
     * @param UpdateCustomerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerAPIRequest $request)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id);

        if (empty($customer)) {
            return $this->sendError('Customer not found');
        }

        $customer->fill($request->all());
        $customer->save();
        
        CustomerUpdated::dispatch($customer);
        return $this->sendResponse($customer->toArray(), 'Customer updated successfully');
    }

    /**
     * Remove the specified Customer from storage.
     * DELETE /customers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id);

        if (empty($customer)) {
            return $this->sendError('Customer not found');
        }

        $customer->delete();
        CustomerDeleted::dispatch($customer);
        return $this->sendSuccess('Customer deleted successfully');
    }

    public function bulkDelete(Request $request){

        $customer_ids = explode(",",$request->input('selected_items'));

        Customer::whereIn("id", $customer_ids)->delete();

        return $this->sendResponse([],"Items Deleted Successfully");
    }
}
