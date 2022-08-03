<a href="{{ route('tour.edit', $id) }}" class="btn btn-success"><i class="fal fa-edit"></i> Edit</a>

<button class="btn btn-danger" onclick="confirmDelete('{{ route("tour.destroy", $id) }}')">
    <i class="fal fa-trash-alt"></i> Delete
</button>


