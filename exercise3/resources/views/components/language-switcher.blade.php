<!-- Language Switcher -->
<div class="space-y-1">
    <a href="/language/en" class="flex items-center px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out {{ app()->getLocale() == 'en' ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
        <span class="w-4 h-4 mr-2 flex items-center justify-center">
            @if(app()->getLocale() == 'en')
                <svg class="w-3 h-3 text-indigo-600 dark:text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            @endif
        </span>
        English
    </a>
    <a href="/language/pl" class="flex items-center px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out {{ app()->getLocale() == 'pl' ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
        <span class="w-4 h-4 mr-2 flex items-center justify-center">
            @if(app()->getLocale() == 'pl')
                <svg class="w-3 h-3 text-indigo-600 dark:text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            @endif
        </span>
        Polski
    </a>
    <a href="/language/tr" class="flex items-center px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out {{ app()->getLocale() == 'tr' ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
        <span class="w-4 h-4 mr-2 flex items-center justify-center">
            @if(app()->getLocale() == 'tr')
                <svg class="w-3 h-3 text-indigo-600 dark:text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            @endif
        </span>
        Türkçe
    </a>
</div>
