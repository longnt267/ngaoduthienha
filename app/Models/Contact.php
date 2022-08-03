<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message'
    ];

    public function getDataAjax($request)
    {
        $data = $this->select('*')->latest();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if(!empty($request->search)) {
                    $query->where('name', 'like', "%$request->search%")
                          ->orWhere('phone', $request->search)
                          ->orWhere('email', $request->search);  
                }
                if(!empty($request->status)) {
                    $query->where('status', $request->status);
                }
            })
            ->addColumn('status', function($data) {
                if($data->status == 1) {
                    return 'unread';
                }
                if($data->status == 2) {
                    return 'readed';
                }
            })
            ->addColumn('action', function($data) {
                return view('admin.elements.act_contact', ['data' => $data]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);   
    }

    public function saveRecord($request)
    {
        $this->create($request->all());
    }

    public function changeStatusAjax($request, $id) 
    {
        if($request->ajax()) {
            $contact = $this->findOrFail($id);
            $contact->status = $request->status;
            $contact->save();
        } 
    }

    public function deleteRecord($id)
    {
        $contact = $this->findOrFail($id);   
        $contact->delete();
    }

    public function getTotalcontact() {
        return $this->count();
    }
}
