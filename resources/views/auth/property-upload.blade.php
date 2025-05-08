<x-app-layout>
    <!-- This is for the status of the logged in user -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- This is for the title field -->
        <div class="mt-4">
            <x-input-label for="title" :value="__('title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="title" name="title" :value="old('title')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- This is for the  description field -->
        <div>
            <x-input-label for="description " :value="__('description ')" />
            <textarea id="description " name="description " rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:ring focus:ring-indigo-500">
                {{ old('description ', $user->profile->description  ?? '') }}
            </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description ')" />
        </div>
</x-app-layout>