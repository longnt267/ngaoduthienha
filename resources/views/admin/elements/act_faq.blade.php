<a href="{{ route('faq.edit', ['tour_id' => $tourId, 'id' => $id]) }}" class="btn btn-success"><i class="fal fa-edit"></i> Edit</a>

<button class="btn btn-danger"  onclick="confirmDelete('{{ route("faq.destroy", $id) }}')">
    <i class="fal fa-trash-alt"></i> Delete
</button>


