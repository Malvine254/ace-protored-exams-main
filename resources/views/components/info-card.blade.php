@props(['title' => '', 'value' => '-'])

<div class="flex items-end w-full py-2">
    <span>{{ $title }}</span>
    <div class="flex-grow border-b border-dashed"></div>
    <span>{{ $value }}</span>
</div>
