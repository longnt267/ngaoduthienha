<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;
use Session;

class BookingController extends Controller
{
    protected $booking;
    protected $tour;

    public function __construct(Booking $booking, Tour $tour)
    {
        $this->booking = $booking;
        $this->tour = $tour;
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
                return redirect()->route('processTransaction', ['totalPrice' => $totalPrice, 'bookingID' => $result->id]);
            }
            return redirect()->back()->with('error', 'Booking fail');
        } else {
            return redirect()->route('home')->with('error', 'Booking fail');
        }
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
            return redirect()->route("booking.index")->with('message', 'Update status booking successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Update status booking failed');
        }
    }
}
