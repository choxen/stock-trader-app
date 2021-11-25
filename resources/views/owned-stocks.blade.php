<x-app-layout>

    <script type="text/javascript">
        function toggleVisibility(id) {
            let div = document.getElementById(id);
            div.style.display = div.style.display === "none" ? "block" : "none";
        }
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
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
                    @foreach($stocks as $stock)
                        <div class="hidden" id="stock-sell-form-{{ $stock->ticker }}">
                            <div class="flex items-center justify-center text-gray-300 mt-3 ml-5">
                                <form method="post" action="{{ route('stocks.sell', $stock) }}">
                                    @csrf
                                    <input type="text" class="rounded-md border-gray-700 text-gray-500"
                                           name="stock-quantity"
                                           placeholder="Enter amount:">
                                    <button type="submit"
                                            class="bg-gray-700 border-gray-700 rounded-md p-1 w-11 hover:bg-gray-800">
                                        Sell
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="flex items-center justify-center text-gray-300 mb-1.5">
                                <div class="bg-gray-700 p-3 rounded-md mr-1.5">
                                    <div class="inline-flex mr-3">
                                        <p class="mr-1.5">Stock:</p>
                                        {{ $stock->ticker }}
                                    </div>
                                    <div class="inline-flex mr-3">
                                        <p class="mr-1.5">Quantity:</p>
                                        {{ $stock->quantity }}
                                    </div>
                                    <div class="inline-flex mr-3">
                                        <p class="mr-1.5">Invested:</p>
                                        {{ number_format($stock->total_invested, 2) }}$
                                    </div>
                                    <div class="inline-flex mr-3">
                                        <p class="mr-1.5">Current value:</p>
                                        {{ number_format($stock->current_total, 2) }}$
                                    </div>
                                    <div class="inline-flex">
                                        <p class="mr-1.5">Total profit:</p>
                                        {{ number_format($stock->total_profit, 2) }}$
                                    </div>
                                </div>
                                <div class="inline-flex">
                                    <div class="mr-1.5">
                                        <button
                                            class="bg-gray-700 border-gray-700 rounded-md p-1 w-11 h-8 hover:bg-gray-800"
                                            type="submit"
                                            onclick="toggleVisibility('stock-sell-form-{{ $stock->ticker }}')">Sell
                                        </button>
                                    </div>
                                    <div class="mt-1">
                                        <a href="{{ route('stocks.result', $stock->ticker) }}"
                                           class="bg-gray-700 border-gray-700 rounded-md p-1 hover:bg-gray-800 outline-none">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
