<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Fontawsome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Required for toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .bg-primary {
            background-color: #003b42 !important;
        }

        .btn-primary {
            background-color: #003b42 !important;
            border-color: #003b42 !important;
        }

        .btn-primary:hover {
            background-color: #003b42e3 !important;
        }

        /* 🔽 Pagination Active Link Styling */
        .page-item.active .page-link,
        .page-link.active {
            background-color: #003b42 !important;
            border-color: #003b42 !important;
            color: #fff !important;
        }
        
        .page-link {
            color: #003b42 !important;
        }

    </style>
</head>
<body>
    @include('partials.header')

    <main class="container py-4">
        @if(session('success'))
            <script>
                toastr.success('{{ session('success') }}');
            </script>
        @endif

        @if(session('error'))
            <script>
                toastr.error('{{ session('error') }}');
            </script>
        @endif
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
