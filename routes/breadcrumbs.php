<?php 

// Dashboard 
Breadcrumbs::for('dashboard', function($trail) {
    $trail->push('Dashboard', route('admin.home'));
});

// --------------------------------------------------------------------------------
// Dashboard > Destination
Breadcrumbs::for('destination', function($trail) {
    $trail->parent('dashboard');
    $trail->push('Destination', route('destination.index'));
});

// Dashboard > Destination > Create Destination
Breadcrumbs::for('create_destination', function($trail) {
    $trail->parent('destination');
    $trail->push('Create', route('destination.create'));
});

// Dashboard > Destination > Edit Destination > id
Breadcrumbs::for('edit_destination', function($trail, $id) {
    $trail->parent('destination');
    $trail->push('Edit', route('destination.edit', $id));
});
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// Dashboard > TypeTour
Breadcrumbs::for('type_tour', function($trail) {
    $trail->parent('dashboard');
    $trail->push('Type Of Tour', route('type_tour.index'));
});

// Dashboard > TypeTour > Create Typetour
Breadcrumbs::for('create_type_tour', function($trail) {
    $trail->parent('type_tour');
    $trail->push('Create', route('type_tour.create'));
});

// Dashboard > TypeTour > Edit TypeTour > id
Breadcrumbs::for('edit_type_tour', function($trail, $id) {
    $trail->parent('type_tour');
    $trail->push('Edit', route('type_tour.edit', $id));
});
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// Dashboard > Tour
Breadcrumbs::for('tour', function($trail) {
    $trail->parent('dashboard');
    $trail->push('Tour', route('tour.index'));
});

// Dashboard > Tour > Create Tour
Breadcrumbs::for('create_tour', function($trail) {
    $trail->parent('tour');
    $trail->push('Create', route('tour.create'));
});

// Dashboard > Tour > Edit Tour
Breadcrumbs::for('edit_tour', function($trail, $id) {
    $trail->parent('tour');
    $trail->push('Edit', route('tour.edit', $id));
});

// Dashboard > Tour > Albums
Breadcrumbs::for('album_tour', function($trail, $id) {
    $trail->parent('tour');
    $trail->push('Album Tour-'.$id, route('album.index', $id));
});

// Dashboard > Tour > Itinerary
Breadcrumbs::for('itinerary', function($trail, $id) {
    $trail->parent('tour');
    $trail->push('Itinerary Tour', route('itinerary.index', $id));
});

// Dashboard > Tour > Itinerary > Create
Breadcrumbs::for('create_itinerary', function($trail, $id) {
    $trail->parent('itinerary', $id);
    $trail->push('Create Itinerary', route('itinerary.create', $id));
});

// Dashboard > Tour > Itinerary > Edit
Breadcrumbs::for('edit_itinerary', function($trail, $tourId, $id) {
    $trail->parent('itinerary', $tourId);
    $trail->push('Edit Itinerary', route('itinerary.edit', ['tour_id' => $tourId, 'id' => $id]));
});

// Dashboard > Tour > Itinerary > Itinerary Detail
Breadcrumbs::for('iti_detail', function($trail, $tour, $itineraryId){
    $trail->parent('itinerary', $tour->id);
    $trail->push('Itineray Detail - Tour: '.$tour->title, route('iti_detail.index', $itineraryId));
});

// Dashboard > Tour > Itinerary > Itinerary Detail > Create
Breadcrumbs::for('create_iti_detail', function($trail, $tour, $itineraryId) {
    $trail->parent('iti_detail', $tour, $itineraryId);
    $trail->push('Create Itinerary Detail', route('iti_detail.create', ['itinerary_id' => $itineraryId]));
});

// Dashboard > Tour > Itinerary > Itinerary Detail > Edit
Breadcrumbs::for('edit_iti_detail', function($trail, $tour, $itineraryId, $id) {
    $trail->parent('iti_detail', $tour, $itineraryId);
    $trail->push('Edit Itinerary Detail', route('iti_detail.edit', ['itinerary_id' => $itineraryId, 'id' => $id]));
});

// Dashboard > Tour > Faq
Breadcrumbs::for('faq', function($trail, $tourId) {
    $trail->parent('tour');
    $trail->push('Faq', route('faq.index', $tourId));
});

// Dashboard > Tour > Faq > Create
Breadcrumbs::for('create_faq', function($trail, $tourId) {
    $trail->parent('faq', $tourId);
    $trail->push('Create Faq', route('faq.create', $tourId));
});

// Dashboard > Tour > Faq > Edit
Breadcrumbs::for('edit_faq', function($trail, $tourId, $id) {
    $trail->parent('faq', $tourId);
    $trail->push('Edit Faq', route('faq.edit', ['tour_id' => $tourId, 'id' => $id]));
});
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// Dashboard > Booking
Breadcrumbs::for('booking', function($trail) {
    $trail->parent('dashboard');
    $trail->push('Booking', route('booking.index'));
});

Breadcrumbs::for('booking_detail', function($trail) {
    $trail->parent('booking');
    $trail->push('Detail');
});