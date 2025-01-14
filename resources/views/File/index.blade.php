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
            @session('error')
                <div class="bg-red-300 rounded-md border-2 border-red-700 my-2 p-4 text-red-800">
                    {{ $value }}
                </div>
            @endsession

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <x-input-label for="name" :value="__('Document Name')"/>
                        <x-text-input
                            type="text"
                            id="name"
                            name="name"
                            class="block mt-1 w-full"
                            min="3"
                            max="128"
                            required
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                        <x-input-label for="description" :value="__('Description')"/>
                        <x-textarea-input
                            name="description"
                            id="description"
                            class="block mt-1 w-full"
                        />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />

                        <x-input-label
                            for="inputFile"
                            :value="__('Choose file')"
                            class="my-3 px-3 py-2 max-w-72 bg-zinc-200 border-2 border-solid rounded-md border-zinc-800 color-zinc-800"
                        />
                        <x-file-input
                            name="file"
                            id="inputFile"
                        />

                    </div>

                    <div class="mb-3">
                        <button
                            type="submit"
                            class="my-3 px-3 py-2 max-w-72 bg-emerald-50 border-2 border-solid rounded-md border-emerald-900 color-emerald-900"
                        >
                            <i class="fa fa-save"></i> Upload
                        </button>
                    </div>

                </form>
            </div>
            @if ($files->isEmpty())
                <p class="text-gray-500">Nenhum arquivo encontrado.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 bg-white rounder-md">
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
                                        <a href="{{ route('file.show', $file->id) }}" class="text-blue-500 underline">
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
