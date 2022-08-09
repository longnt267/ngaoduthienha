<?php

use App\Http\Controllers\Admin\ItineraryDetailController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\TypeTourController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route client
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/thanks', [HomeController::class, 'thanks'])->name('thanks');
Route::get('/review_success', [HomeController::class, 'review_success'])->name('review_success');
Route::get('/review_fail', [HomeController::class, 'review_error'])->name('review_error');
Route::get('/thanks', [HomeController::class, 'thanks'])->name('thanks');
Route::get('/search', [HomeController::class, 'homeSearch'])->name('home.search');
Route::get('/tours', [HomeController::class, 'tour'])->name('tour');
Route::get('/tours/{slug}', [HomeController::class, 'tourDetail'])->name('tour_detail');
Route::get('/destination/{destination_id}', [HomeController::class, 'tourByDes'])->name('tourByDes');

Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/bookings/session', [BookingController::class, 'addBooking'])->name('booking.session');
Route::post('/bookings/store', [BookingController::class, 'store'])->name('booking.store');

Route::get('/contacts', [HomeController::class, 'contact'])->name('contact');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contact.store');

Route::post('/reviews/store/{booking_id}', [ReviewController::class, 'store'])->name('review.store');
Route::post('/reviews/{tourId}/fetch-data', [ReviewController::class, 'fetchData'])->name('review.fetch');

Route::get('/reviews/{token}', [ReviewController::class, 'viewReview'])->name('review.viewReview');

// Route thanh toan paypal
// Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

//article
Route::get('/about_us', [HomeController::class, 'getAboutUs'])->name('about_us');
Route::get('/term', [HomeController::class, 'getTerm'])->name('term');
Route::get('/privacy_policy', [HomeController::class, 'getPrivacyPolicy'])->name('privacyPolicy');
Route::get('/guest_policy', [HomeController::class, 'getGuestPolicy'])->name('guestPolicy');

// Route authenticate admin
Auth::routes(['register' => false]);

