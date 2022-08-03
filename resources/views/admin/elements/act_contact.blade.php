<button type="button" class="btn btn-primary" id="btn-detail" data-toggle="modal" data-target="#modal-contact" data-url="{{ route('contact.status', $data->id) }}"><i class="fal fa-eye"></i></button>

<!-- Modal -->
<div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detail Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p><strong>Sender: </strong>{{ $data->name }}</p>
         <p><strong>Email: </strong>{{ $data->email }}</p>
         <p><strong>Phone: </strong>{{ $data->phone }}</p>
         <p><strong>Message:<br/></strong>{{ $data->message }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<button class="btn btn-danger" onclick="confirmDelete('{{ route("contact.destroy", $data->id) }}')">
    <i class="fal fa-trash-alt"></i>
</button>

<script>
     // change status ajax 
     var url = $('#btn-detail').data('url');
     $('#modal-contact').on('hidden.bs.modal', function() {
        changeStatusAjax(url);
     })
</script>