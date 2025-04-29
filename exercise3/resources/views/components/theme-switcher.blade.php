<div class="px-4 py-2" x-data="theme">
    <div class="flex flex-col space-y-1">
        <!-- Light Theme -->
        <button 
            @click="setTheme('light')" 
            class="flex items-center w-full px-2 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md"
            :class="{ 'bg-gray-100 dark:bg-gray-700': theme === 'light' }"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
            </svg>
            {{ __('messages.theme_light') }}
        </button>

        <!-- Dark Theme -->
        <button 
            @click="setTheme('dark')" 
            class="flex items-center w-full px-2 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md"
            :class="{ 'bg-gray-100 dark:bg-gray-700': theme === 'dark' }"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
            </svg>
            {{ __('messages.theme_dark') }}
        </button>

        <!-- System Theme -->
        <button 
            @click="setTheme('system')" 
            class="flex items-center w-full px-2 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md"
            :class="{ 'bg-gray-100 dark:bg-gray-700': theme === 'system' }"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
            </svg>
            {{ __('messages.theme_system') }}
        </button>
    </div>
</div>

@once
    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('theme', () => ({
                theme: localStorage.getItem('theme') || 'system',
                init() {
                    // Get initial theme from server
                    fetch('{{ route("theme.current") }}')
                        .then(response => response.json())
                        .then(data => {
                            this.theme = data.theme;
                            this.applyTheme(data.theme);
                        });

                    this.$watch('theme', value => {
                        this.applyTheme(value);
                    });

                    // Watch for system theme changes
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        if (this.theme === 'system') {
                            this.applyTheme('system');
                        }
                    });
                },
                setTheme(value) {
                    this.theme = value;
                    
                    // Save theme preference to server
                    fetch('{{ route("theme.switch") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ theme: value })
                    });
                },
                applyTheme(value) {
                    localStorage.setItem('theme', value);
                    if (value === 'dark' || (value === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }));
        });
    </script>
    @endpush
@endonce
