<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($company->name()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b">
                    <div class="grid justify-items-center border border-solid border-black">
                        <img src="{{ $company->logo() }}" alt="Company Logo">
                        <div>{{ $company->name() }}</div>
                        <div>{{ $company->ticker() }}</div>
                        <div>{{ $company->currency() }}</div>
                        <div>{{ $company->exchange() }}</div>
                        <div>{{ $company->country() }}</div>
                        <div>{{ $company->phone() }}</div>
                        <div>{{ $company->sharesOutstanding() }}</div>
                    </div>
                    <div class="w-full m-5 grid grid-cols-7 justify-items-center bg-gray-700 text-white p-1.5">
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
                <div class="flex justify-center">
                    <div>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                    </div>
                    <form method="post"
                          action="{{ route('buy.stock', ['company' => \Illuminate\Support\Str::snake($company->name()),'stock' => $company->ticker(), 'price' => $companyQuoteData->currentPrice()])}}">
                        @csrf
                        @method('POST')
                        <input type="text" name="stock-amount" placeholder="Enter amount" required>
                        <button type="submit" class="border rounded-md bg-gray-700 text-white p-1 hover:bg-gray-900">
                            Buy
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
