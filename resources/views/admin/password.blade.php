<x-layouts.admin title="Change password">
    <form method="POST" action="{{ route('admin.password.update') }}" class="card max-w-lg space-y-5 p-6 sm:p-8">
        @csrf @method('PUT')
        <div>
            <label class="form-label" for="current_password">Current password</label>
            <input id="current_password" type="password" name="current_password" class="form-input" required autocomplete="current-password">
            @error('current_password')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="form-label" for="password">New password</label>
            <input id="password" type="password" name="password" class="form-input" required autocomplete="new-password">
            @error('password')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="form-label" for="password_confirmation">Confirm new password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required autocomplete="new-password">
        </div>
        <button class="btn btn-primary">Update password</button>
    </form>
</x-layouts.admin>
