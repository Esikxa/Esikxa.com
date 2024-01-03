@if (Session::has('info'))
    @push('scripts')
        <script>
            $(document).ready(function() {
                showToast('info', "{!! Session::get('info') !!}");
            });
        </script>
    @endpush
@endif

@if (Session::has('success'))
    @push('scripts')
        <script>
            $(document).ready(function() {
                showToast('success', "{!! Session::get('success') !!}");
            });
        </script>
    @endpush
@endif

@if (Session::has('warning'))
    @push('scripts')
        <script>
            $(document).ready(function() {
                showToast('warning', "{!! Session::get('warning') !!}");
            });
        </script>
    @endpush
@endif

@if (Session::has('error'))
    @push('scripts')
        <script>
            $(document).ready(function() {
                showToast('error', "{!! Session::get('error') !!}");
            });
        </script>
    @endpush
@endif
@if ($errors->any())

    @foreach ($errors->all() as $error)
        @push('scripts')
            <script>
                showToast('error', "{{ $error }}");
            </script>
        @endpush
    @endforeach
@endif
