<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's user profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('user_profiles.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- First Name -->
        <div>
            <x-input-label for="firstname" :value="__('First Name')" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" placeholder="Enter your First Name" :value="old('firstname', $user->profile->firstname ?? '' )" required autofocus autocomplete="firstname"/>
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <!-- Middle Name -->
        <div>
            <x-input-label for="middlename" :value="__('Middle Name')" />
            <x-text-input id="middlename" name="middlename" type="text" class="mt-1 block w-full" placeholder="Enter your Middle Name" :value="old('middlename', $user->profile->middlename ?? '')" required autocomplete="middlename"/>
            <x-input-error class="mt-2" :messages="$errors->get('middlename')" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="lastname" :value="__('Last Name')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" placeholder="Enter your Last Name" :value="old('lastname', $user->profile->lastname ?? '')" required autocomplete="lastname"/>
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <!-- Suffix -->
        <div>
            <x-input-label for="suffix" :value="__('Suffix')" />
            <x-text-input id="suffix" name="suffix" type="text" class="mt-1 block w-full" placeholder="Enter your Suffix Name if you have any" :value="old('suffix', $user->profile->suffix ?? '')" autocomplete="suffix"/>
            <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phonenumber" :value="__('Phone Number')" />
            <x-text-input id="phonenumber" name="phonenumber" type="text" class="mt-1 block w-full" placeholder="Enter your Phone Number here" :value="old('phonenumber', $user->profile->phonenumber ?? '')" required autocomplete="tel"/>
            <x-input-error class="mt-2" :messages="$errors->get('phonenumber')" />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:ring focus:ring-indigo-500">
                {{ old('bio', $user->profile->bio ?? '') }}
            </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Image Upload -->
        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <input type="file" id="profile_image" name="profile_image"  class="mt-1 block w-full text-sm text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        <!-- Image Preview -->
        <div>
            <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 300px; display: none; margin-top: 1rem;" />
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'user_profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file && ['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                alert('Please select a valid image file (JPEG, JPG, or PNG).');
            }
        });
    </script>
</section>
