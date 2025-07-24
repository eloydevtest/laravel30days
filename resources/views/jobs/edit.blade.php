<x-layout>
    <x-slot:heading>
        Edit Job: {{ $job->title }}
    </x-slot:heading>
    <form method="POST" action="/jobs/{{ $job->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Título</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">

                                <input id="title" type="text" name="title" placeholder="Programmer"
                                    class="block min-w-0 grow py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    value="{{ $job->title }}" required />
                            </div>
                            @error('title')
                                <p class="text-red-500 font-semibold mt-1 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="salary" class="block text-sm/6 font-medium text-gray-900">Salario</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">

                                <input id="salary" type="text" value="{{ $job->salary }}" name="salary"
                                    placeholder="30.000 €"
                                    class="block min-w-0 grow py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    required />
                            </div>
                            @error('salary')
                                <p class="text-red-500 font-semibold mt-1 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-6 flex items-center justify-between gap-x-4">
                <div class="flext items-center">
                    <button form="form-delete" class="text-red-500 text-sm font-bold">Delete</button>
                </div>
                <div class="flex items-center gap-x-6">
                    <a href="/jobs/{{ $job->id }}" class="text-sm font-semibold text-gray-900">Cancel</a>
                    <div>
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Actualizar</button>

                    </div>
                </div>
            </div>
    </form>
    <form method="POST" action="/jobs/{{$job->id}}" id="form-delete" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
