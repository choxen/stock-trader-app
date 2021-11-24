<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6">
                    <div>
                        @if($errors->any())
                            <div class="grid justify-items-center">
                                <div
                                    class="w-5/12 mb-1.5 bg-red-500 p-3 text-white rounded-md flex items-center justify-center">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="inline-fl">
                            <form method="post" action="{{ route('stocks.search') }}">
                                @csrf
                                @method('POST')
                                <input
                                    class="w-10/12 border rounded-md border-gray-700 text-gray-500"
                                    type="text" name="stock" id="stock"
                                    placeholder="Enter company name or symbol"
                                    required>
                                <button
                                    class="h-11 border rounded-md bg-gray-700 text-white p-1 hover:bg-gray-900 border-gray-700"
                                    type="submit">
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
