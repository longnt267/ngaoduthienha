<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        return view('admin.contact.list');
    }

    public function getData(Request $request)
    {
        return $this->contact->getDataAjax($request);
    }

    public function store(ContactRequest $request)
    {
        $this->contact->saveRecord($request);
    }

    public function updateStatus(Request $request, $id)
    {
        $this->contact->changeStatusAjax($request, $id);
    }

    public function destroy($id) 
    {
        $this->contact->deleteRecord($id);
    }
}
