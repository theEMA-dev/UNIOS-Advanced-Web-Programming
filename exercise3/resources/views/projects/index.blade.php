<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.projects') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('messages.new_project') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Managed Projects -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ __('messages.managed_projects') }}</h3>
                    @if($managedProjects->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900/50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.project_name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.team_members') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.progress') }}</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($managedProjects as $project)
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
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('projects.edit', $project) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">{{ __('messages.edit') }}</a>
                                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" onclick="return confirm('Are you sure?')">
                                                            {{ __('messages.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
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

            <!-- Member Projects -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ __('messages.member_projects') }}</h3>
                    @if($memberProjects->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900/50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.project_name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.project_manager') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.progress') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($memberProjects as $project)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $project->name }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($project->description, 50) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-medium mr-2">
                                                        {{ substr($project->manager->name, 0, 2) }}
                                                    </div>
                                                    <div class="text-sm text-gray-900 dark:text-white">{{ $project->manager->name }}</div>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">{{ __('messages.no_member_projects') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
