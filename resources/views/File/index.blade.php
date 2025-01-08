<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
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
        </div>
    </div>
</x-app-layout>
