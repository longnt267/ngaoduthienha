<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Session;
use Carbon\Carbon;
use App\Models\Mail;
use App\Models\Tour;
use App\Jobs\SendReviewJob;
class Booking extends Model
{
    use HasFactory;

    const BOOKING_COMPLETED = 4;
    const BOOKING_CONFIRM = 2;
    const BOOKING_CANCELD = 3;
    const PAID = 2;
    const UNPAID = 1;

    protected $guarded = ['id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function getDataAjax($request)
    {
        $data = $this->select('*')->latest();
        if($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    $this->customFilterDataTable($query, $request);
                })
                ->addColumn('fullname', function($data) {
                    $fullname = $data->first_name.' '.$data->last_name;
                    return $fullname;
                })
                ->addColumn('status', function($data) {
                    $data = $this->formatBookingData($data);
                    return $data->status;
                })
                ->addColumn('payment_status', function($data) {
                    $url = route('booking.status_payment', $data->id);
                    return view('admin.elements.status_payment', compact('data', 'url'));
                })
                ->addColumn('action', function($data) {
                    return view('admin.elements.act_booking', ['id' => $data->id]);
                })
                ->rawColumns(['fullname', 'status', 'action', 'payment_status'])
                ->make(true);
        }
    }

    public function customFilterDataTable($query, $request)
    {
        if(!empty($request->search)) {
            $query->where('booking_code', 'like', "%$request->search%")
                  ->orWhere('first_name', 'like', "%$request->search%")
                  ->orWhere('last_name', 'like', "%$request->search%")
                  ->orWhere('phone', $request->search)
                  ->orWhere('email', $request->search);      
        }
        if(!empty($request->status)) {
            $query->where('status', $request->status);
        }
        if(!empty($request->departure_date)) {
            $query->where('departure_date', $request->departure_date);
        }
        if(!empty($request->payment_status)) {
            $query->where('payment_status', $request->payment_status);
        }
    }

    public function createBookingSession($request)
    {
        $this->resetSession();
        $request->session()->put('Booking', $request->all());
    }

    public function resetSession()
    {
        if(Session('Booking')) {
            session()->forget('Booking');
        }
    }

    public function saveRecord($request, $booking)
    {
        try {
            $departure_date = Carbon::create($booking['departure_date']);
            $request->request->add(['departure_date' => $departure_date]);
            $request->request->add(['tour_id' => $booking['tour_id']]);
            $request->request->add(['number_people' => $booking['number_people']]);
            $request->request->add(['total_price' => $booking['total_price']]);
            $model = $this->create($request->all());
            $this->resetSession();
            return $model;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function sendMailBooking($id)
    {
        $booking = $this->findOrFail($id);
        $booking = $this->formatBookingData($booking);
        $mail = new Mail($booking);
        $mail->sendMail();
    }

    public function getBookingById($id)
    {
        return $this->findOrFail($id);
    }

    public function sendMailReview($id) {
        $booking = $this->findOrFail($id);
        
        $token = base64_encode(json_encode([
            "booking_id" => $id,
            "email" => $booking->email
        ]));
        $url = route('review.viewReview', $token);
        dispatch(new SendReviewJob($booking, $url));
    }

    public function formatBookingData($booking)
    {
        $booking->departure_date = Carbon::createFromFormat('Y-m-d', $booking['departure_date'])->format('m/d/Y');
        switch ($booking->status) {
            case '2':
                $booking->status = 'Confirmed';
                break;
            case '3':
                $booking->status = 'Cancel';
                break;
            case '4':
                $booking->status = 'Completed';
                break;    
            default:
                $booking->status = 'New';
                break;
        }
        switch ($booking->payment_method) {
            case '1':
                $booking->payment_method = 'Credit Card';
                break;
            case '2':
                $booking->payment_method = 'Paypal';
                break;
            default:
                $booking->payment_method = 'Pay in cash';
                break;
        }
        switch ($booking->payment_status) {
            case '2':
                $booking->payment_status = 'paid';
                break;
            default:
                $booking->payment_status = 'unpaid';
                break;
        }
        return $booking;
    }

    public function changeStatusPaymentAjax($request, $id) 
    {
        $booking = $this->getBookingById($id);
        if($request->ajax()) {
            $booking->payment_status = $request->status;
            $booking->save();
        } 
    }

    public function changeStatusPayment($status, $id)
    {
        $booking = $this->getBookingById($id);
        $booking->payment_status = $status;
        $booking->save();
    }

    public function changeStatus($status, $id)
    {
        $booking = $this->getBookingById($id);
        $booking->status = $status;
        $booking->save();

        if ($status == 4) {
            
        }
    }

    public function changePaymentStatus($payment_status, $id)
    {
        $booking = $this->getBookingById($id);
        $booking->payment_status = $payment_status;
        $booking->save();
    }

    public function getTotalBooking() {
        return $this->where('payment_status', 2)->count();
    }

    public function totalPay() {
        return $this->where('payment_status', 2)->sum('total_price');
    }

    public function countProfitsInMonth($date) {
        return $this->where('payment_status', 2)->where(Booking::raw("DATE_FORMAT(created_at,'%m-%Y')"), $date)->sum('total_price');
    }

    public function countBookingInMonth($date) {
        return $this->where('payment_status', 2)->where(Booking::raw("DATE_FORMAT(created_at,'%m-%Y')"), $date)->count();
    }

    public function countTours($date) {
        return Tour::where(Booking::raw("DATE_FORMAT(created_at,'%m-%Y')"), $date)->count();
    }

    public function countContactInMonth($date) {
        return Contact::where(Booking::raw("DATE_FORMAT(created_at,'%m-%Y')"), $date)->count();
    }

    public function getDataChart($request) {
        $startArray = Carbon::today()->firstOfMonth()->subMonth(5);
        $arrayDate = [];
        $profits = [];
        $bookings = [];
        $contacts = [];
        $tours = [];
        for ($i = 0; $i < 6; $i++) {
            $arrayDate[$i] = $startArray->format('m-Y');
            $startArray->addMonth(1);
        }
        
        foreach ($arrayDate as $key => $date) {
            $profits[$key] = $this->countProfitsInMonth($date);
            $bookings[$key] = $this->countBookingInMonth($date);
            $contacts[$key] = $this->countContactInMonth($date);
            $tours[$key] = $this->countTours($date) + ($tours[$key - 1] ?? 0);
        }

        return response()->json([
            'arrayDate' => $arrayDate,
            'profits' => $profits,
            'bookings' => $bookings,
            'contacts' => $contacts,
            'tours' => $tours,
        ]);
    }
}
