@props(['name', 'label', 'current' => null, 'multiple' => false])
<div>
    <span class="form-label">{{ $label }}</span>
    <div class="flex flex-wrap items-center gap-4">
        <div id="preview-{{ $name }}" class="flex flex-wrap gap-2">
            @if ($current)<img src="{{ asset('storage/'.$current) }}" alt="" class="size-20 rounded-lg border border-slate-200 object-cover">@endif
        </div>
        <input type="file" name="{{ $multiple ? $name.'[]' : $name }}" accept="image/*" @if ($multiple) multiple @endif data-preview="preview-{{ $name }}"
               class="block text-sm text-slate-600 file:mr-3 file:rounded-full file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-700 hover:file:bg-brand-100">
    </div>
    <p class="mt-1 text-xs text-slate-500">JPG, PNG or WebP, max 5 MB{{ $multiple ? ' each' : '' }}.</p>
    @error($name)<p class="form-error">{{ $message }}</p>@enderror
    @error($name.'.*')<p class="form-error">{{ $message }}</p>@enderror
</div>
