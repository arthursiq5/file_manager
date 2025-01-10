<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('File') }} - {{ $file->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>{{ $file->description }}</p>

                <hr class="my-3">

                <h4 class="font-semibold text-md text-gray-800 leading-tight">
                    Resumo do Gemini
                </h4>

                @foreach($summaryGemini as $line)
                    <p class="mb-1">{{$line}}</p>
                @endforeach

                <hr class="my-3">
                <a href="{{ route('files.download', $file->id) }}" class="inline-block bg-blue-500 text-white py-1 px-3 rounded-md text-sm hover:bg-blue-600">
                    Baixar
                </a>
                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md text-sm hover:bg-red-600">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
