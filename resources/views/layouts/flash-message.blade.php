<script>
    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-bottom-center",
    }

    @if (Session::has('message'))
        toastr.success("{{ session('message') }}");
    @endif

    // @if (Session::has('flashSuccess'))
    //     toastr.success("{{ session('flashSuccess') }}");
    // @endif

    @if (Session::has('errors'))
        toastr.error("エラーが発生しました");
    @endif

    // @if (Session::has('flashInfo'))
    //     toastr.info("{{ session('flashInfo') }}");
    // @endif

    // @if (Session::has('flashWarning'))
    //     toastr.warning("{{ session('flashWarning') }}");
    // @endif
</script>
