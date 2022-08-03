@extends('layouts.admin')

@section('title', 'Booking Detail')
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Booking Detail</h3>
        {{ Breadcrumbs::render('booking_detail') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h3 class="d-flex justify-content-center" style="padding-top: 12px;">Booking Detail</h3>
    </div>

    <div class="wrap-info">
        <div class="bk-header">Customer Information:</div>
        <div class="row info-content">
            <div class="col-sm-6">
                <div class="wr-field">
                    <label>Fullname:</label>
                    <span>{{ $booking->first_name.' '.$booking->last_name }}</span>
                </div>
                <div class="wr-field">
                    <label>Phone:</label>
                    <span>{{ $booking->phone }}</span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="wr-field">
                    <label>Email: </label>
                    <span>{{ $booking->email }}</span>
                </div>

                <div class="wr-field">
                    <label>Address: </label>
                    @if (empty($booking->address))
                        <span>.......</span>
                    @else
                        <span>{{ $booking->address }}</span>
                    @endif
                </div>
            </div>

            
            <div class="col-sm-12">
                <div class="wr-field">
                    <label>Special Requirement:</label>
                </div>
                <textarea style="width: 100%;">
                    @if (!empty($booking->note))
                        {{ $booking->note }}
                    @endif
                </textarea>
            </div>
            
        </div>
    </div>
    
    <div class="wrap-info">
        <div class="bk-header">Other Information:</div>
        <div class="row info-content">
            <div class="col-sm-6">
                <div class="wr-field">
                    <label>City:</label>
                    @if (empty($booking->city))
                        <span>.......</span>
                    @else
                        <span>{{ $booking->city }}</span>
                    @endif
                </div>
                <div class="wr-field">
                    <label>Region:</label>
                    @if (empty($booking->region))
                        <span>.......</span>
                    @else
                        <span>{{ $booking->region }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="wr-field">
                    <label>Zip code:</label>
                    @if (empty($booking->zip_code))
                        <span>.......</span>
                    @else
                        <span>{{ $booking->zip_code }}</span>
                    @endif
                </div>
                <div class="wr-field">
                    <label>Country:</label>
                    @if (empty($booking->country))
                        <span>.......</span>
                    @else
                        <span>{{ $booking->country }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="wrap-table-bk">
        <div class="bk-header">Booking detail:</div>
        <div class="table-responsive">
            <table class="table table-striped display" style="width:100%" id="datatable">
                <thead>
                    <tr>
                        <th>Booking Code</th>
                        <th>Tour</th>
                        <th>Price(per 1 person)</th>
                        <th>Number people</th>
                        <th>Departure date</th>
                        <th>Duration</th>
                        <th>Total price</th>
                        <th>Payment method</th>
                        <th>Payment status</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $booking->booking_code }}</th>
                        <th>{{ $tour->title }}</th>
                        <th>{{ $tour->price }}</th>
                        <th>{{ $booking->number_people }}</th>
                        <th>{{ $booking->departure_date }}</th>
                        <th>{{ $tour->duration }}</th>
                        <th>{{ $booking->total_price }}</th>
                        <th>{{ $booking->payment_method }}</th>
                        <th>{{ $booking->payment_status }}</th>
                        <th>{{ $booking->status }}</th>
                    </tr>
                </tbody>
            </table>
        </div>    
    </div>

    @if ($booking->status !== 'Completed')
    {{--  <div class="wrap-status" style="width: 97%; margin-left: 12px;">
        <form action="{{ route('booking.status', $booking->id) }}" method="post">
            @csrf
            <div class="col-sm-4">
                <label>Update status:</label>
                <select name="status" class="select2">
                    <option value="" selected disabled>Choose status</option>                  
                    <option value="2">confirmed</option>
                    <option value="3">cancel</option>
                    @if ($booking->payment_status == 'paid')
                        <option value="4">completed</option>
                    @endif
                </select>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <input type="submit" class="btn btn-success" style="width: 200px; margin: 20px 0 20px 0;"  value="Update">
            </div>
        </form>
    </div>  --}}
    @endif
@endsection

@section('script')
   
@endsection
