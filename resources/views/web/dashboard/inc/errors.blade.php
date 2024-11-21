@if (session('errors'))
<script>
    toastr.error("{{ session('errors') }}");
</script>
@endif