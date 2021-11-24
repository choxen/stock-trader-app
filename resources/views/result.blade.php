<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __($company->name()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid justify-items-center text-white">
                        <div>
                            <h3 class="font-bold">Company Profile</h3>
                        </div>
                        <div>
                            <div class="m-1">
                                <p class="inline-flex font-semibold">Company:</p>
                                {{ $company->name() }}
                            </div>
                            <div class="m-1">
                                <p class="inline-flex font-semibold">Stock:</p>
                                {{ $company->ticker() }}
                            </div>
                            <div class="m-1">
                                <p class="inline-flex font-semibold">Currency:</p>
                                {{ $company->currency() }}
                            </div>
                            <div class="m-1">
                                <p class="inline-flex font-semibold">Exchange:</p>
                                {{ $company->exchange() }}
                            </div>
                            <div class="m-1">
                                <p class="inline-flex font-semibold">Country:</p>
                                {{ $company->country() }}
                            </div>
                            <div class="m-1">
                                <p class="inline-flex font-semibold">Phone number:</p>
                                {{ $company->phone() }}
                            </div>
                            <div class="m-1">
                                <p class="inline-flex font-semibold">Shares:</p>
                                {{ $company->sharesOutstanding() }}
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-5 grid grid-cols-7 justify-items-center bg-gray-700 text-white p-1.5">
                        <div class="m-1">
                            <p>Price:</p>
                            {{ $companyQuoteData->currentPrice() }}
                        </div>
                        <div class="m-1">
                            <p>Change:</p>
                            {{ $companyQuoteData->change() }}
                        </div>
                        <div class="m-1">
                            <p>Percent change:</p>
                            {{ $companyQuoteData->percentChange() }}
                        </div>
                        <div class="m-1">
                            <p>High price:</p>
                            {{ $companyQuoteData->highestPrice() }}
                        </div>
                        <div class="m-1">
                            <p>Low price:</p>
                            {{ $companyQuoteData->lowestPrice() }}
                        </div>
                        <div class="m-1">
                            <p>Open price:</p>
                            {{ $companyQuoteData->openPrice() }}
                        </div>
                        <div class="m-1">
                            <p>Close price:</p>
                            {{ $companyQuoteData->previousClosePrice() }}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center m-1.5">
                    @if($errors->any())
                        <div class="mb-1.5 bg-red-500 p-3 text-white rounded-md">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        <form method="post"
                              action="{{ route('stocks.buy', ['company' => \Illuminate\Support\Str::snake($company->name()),'stock' => $company->ticker()])}}">
                            @csrf
                            @method('POST')
                            <input class="rounded-md" type="text" name="stock-quantity" placeholder="Enter amount"
                                   required>
                            <button type="submit"
                                    class="border rounded-md bg-gray-700 border-gray-700 text-white p-1 hover:bg-gray-900"
                                    onclick="return confirm('Are you sure?')">
                                Buy
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
