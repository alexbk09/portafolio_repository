<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Cliente') - Keiber Paez</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3B82F6;
            --secondary-color: #1E40AF;
        }
        
        .bg-primary { background-color: var(--primary-color); }
        .text-primary { color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }
        .hover\:bg-secondary:hover { background-color: var(--secondary-color); }
        .hover\:text-primary:hover { color: var(--primary-color); }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <x-navigation.client-nav />
    
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Scripts -->
    @stack('scripts')
</body>
</html>

