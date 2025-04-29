<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.edit') }} - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('messages.project_name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $project->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('messages.project_description')" />
                            <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" required>{{ old('description', $project->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('messages.project_price')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', $project->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="start_date" :value="__('messages.start_date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $project->start_date->format('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('messages.end_date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $project->end_date->format('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="team_members" :value="__('messages.team_members')" />
                            <select id="team_members" name="team_members[]" multiple class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, $project->members->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('team_members')" />
                        </div>

                        <div class="flex justify-end gap-4">
                            <x-secondary-button onclick="window.history.back()">
                                {{ __('messages.cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('messages.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
