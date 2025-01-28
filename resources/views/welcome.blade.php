<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>E-Learning Platform</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50 transition-all duration-300"
         x-data="{ scrolled: false }"
         @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">EduPlatform</a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-blue-600 nav-link">Home</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 nav-link">Courses</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 nav-link">About</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 nav-link">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="bg-transparent hover:bg-blue-50 text-blue-600 font-semibold py-2 px-4 border border-blue-600 rounded btn-hover">
                        Login
                    </button>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded btn-hover">
                        Sign Up
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="pt-24 bg-gradient-to-b from-blue-50 to-white"
         x-data="{ shown: false }"
         x-init="setTimeout(() => shown = true, 100)"
         x-show="shown"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-12"
         x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl font-extrabold text-gray-900 mb-6">
                    Transform Your Future with Online Learning
                </h1>
                <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                    Access world-class education and skills development resources to advance your career and achieve your goals.
                </p>
                <div class="space-x-4">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg btn-hover">
                        Get Started
                    </button>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-8 rounded-lg text-lg btn-hover">
                        View Courses
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Why Choose Us</h2>
                <p class="mt-4 text-gray-600">Discover the advantages of learning with our platform</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 feature-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Expert Instructors</h3>
                    <p class="text-gray-600">Learn from industry professionals and experienced educators</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 delay-100 feature-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Flexible Learning</h3>
                    <p class="text-gray-600">Study at your own pace and access content anytime, anywhere</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 delay-200 feature-card">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Career Support</h3>
                    <p class="text-gray-600">Get guidance and resources to advance your career</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">EduPlatform</h3>
                    <p class="text-gray-400">Empowering learners worldwide</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Courses</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-base font-semibold mb-3">Support</h4>
                    <ul class="space-y-1.5 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-base font-semibold mb-3">Connect</h4>
                    <ul class="space-y-1.5 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Twitter</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">LinkedIn</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Facebook</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-400">
                <p>&copy; 2024 EduPlatform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Buttons - Add hover effects -->
    <style>
        .btn-hover {
            @apply transition-all duration-300 transform hover:scale-105;
        }

        .nav-link {
            @apply relative;
        }

        .nav-link::after {
            @apply content-[''] absolute left-0 bottom-0 w-0 h-0.5 bg-blue-600 transition-all duration-300;
        }

        .nav-link:hover::after {
            @apply w-full;
        }

        .feature-card {
            @apply opacity-0 transform translate-y-8;
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Add scroll reveal effect -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeIn');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card').forEach((element) => {
            observer.observe(element);
        });
    });
    </script>
</body>
</html>
