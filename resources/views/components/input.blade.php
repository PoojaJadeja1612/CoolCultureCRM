<div class="form-group">
    <label>{{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control {{ $class }}"
        id="{{ $id }}" placeholder="{{ $placeholder }}" />
</div>
