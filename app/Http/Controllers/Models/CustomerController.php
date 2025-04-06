<?php

namespace App\Http\Controllers\Models;

use App\DataTables\CustomerShipmentDataTable;
use App\Models\Customer;

use App\Events\CustomerCreated;
use App\Events\CustomerUpdated;
use App\Events\CustomerDeleted;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

use App\DataTables\CustomerDataTable;

use  App\Http\Controllers\Controller as BaseController;
;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CustomerController extends BaseController
{
    /**
     * Display a listing of the Customer.
     *
     * @param CustomerDataTable $customerDataTable
     * @return Response
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        $current_user = Auth()->user();

      
       
    
        return $customerDataTable->render('pages.customers.index',[
            'current_user'=>$current_user,
        ]);
    
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('pages.customers.create');
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param CreateCustomerRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $input = $request->all();

        /** @var Customer $customer */
        $customer = Customer::create($input);

        CustomerCreated::dispatch($customer);
        return redirect(route('customers.index'));
    }

    /**
     * Display the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var Customer $customer */
        $customer = Customer::find($id);

        if (empty($customer)) {
            return redirect(route('customers.index'));
        }

        $customershipmentDatatable = new CustomerShipmentDataTable($customer);

        return $customershipmentDatatable->render('pages.customers.show',[
            'customer' => $customer,
            'current_user' => $current_user
        ]);
       
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var Customer $customer */
        $customer = Customer::find($id);

        if (empty($customer)) {
            return redirect(route('customers.index'));
        }

        return view('pages.customers.edit')
                            ->with('customer', $customer)
                            ->with('current_user', $current_user)
                            ->with('months_list', BaseController::monthsList())
                            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerRequest $request)
    {
        /** @var Customer $customer */
        $customer = Customer::find($id);

        if (empty($customer)) {
            return redirect(route('customers.index'));
        }

        $customer->fill($request->all());
        $customer->save();
        
        CustomerUpdated::dispatch($customer);
        return redirect(route('customers.index'));
    }

    /**
     * Remove the specified Customer from storage.
     *
     * @param  int $id
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
            return redirect(route('customers.index'));
        }

        $customer->delete();

        CustomerDeleted::dispatch($customer);
        return redirect(route('customers.index'));
    }

    
}
