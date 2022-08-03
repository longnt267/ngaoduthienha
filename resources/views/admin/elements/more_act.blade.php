<div class="d-flex justify-content-center">
    <span>
        <a href="{{ route('faq.index', $id) }}" class="mb-2 mr-2 btn btn-primary">Faqs</a>
        <a href="{{ route('album.index', $id) }}" class="btn btn-primary">Albums</a>
    </span>
    <span>
        <a href="{{ route('itinerary.index', $id) }}" class="mb-2 mr-2 btn btn-primary">Itineraries</a>
        <a href="{{ route('review.index', $id) }}" class="btn  btn-primary">Reviews</a>
    </span>
</div>
