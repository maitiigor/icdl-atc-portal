<?php

namespace App\Http\Controllers\Models;

use App\DataTables\userShipmentDataTable;
use App\Models\User;

use App\Events\UserCreated;
use App\Events\UserUpdated;
use App\Events\UserDeleted;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\DataTables\UserDataTable;

use  App\Http\Controllers\Controller as BaseController;
;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Hash;


class UserController extends BaseController
{
    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        $current_user = Auth()->user();

      
       $roles = Role::all();
    
        return $userDataTable->render('pages.users.index',[
            'current_user'=>$current_user,
            'roles' => $roles,
        ]);
    
    }


    public function showProfile(){
        $current_user = auth()->user();
        return view('pages.users.profile')->with('current_user', $current_user);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = User::create($input);

        UserCreated::dispatch($user);
        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $current_user = Auth()->user();

        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            return redirect(route('users.index'));
        }

       $roles = Role::all();


        
        return view('pages.users.index')->with('roles', $roles);
       
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $current_user = Auth()->user();

        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            return redirect(route('users.index'));
        }

        return view('pages.users.edit')
                            ->with('User', $user)
                            ->with('current_user', $current_user)
                            ->with('months_list', BaseController::monthsList())
                            ->with('states_list', BaseController::statesList());
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            return redirect(route('users.index'));
        }
        $input = $request->except('password');

        if(!empty($request->input('password'))){
            $user->fill(array_merge($input, ["password" => Hash::make($request->input('password'))]));
        }else{
            $user->fill($input);
        }

        $user->save();
        
        UserUpdated::dispatch($user);
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
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
            return redirect(route('users.index'));
        }

        $user->delete();

        UserDeleted::dispatch($user);
        return redirect(route('users.index'));
    }

        

}
