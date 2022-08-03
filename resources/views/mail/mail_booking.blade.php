
<div class="container">
    <h3>Thank you for booking a tour</h3>
    <div class="row">
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
    </div>
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%" id="datatable">
            <thead>
                <tr>
                    <th>Booking Code</th>
                    <th>Tour</th>
                    <th>Number people</th>
                    <th>Departure date</th>
                    <th>Duration</th>
                    <th>Total price</th>
                    <th>Payment method</th>
                    <th>Payment status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{ $booking->booking_code }}</th>
                    <th>{{ $booking->tour->title }}</th>
                    <th>{{ $booking->number_people }}</th>
                    <th>{{ $booking->departure_date }}</th>
                    <th>{{ $booking->tour->duration }}</th>
                    <th>{{ $booking->total_price }}</th>
                    <th>{{ $booking->payment_method }}</th>
                    <th>{{ $booking->payment_status }}</th>
                </tr>
            </tbody>
        </table>
    </div>  
</div>
