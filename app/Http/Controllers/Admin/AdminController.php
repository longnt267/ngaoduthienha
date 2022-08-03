<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Destination;
use App\Models\Tour;
class AdminController extends Controller
{
    protected $booking;
    protected $tour;
    protected $contact;
    protected $destination;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, Tour $tour, Contact $contact, Destination $destination)
    {
        $this->middleware('auth');
        $this->booking = $booking;
        $this->tour = $tour;
        $this->contact = $contact;
        $this->destination = $destination;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalPay = number_format($this->booking->totalPay());
        $totalBooking = $this->booking->getTotalBooking();
        $totalTour = $this->tour->getTotalTour();
        $totalDestination = $this->destination->getTotalDestination();
        $totalContact = $this->contact->getTotalcontact();
        return view('admin.dashboard', compact('totalPay', 'totalBooking', 'totalTour', 'totalDestination', 'totalContact'));
    }

    public function getDataChart(Request $request)
    {
        if ($request->ajax()) {
            return $this->booking->getDataChart($request);
        }
    }

}
