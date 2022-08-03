<a href="{{ route('iti_detail.index', $id) }}" class="btn btn-primary"><i class="fal fa-eye"></i></a>

<div 
    class="btn btn-success" 
    data-url-update="{{ route('itinerary.update', ['tour_id' => $tourId, 'id' => $id]) }}"
    data-url-data="{{ route('itinerary.edit', ['tour_id' => $tourId, 'id' => $id]) }}"
    onclick="getData($(this))"
>
    <i class="fal fa-edit"></i>
</div>

<button class="btn btn-danger" onclick="confirmDelete('{{ route("itinerary.destroy", $id) }}')">
    <i class="fal fa-trash-alt"></i>
</button>