// Route admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::post('/', [AdminController::class, 'getDataChart'])->name('admin.getDataChart');
    
    // Destination
    Route::group(['prefix' => 'destinations'], function() {
        Route::get('/', [DestinationController::class, 'index'])->name('destination.index');
        Route::post('/data', [DestinationController::class, 'getData'])->name('destination.data');
        Route::get('/create', [DestinationController::class, 'create'])->name('destination.create');
        Route::post('/store', [DestinationController::class, 'store'])->name('destination.store');
        Route::get('/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit');
        Route::put('/{id}/update', [DestinationController::class, 'update'])->name('destination.update');
        Route::post('/{id}/status', [DestinationController::class, 'updateStatus'])->name('destination.status');
        Route::delete('/{id}/delete', [DestinationController::class, 'destroy'])->name('destination.destroy');
    });

    // Type of tours
    Route::group(['prefix' => 'type-tours'], function() {
        Route::get('/', [TypeTourController::class, 'index'])->name('type_tour.index');
        Route::post('/data', [TypeTourController::class, 'getData'])->name('type_tour.data');
        Route::get('/create', [TypeTourController::class, 'create'])->name('type_tour.create');
        Route::post('/store', [TypeTourController::class, 'store'])->name('type_tour.store');
        Route::get('/{id}/edit', [TypeTourController::class, 'edit'])->name('type_tour.edit');
        Route::put('/{id}/update', [TypeTourController::class, 'update'])->name('type_tour.update');
        Route::post('/{id}/status', [TypeTourController::class, 'updateStatus'])->name('type_tour.status');
        Route::delete('/{id}/delete', [TypeTourController::class, 'destroy'])->name('type_tour.destroy');
    });

    // Tour
    Route::group(['prefix' => 'tours'], function() {
        Route::get('/', [TourController::class, 'index'])->name('tour.index');
        Route::post('/data', [TourController::class, 'getData'])->name('tour.data');
        Route::get('/create', [TourController::class, 'create'])->name('tour.create');
        Route::post('/store', [TourController::class, 'store'])->name('tour.store');
        Route::get('/{id}/edit', [TourController::class, 'edit'])->name('tour.edit');
        Route::put('/{id}/update', [TourController::class, 'update'])->name('tour.update');
        Route::post('/{id}/status', [TourController::class, 'updateStatus'])->name('tour.status');
        Route::delete('/{id}/delete', [TourController::class, 'destroy'])->name('tour.destroy');

        // Album Tour
        Route::delete('/album/{id}/delete', [AlbumController::class, 'destroy'])->name('album.destroy');
        Route::group(['prefix' => '/{tour_id}/albums'], function() {
            Route::get('/', [AlbumController::class, 'index'])->name('album.index');
            Route::post('/upload', [AlbumController::class, 'uploadToAlbum'])->name('album.upload');
        });

        // Itinerary Tour
        Route::delete('itineraries/{id}/delete', [ItineraryController::class, 'destroy'])->name('itinerary.destroy');
        Route::group(['prefix' => '/{tour_id}/itineraries'], function() {
            Route::get('/', [ItineraryController::class, 'index'])->name('itinerary.index');
            Route::post('/data', [ItineraryController::class, 'getData'])->name('itinerary.data');
            Route::get('/create', [ItineraryController::class, 'create'])->name('itinerary.create');
            Route::post('/store', [ItineraryController::class, 'store'])->name('itinerary.store');
            Route::get('/{id}/edit', [ItineraryController::class, 'edit'])->name('itinerary.edit');
            Route::post('/{id}/update', [ItineraryController::class, 'update'])->name('itinerary.update');
        });
        
        // Faqs
        Route::delete('/faqs/{id}/delete', [FaqController::class, 'destroy'])->name('faq.destroy');
        Route::post('/faqs/{id}/status', [FaqController::class, 'updateStatus'])->name('faq.status');
        Route::group(['prefix' => '/{tour_id}/faqs'], function() {
            Route::get('/', [FaqController::class, 'index'])->name('faq.index');
            Route::post('/data', [FaqController::class, 'getData'])->name('faq.data');
            Route::get('/create', [FaqController::class, 'create'])->name('faq.create');
            Route::post('/store', [FaqController::class, 'store'])->name('faq.store');
            Route::get('/{id}/edit', [FaqController::class, 'edit'])->name('faq.edit');
            Route::put('/{id}/update', [FaqController::class, 'update'])->name('faq.update');
        });

        // Review
        Route::group(['prefix' => '/{tour_id}/reviews'], function() {
            Route::get('/', [ReviewController::class, 'index'])->name('review.index');
            Route::post('/data', [ReviewController::class, 'getData'])->name('review.data');
            Route::post('/{id}/status', [ReviewController::class, 'updateStatus'])->name('review.status');
        });
    });

    // Itinerary Detail
    Route::delete('/itinerary-details/{id}/delete', [ItineraryDetailController::class, 'destroy'])->name('iti_detail.destroy');
    Route::group(['prefix' => 'itineraries/{itinerary_id}/itinerary-details'], function() {
        Route::get('/', [ItineraryDetailController::class, 'index'])->name('iti_detail.index');
        Route::post('/data', [ItineraryDetailController::class, 'getData'])->name('iti_detail.data');
        Route::get('/create', [ItineraryDetailController::class, 'create'])->name('iti_detail.create');
        Route::post('/store', [ItineraryDetailController::class, 'store'])->name('iti_detail.store');
        Route::get('{id}/edit', [ItineraryDetailController::class, 'edit'])->name('iti_detail.edit');
        Route::post('{id}/update', [ItineraryDetailController::class, 'update'])->name('iti_detail.update');
    });
    
    // Contact 
    Route::group(['prefix' => 'contacts'], function() {
        Route::get('/', [ContactController::class, 'index'])->name('contact.index');
        Route::post('/data', [ContactController::class, 'getData'])->name('contact.data');
        Route::post('/{id}/status', [ContactController::class, 'updateStatus'])->name('contact.status');
        Route::delete('/{id}/delte', [ContactController::class, 'destroy'])->name('contact.destroy');
    });

    // Booking
    Route::group(['prefix' => 'bookings'], function() {
        Route::get('/', [BookingController::class, 'index'])->name('booking.index');
        Route::post('/data', [BookingController::class, 'getData'])->name('booking.data');
        Route::get('/{id}/detail', [BookingController::class, 'detail'])->name('booking.detail');
        Route::post('/{id}/update', [BookingController::class, 'update'])->name('booking.update');
        Route::post('/{id}/status-payment', [BookingController::class, 'updateStatusPayment'])->name('booking.status_payment');
    });

    // Article
    Route::group(['prefix' => 'articles'], function() {
        Route::get('/', [ArticleController::class, 'index'])->name('article.index');
        Route::post('/save', [ArticleController::class, 'saveData'])->name('article.save');
    });

});
