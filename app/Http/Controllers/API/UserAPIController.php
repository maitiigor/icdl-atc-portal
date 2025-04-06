<?php

namespace App\Http\Controllers\API;

use Hash;
use App\Models\User;
use App\Events\UserCreated;
use App\Events\UserDeleted;

use App\Events\UserUpdated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;

use Maitiigor\FoundationCore\Traits\ApiResponder;
;

use  App\Http\Controllers\Controller as AppBaseController;

/**
 * Class UserController
 * @package App\Controllers\API
 */

class UserAPIController extends AppBaseController
{

   // use ApiResponder;

    /**
     * Display a listing of the User.
     * GET|HEAD /Users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
              

        $users = $this->showAll($query->get());

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /Users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->except(['password']);

        /** @var User $user */
        $user = User::create(array_merge($input,["password" => Hash::make($request->input('password'))]));

        $user->syncRoles($request->input('role'));
        
        UserCreated::dispatch($user);
        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /Users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = User::with('roles')->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /Users/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $input = $request->except(['password']);
       
        if(!empty($request->input('password'))){
            $user->fill(array_merge($input, ["password" => Hash::make($request->input('password'))]));
        }else{
            $user->fill($input);
        }
        $user->save();
        $user->syncRoles($request->input('role'));
        
        UserUpdated::dispatch($user);
        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /Users/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();
        UserDeleted::dispatch($user);
        return $this->sendSuccess('User deleted successfully');
    }
}
