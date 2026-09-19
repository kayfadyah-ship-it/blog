<nav class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-bold text-xl text-blue-900">
            Kayfa Dyah<span class="text-blue-900"></span>
        </a>
        <div class="flex space-x-6 text-sm font-medium">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-900 font-semibold' : 'text-slate-600 hover:text-gray-400' }} transition">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-blue-900 font-semibold' : 'text-slate-600 hover:text-gray-400' }} transition">About</a>
            <a href="{{ route('education') }}" class="{{ request()->routeIs('education') ? 'text-blue-900 font-semibold' : 'text-slate-600 hover:text-gray-400' }} transition">Education</a>
            <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects') ? 'text-blue-900 font-semibold' : 'text-slate-600 hover:text-gray-400' }} transition">Projects</a>
        </div>
    </div>
</nav>