<script>
    @if($message = Session::get('success'))
    success('{{ $message }}', () => {});
    @endif

    @if($message = Session::get('error'))
    error_alert('{{ $message }}', () => {});
    @endif

    @if($message = Session::get('warning'))
    warning('{{ $message }}', () => {});
    @endif

    @if($message = Session::get('info'))
    info_alert('{{ $message }}', () => {});
    @endif
</script>