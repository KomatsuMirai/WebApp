<div>
    @props(['message'])
    @if ($message)
        <div class="p-4 m-2 rounded text-center text-xl font-bold bg-green-100 text-green-800">
            {{ $message }}
        </div>
    @endif
