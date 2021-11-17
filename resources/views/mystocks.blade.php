<x-app-layout>

    <script type="text/javascript">
        function toggleVisibility(id) {
            let div = document.getElementById(id);
            div.style.display = div.style.display === "none" ? "block" : "none";
        }
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                    </div>
                    @foreach($stocks as $stock)
                        <div>
                            <div>
                                <div>{{ $stock->stock }}</div>
                                <div>{{ $stock->quantity }}</div>
                            </div>
                            <div>
                                <div id="sell-stock">
                                    <button onclick="toggleVisibility('sell-stock-form')">Sell</button>
                                </div>
                                <div id="sell-stock-form" class="hidden">
                                    <form method="post"
                                          action="{{ route('sell.stock', $stock) }}">
                                        @csrf
                                        <input type="text" name="stock-quantity" placeholder="Enter stock amount:"
                                               required>
                                        <button type="submit">Sell</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
