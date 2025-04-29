<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
                $managedProjects = Auth::user()->projects()->with('members')->get();
                $memberProjects = Auth::user()->memberProjects;
                $recentProjects = $managedProjects->take(5);
            @endphp

            <!-- Analytics Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Projects -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('messages.total_projects') }}</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ $managedProjects->count() + $memberProjects->count() }}
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">+12.5%</div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm ml-2">{{ __('messages.from_last_month') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Projects Managed -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('messages.projects_managed') }}</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ $managedProjects->count() }}
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">+5.2%</div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm ml-2">{{ __('messages.from_last_month') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Team Collaborations -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('messages.team_collaborations') }}</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ $memberProjects->count() }}
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded">+1.8%</div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm ml-2">{{ __('messages.from_last_month') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Projects -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('messages.recent_projects') }}</h3>
                    @if($recentProjects->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900/50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.project') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.team') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.progress') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($recentProjects as $project)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $project->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($project->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex -space-x-2">
                                                @foreach($project->members->take(3) as $member)
                                                    <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-medium">
                                                        {{ substr($member->name, 0, 2) }}
                                                    </div>
                                                @endforeach
                                                @if($project->members->count() > 3)
                                                    <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-medium">
                                                        +{{ $project->members->count() - 3 }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mr-2">
                                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project->progressPercentage }}%"></div>
                                                </div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $project->progressPercentage }}%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ __('messages.status_active') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-gray-500 dark:text-gray-400 text-center py-4">
                            <p>{{ __('messages.no_projects_yet') }}</p>
                            <a href="{{ route('projects.create') }}" class="mt-2 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                                {{ __('messages.create_first_project') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Create New Project -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('messages.quick_actions') }}</h3>
                        <div class="space-y-4">
                            <a href="{{ route('projects.create') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('messages.create_new_project') }}
                            </a>
                            <a href="{{ route('projects.index') }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                {{ __('messages.view_all_projects') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('messages.recent_activity') }}</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">New project "Website Redesign" created</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2 {{ __('messages.hours_ago') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Task completed in "Mobile App Development"</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">5 {{ __('messages.hours_ago') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
