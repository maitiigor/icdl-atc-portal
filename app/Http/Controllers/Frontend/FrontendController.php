<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ICDLApplicationCreated;
use App\Http\Requests\CBMQuotaCheckFormRequest;
use App\Models\ClaimableItem;
use App\Models\Customer;
use App\Models\ICDLModule;
use App\Models\ShipmentItem;
use App\Models\User;
use App\Http\Requests\ContainerCheckFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Mail;

class FrontendController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $icdl_modules = ICDLModule::where('parent_id', null)->get();

        return view('frontend.index', compact('icdl_modules'));
    }

    public function showModules(Request $request)
    {

        $icdl_modules = ICDLModule::where('parent_id', null)->get();


        return view('frontend.module', compact('icdl_modules'));
    }


    public function showModuleDetails(Request $request, $id)
    {
        $icdl_module = ICDLModule::find($id);
        if (!$icdl_module) {
            return redirect()->back()->with('error', 'Module not found.');
        }
        $relationModules = ICDLModule::where('parent_id', $icdl_module->parent_id)->where("id", "<>", $icdl_module->id)->get();

        return view('frontend.module-details', compact('icdl_module', 'relationModules'));

    }

    public function applyModule(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:255',
            'icdl_module_id' => 'required|integer|exists:icdl_modules,id',
        ]);

        $icdl_module = ICDLModule::find($request->icdl_module_id);

        if (!$icdl_module) {
            return $this->sendError("Module not found", 404);
        }

        $application = $icdl_module->applications()->create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ]);

        // Send email to the user
        ICDLApplicationCreated::dispatch($application);

        return $this->sendResponse("Application submitted successfully", 200);

    }

    public function sendContactUs(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Send email to the admin
        // ...
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        $data['user_message'] = $data['message']; // Rename before sending
        unset($data['message']); // Optional cleanup


        Mail::send('mail.contact-us', $data, function ($message) use ($data) {
            $message->to('admin@example.com', 'Admin')
                ->subject('Contact Us Message from ' . $data['name'])
                ->replyTo($data['email'], $data['name']);
        });

        return $this->sendResponse("Message sent successfully", 200);
    }



}
