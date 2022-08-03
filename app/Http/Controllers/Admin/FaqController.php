<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FaqRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Faq;

class FaqController extends Controller
{
    protected $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function index($tourId, Tour $tour)
    {
        $nameTour = $tour->getTourById($tourId)->title;
        return view('admin.faq.list', compact('tourId', 'nameTour'));
    }

    public function getData(Request $request, $tourId)
    {
        return $this->faq->getDataAjax($request, $tourId);
    }

    public function create($tourId)
    {
        return view('admin.faq.create', compact('tourId'));
    }

    public function store(FaqRequest $request, Faq $faq, $tourId)
    {
        try {
            $faq->saveRecord($request, $tourId);
            if($request->submit == 'submit') {
                return back()->with('message', 'Faq added successfully'); 
            }
            return redirect()->route('faq.index', $tourId)->with('message', 'Faq added successfully');   
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Faq added failed');
        }
    }

    public function edit($tourId, $id)
    {
        $faq = $this->faq->getFaqById($id);
        return view('admin.faq.edit', compact('id', 'tourId', 'faq'));
    }

    public function update(FaqRequest $request, $tourId, $id)
    {
        try {
            $faq = $this->faq->getFaqById($id);
            $faq->saveRecord($request, $tourId, $id);
            return redirect()->route('faq.index', $tourId)->with('message', 'Faq updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Faq updated failed');
        }
    }

    public function destroy($id)
    {
        $faq = $this->faq->getFaqById($id);
        $faq->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $faq = $this->faq->getFaqById($id);
        $faq->changeStatusAjax($request);
    }
}
