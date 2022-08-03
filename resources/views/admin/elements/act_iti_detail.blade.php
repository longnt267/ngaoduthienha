{{--  <a href="{{ route('iti_detail.edit', ['itinerary_id' => $itineraryId, 'id' => $id]) }}" data-url="{{ $id }}" class="btn btn-success"></a>  --}}
<div 
    class="btn btn-success" 
    data-url-update="{{ route('iti_detail.update', ['itinerary_id' => $itineraryId, 'id' => $id]) }}"
    data-url-data="{{ route('iti_detail.edit', ['itinerary_id' => $itineraryId, 'id' => $id]) }}"
    onclick="getData($(this))"
>
    <i class="fal fa-edit"></i>
</div>
<button class="btn btn-danger" onclick="confirmDelete('{{ route("iti_detail.destroy", $id) }}')">
    <i class="fal fa-trash-alt"></i>
</button>
