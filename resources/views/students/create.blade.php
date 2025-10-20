<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <form method="POST" action="{{ route('students.store') }}">
                                @csrf
                                @method('post')
                                <div>
                                    <x-input-label for="full_name" :value="__('Full Name')" />
                                    <x-text-input id="full_name" class="block mt-1 w-full" type="text"
                                        name="full_name" :value="old('full_name')" required autofocus
                                        autocomplete="full_name" />
                                    <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-center mt-4">
                                    <x-primary-button class="ms-4">
                                        {{ __('Add') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
