@if ($data->trending == 1)
    <input type="checkbox" id="{{ 'toggle-trending-' . $data->id }}" class="toggle-status" data-id="{{ $data->id }}"
        value="{{ $data->trending }}" checked>
@else
    <input type="checkbox" id="{{ 'toggle-trending-' . $data->id }}" class="toggle-status" data-id="{{ $data->id }}"
        value="{{ $data->trending }}">
@endif

<script src="{{ asset('js/config.js') }}"></script>
<script>
    $(document).ready(function() {
        var toggle = $('#toggle-trending-{{ $data->id }}');
        var url = '{{ $url }}';
        if (toggle.length) {
            var id = toggle.data('id');
            toggle.click(function() {
                let status = toggle.val();
                if (status == 1) toggle.val(2);
                else toggle.val(1);
                status = toggle.val();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        trending: status,
                    },
                })
                .done(function() {
                    toastr.success("Trending changed successfully");
                })
                .fail(function() {
                    toastr.error("Trending changed failed");
                });
            })
        }
    })
</script>
