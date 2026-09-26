<header class="w-full border-b border-black bg-white">
    <div class="max-w-7xl mx-auto px-6 sm:px-12 py-5 flex justify-between items-center">
        <!-- Logo / Brand Name -->
        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-black no-underline">
            Kayfa Dyah
        </a>

        <nav class="flex items-center space-x-8 text-base font-normal">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#040084] font-medium' : 'text-black hover:text-[#040084]' }} transition">
                Home
            </a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#040084] font-medium' : 'text-black hover:text-[#040084]' }} transition">
                About
            </a>
            <a href="{{ route('education') }}" class="{{ request()->routeIs('education') ? 'text-[#040084] font-medium' : 'text-black hover:text-[#040084]' }} transition">
                Education
            </a>
            <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects*') ? 'text-[#040084] font-medium' : 'text-black hover:text-[#040084]' }} transition">
                Projects
            </a>
        </nav>
    </div>
</header>