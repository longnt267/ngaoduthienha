<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;
use App\Models\DateOfTour;
use Session;

class BookingController extends Controller
{
    protected $booking;
    protected $tour;
    protected $dateOfTour;

    public function __construct(Booking $booking, Tour $tour, DateOfTour $dateOfTour)
    {
        $this->booking = $booking;
        $this->tour = $tour;
        $this->dateOfTour = $dateOfTour;
    }

    public function index()
    {
        return view('admin.booking.list');
    }

    // view detail booking
    public function detail($id)
    {
        $booking = $this->booking->getBookingById($id);
        $booking = $this->booking->formatBookingData($booking);
        $tour = $this->tour->getTourById($booking->tour_id);
        return view('admin.booking.detail', compact('booking', 'tour'));
    }

    public function getData(Request $request) 
    {
        return $this->booking->getDataAjax($request);
    }

    public function addBooking(Request $request)
    {
        $this->booking->createBookingSession($request);
    }

    public function store(BookingRequest $request)
    {
        if(Session('Booking')) {
            $booking = Session('Booking');
            $totalPrice = $booking['total_price'];
            $result = $this->booking->saveRecord($request, $booking);
            if(!empty($result)) {
                $dateOfTour = $this->dateOfTour->where('tour_id', $result->tour_id)->where('possible_date', $result->departure_date)->first();
                $current_people = $dateOfTour->people;
                $dateOfTour->update(['people' => $current_people + $result->number_people]);
                return redirect()->route('processTransaction', ['totalPrice' => $totalPrice, 'bookingID' => $result->id]);
            }
            return redirect()->back()->with('error', 'Booking fail');
        } else {
            return redirect()->route('home')->with('error', 'Booking fail');
        }
    }

    public function checkMax(Request $request) {
        $date = $this->dateOfTour->where('tour_id', $request->tour_id)->where(DateOfTour::raw("DATE_FORMAT(possible_date,'%Y-%m-%d')"), $request->date)->first();
        $tour = $this->tour->findOrFail($request->tour_id);
        $max = $tour->max_people - $date->people;
        return $max;
    }

    public function updateStatusPayment(Request $request, $id)
    {
        $this->booking->changeStatusPaymentAjax($request, $id);
        $this->booking->changeStatus(4, $id);
    }

    public function update(Request $request, $id)
    {
        try {
            $booking = $this->booking->findOrFail($id);
            $old_status = $booking->status;
            $old_payment_status = $booking->payment_status;
            $this->booking->changeStatus($request->status, $id);
            $this->booking->changePaymentStatus($request->payment_status, $id);
            if ($request->status == 2 && $request->payment_status == 2 && ( $old_status != $request->status || $old_payment_status != $request->payment_status )) {
                $this->booking->sendMailBooking($id);
            };
            if ($request->status == 4) {
                $this->booking->sendMailReview($id);
            }
            if ($request->status == 3) {
                $dateOfTour = $this->dateOfTour->where('tour_id', $booking->tour_id)->where('possible_date', $booking->departure_date)->first();
                $current_people = $dateOfTour->people;
                $dateOfTour->update(['people' => $current_people - $booking->number_people]);
            }
            return redirect()->route("booking.index")->with('message', 'Update status booking successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Update status booking failed');
        }
    }
}
