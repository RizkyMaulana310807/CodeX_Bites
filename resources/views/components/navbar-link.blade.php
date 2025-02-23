@props(['active' => false])

<a {{ $attributes }}
    class="{{ $active ? 'bg-[#8C1C13] text-white shadow-lg' : 'text-gray-400 hover:bg-[#8C1C13] hover:text-white' }} 
    w-16 h-16 flex flex-col justify-center items-center gap-1 rounded-full transition-all duration-300 p-3">
    {{ $slot }}
</a>
