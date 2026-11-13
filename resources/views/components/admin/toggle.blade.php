@props(['name', 'label', 'checked' => false])
<label class="flex items-center gap-3 text-sm font-medium text-slate-700">
    <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $checked)) class="size-4 rounded border-slate-300 accent-brand-700">
    {{ $label }}
</label>
