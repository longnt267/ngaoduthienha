{{--  @if ($data->payment_status == 'unpaid')
    @if ($data->status == 'Cancel')
        <strong>unpaid</strong>
    @else
        <div class="status-{{ $data->id }}">
            <input type="checkbox" id="{{ 'toggle-' . $data->id }}" class="toggle-status" data-id="{{ $data->id }}">
        </div>
    @endif        
@else
    <strong>paid</strong>
@endif

<script src="{{ asset('js/config.js') }}"></script>
<script>
    $(document).ready(function() {
        var toggle = $('#toggle-{{ $data->id }}');
        var url = '{{ $url }}';
        if (toggle.length) {
            var id = toggle.data('id');
            toggle.click(function() {
                changeStatusPayment(id, url);
            })
        }
    })
</script>  --}}

@if ($data->payment_status == 'unpaid')
    <strong style="color: red;">Unpaid</strong>
@else
    <strong style="color: green;">Paid</strong>
@endif