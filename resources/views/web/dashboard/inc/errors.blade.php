@if (session('error'))
<script>
    toastr.error("{{ session('error') }}");
</script>
@endif