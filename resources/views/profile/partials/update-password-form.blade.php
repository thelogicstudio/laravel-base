<section>
    <header>
        <h3 class="text-secondary">
            {{ __('Update Password') }}
        </h3>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 mb-3">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="col-12 col-md-6 col-xl-3">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 form-control block w-full" required autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
        </div>

        <div class="col-12 col-md-6 col-xl-3 mt-2">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 form-control block w-full" required autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
        </div>

        <div class="col-12 col-md-6 col-xl-3 mt-2">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 form-control block w-full" required autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
        </div>

        <div class="flex items-center gap-4 mt-3">
            <button type="submit" class="btn btn-primary ">Save</button>
{{--            @if (session('status') === 'password-updated')--}}
{{--                <p--}}
{{--                    x-data="{ show: true }"--}}
{{--                    x-show="show"--}}
{{--                    x-transition--}}
{{--                    x-init="setTimeout(() => show = false, 2000)"--}}
{{--                    class="text-sm mt-2 text-green"--}}
{{--                >{{ __('Saved.') }}</p>--}}
{{--            @endif--}}
        </div>
    </form>
</section>
