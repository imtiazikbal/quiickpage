<?php

namespace App\Http\Controllers\api\v2;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends BaseController
{
    
    public function index()
    {
        $data = Contact::all();

        return $this->sendResponse($data, 'Contact retrieved successfully.');
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            'firstName' => 'nullable',
            'lastName' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'message' => 'nullable',
            'subject' => 'nullable'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        Contact::create($input);

        return $this->sendResponse($input, 'Contact created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->sendError('Contact not found.');
        }else{
            return $this->sendResponse($contact, 'Contact retrieved successfully.');
        }
    }
    public function destroy($id){
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->sendError('Contact not found.');
        }else{
            Contact::where('id', $id)->delete();
            return $this->sendResponse('Delete', 'Contact deleted successfully.');
        }
    }

}
