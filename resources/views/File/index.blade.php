<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @session('success')
                <div class="bg-green-300 rounded-md border-2 border-green-700 my-2 p-4 text-green-800">
                    {{ $value }}
                </div>
            @endsession

            @error('file')
                <div class="bg-red-300 rounded-md border-2 border-rose-500 my-2 p-4 text-rose-600">
                    {{ $message }}
                </div>
            @enderror

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="inputFile">File:</label>
                        <input
                            type="file"
                            name="file"
                            id="inputFile"
                            class="form-control @error('file') is-invalid @enderror">

                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Upload</button>
                    </div>

                </form>
            </div>
            @if ($files->isEmpty())
                <p class="text-gray-500">Nenhum arquivo encontrado.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 text-left text-gray-600">Nome</th>
                                <th class="py-2 px-4 text-left text-gray-600">Descrição</th>
                                <th class="py-2 px-4 text-left text-gray-600">Arquivo</th>
                                <th class="py-2 px-4 text-left text-gray-600">Data de Envio</th>
                                <th class="py-2 px-4 text-left text-gray-600">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr class="border-t border-gray-300 hover:bg-gray-50">
                                    <td class="py-2 px-4">{{ $file->name }}</td>
                                    <td class="py-2 px-4">{{ $file->description }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ asset($file->folder . '/' . $file->file_name) }}" target="_blank" class="text-blue-500 underline">
                                            {{ $file->file_name }}
                                        </a>
                                    </td>
                                    <td class="py-2 px-4">{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="py-2 px-4">
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
