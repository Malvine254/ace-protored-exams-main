@props(['value' => 5])

<div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden" role="progressbar" aria-valuenow={value}
    aria-valuemin="0" aria-valuemax="100">
    <div class="flex flex-col justify-center rounded-full overflow-hidden bg-yellow-500 text-xs text-white text-center whitespace-nowrap transition duration-500"
        style="width: {{ $value }}%; "></div>
</div>
