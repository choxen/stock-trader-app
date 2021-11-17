<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="">
                        <div class="inline-fl">
                            <form method="post" action="{{ route('sendEmail') }}">
                                @csrf
                                @method('POST')
                                <input class="w-10/12 border rounded-md" type="email" name="email" id="email"
                                       placeholder="Enter email"
                                       required>
                                <button class="h-11 border rounded-md bg-gray-700 text-white p-1 hover:bg-gray-900" type="submit">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

