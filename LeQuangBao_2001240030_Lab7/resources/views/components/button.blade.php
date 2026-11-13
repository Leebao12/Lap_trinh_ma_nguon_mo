@props([ 
    'variant' => 'primary', 
    'type' => 'submit' 
]) 
 
@php 
    $style = $variant === 'danger' 
        ? 'background:#dc2626; color:#fff; border:none; padding:6px 12px; border-radius:4px; 
    cursor:pointer;' 
        : 'background:#2563eb; color:#fff; border:none; padding:6px 12px; border-radius:4px; 
    cursor:pointer;'; 
    @endphp 
    
    <button type="{{ $type }}" {{ $attributes->merge(['style' => $style]) }}> 
        {{ $slot }} 
    </button> 