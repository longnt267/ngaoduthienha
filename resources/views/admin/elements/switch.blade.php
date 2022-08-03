@if ($data->status == 1)
    <input type="checkbox" id="{{ 'toggle-' . $data->id }}" class="toggle-status" data-id="{{ $data->id }}"
        value="{{ $data->status }}" checked>
@else
    <input type="checkbox" id="{{ 'toggle-' . $data->id }}" class="toggle-status" data-id="{{ $data->id }}"
        value="{{ $data->status }}">
@endif

<script src="{{ asset('js/config.js') }}"></script>
<script>
    $(document).ready(function() {
        var toggle = $('#toggle-{{ $data->id }}');
        var url = '{{ $url }}';
        if (toggle.length) {
            var id = toggle.data('id');
            toggle.click(function() {
                let status = toggle.val();
                if (status == 1) toggle.val(2);
                else toggle.val(1);
                status = toggle.val();
                changeStatusAjax(url, status);
            })
        }
    })
</script>

