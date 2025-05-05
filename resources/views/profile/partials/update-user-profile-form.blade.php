<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's user profile information.") }}
        </p>

        <br>

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" placeholder="Enter your First Name" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name"/>
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <br>

        <div>
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" placeholder="Enter your Middle Name" :value="old('middle_name', $user->middle_name)" required autofocus autocomplete="middle_name"/>
            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
        </div>

        <br>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" placeholder="Enter your Last Name" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name"/>
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <br>

        <div>
            <x-input-label for="suffix" :value="__('Suffix')" />
            <x-text-input id="suffix" name="suffix" type="text" class="mt-1 block w-full" placeholder="Enter your Suffix Name if you have any" :value="old('suffix', $user->suffix)" required autofocus autocomplete="last_name"/>
            <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
        </div>
    </header>
</section>