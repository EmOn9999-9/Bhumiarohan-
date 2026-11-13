<x-layouts.admin :title="$member->exists ? 'Edit team member' : 'New team member'">
    <form method="POST" enctype="multipart/form-data" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" class="grid gap-6 xl:grid-cols-3">
        @csrf
        @if ($member->exists) @method('PUT') @endif
        <div class="card grid gap-5 p-6 sm:grid-cols-2 xl:col-span-2">
            <x-admin.field name="name" label="Full name" :value="$member->name" required />
            <x-admin.field name="role" label="Role / position" :value="$member->role" hint="e.g. Civil Engineer, Managing Director" required />
            <x-admin.field name="qualification" label="Qualification" :value="$member->qualification" hint="e.g. B.E. Civil, M.Sc. Structural" class="sm:col-span-2" />
            <x-admin.field name="email" label="Email" type="email" :value="$member->email" />
            <x-admin.field name="phone" label="Phone" :value="$member->phone" />
            <x-admin.field name="bio" label="Short bio" type="textarea" rows="4" :value="$member->bio" class="sm:col-span-2" />
        </div>
        <div class="space-y-6">
            <div class="card space-y-4 p-6">
                <x-admin.toggle name="is_active" label="Visible on website" :checked="$member->is_active" />
                <x-admin.field name="sort_order" label="Display order" type="number" :value="$member->sort_order" />
                <button class="btn btn-primary w-full">{{ $member->exists ? 'Save changes' : 'Add member' }}</button>
            </div>
            <div class="card p-6"><x-admin.image-field name="photo" label="Photo" :current="$member->photo" /></div>
        </div>
    </form>
    @if ($member->exists)
        <form method="POST" action="{{ route('admin.team.destroy', $member) }}" data-confirm="Remove this team member?" class="mt-6">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><x-icon name="trash" class="size-4" /> Remove member</button>
        </form>
    @endif
</x-layouts.admin>
