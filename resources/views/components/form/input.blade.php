<div class="form-group mb-6">
    <label class="form-label {{ $required ? 'required' : '' }}">
        {{ $label }}
    </label>

    <input
        class="form-control"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        value="{{ $value }}"
        {{ $attributes }}
    />
    <div class="text-muted fs-7">{{ $tooltip }}</div>
</div>
