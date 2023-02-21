<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') &mdash; Discusie</title>

    <!-- General CSS Files -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/prismjs/themes/prism.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
    <!-- General CSS Files -->

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/components.css') }}">

    <!-- Start GA -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->

    <!-- Startup Library -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <!-- Startup Library -->

    <!-- Scripts For Startup -->
    <script>
        var token;

        $(document).ready(function () {
            token = $('meta[name="csrf-token"]').attr('content')
        });
    </script>
    <!-- Scripts For Startup -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('components.footer')
        </div>
        <div
            class="modal fade"
            tabindex="-1"
            role="dialog"
            id="confirmation"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title confirmation-title"></h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body confirmation-body">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-danger confirmation" value="true">Delete</button>
                        <button type="button" class="btn btn-warning confirmation">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    <!-- General JS Scripts -->

    <!-- Spesific Page JS -->
    @stack('scripts')
    <!-- Spesific Page JS -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- Template JS File -->

    <!-- Setup JS -->
    <script>
        $(document).ready(function () {
            /**
             * Notification
             * @return void
             */
            @if(session('errors'))
                iziToast.{{session('errors')->first('type')}}({
                    position: 'topCenter',
                    layout: '2',
                    title: "{{ session('errors')->first('title') }}",
                    message: "{{ session('errors')->first('message') }}",
                });
            @endif
        });
    </script>
    <!-- Setup JS -->
</body>

</html>
