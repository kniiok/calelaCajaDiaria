@if ($errors->any())
    <div {{ $attributes }}>
        <div align="center" class="font-medium text-red-600">{{ __('Credenciales incorrectas') }}</div>
    </div>
@endif
