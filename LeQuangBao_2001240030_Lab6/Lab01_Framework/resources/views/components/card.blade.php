@props([
    'title' => null
])

<div style="
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 20px;
    background: #fff;
">

    @if($title)
        <h3 style="
            margin-top: 0;
            margin-bottom: 12px;
        ">
            {{ $title }}
        </h3>
    @endif

    <div>
        {{ $slot }}
    </div>

</div>