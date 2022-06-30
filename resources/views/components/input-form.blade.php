@php
$value = old($name);
@endphp

@if ($attributes->has('currentData'))
    @php
        $value = old($name) ?? $currentData;
    @endphp
@endif

<div class="mb-3">
    <label class="form-label">{{ Str::ucfirst($name) }}</label>
    <input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
        placeholder="{{ $placeholder ?? '' }}" value="{{ $value }}">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>