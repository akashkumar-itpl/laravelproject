<script src="{{ URL::asset('front/js/flash.js') }}"></script>

@if ($message = Session::get('success'))
    <script>
        Toast.fire({
            icon: 'success',
            title: ' {{ $message }}'
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        Toast.fire({
            icon: 'error',
            title: ' {{ $message }}'
        });
    </script>
@endif

@if ($message = Session::get('warning'))
    <script>
        Toast.fire({
            icon: 'success',
            title: ' {{ $message }}'
        });
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
        Toast.fire({
            icon: 'success',
            title: ' {{ $message }}'
        });
    </script>
@endif
