<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($transactions as $transaction)
                        <div class="border rounded-md m-3 text-white bg-gray-700 shadow-xl">
                            <div class="flex flex-row justify-between">
                                <div class="inline-flex justify-center">
                                    <div class="m-1">
                                        <p>Stock: </p>
                                        {{ $transaction->stock }}
                                    </div>
                                    <div class="m-1">
                                        <p>Quantity: </p>
                                        {{ $transaction->quantity }}
                                    </div>
                                </div>
                                <div class="m-1.5">
                                    <p>Price:</p>
                                    USD: {{ $transaction->credits_amount }}
                                </div>
                                <div class="m-1.5 flex order-last justify-end min-h-6 place-self-center">
                                    <div
                                        class="@if($transaction->t_type === 'Bought') bg-green-500 @else bg-red-500 @endif
                                            p-1 rounded-md place-self-center min-w-full">
                                        {{ $transaction->t_type }}
                                    </div>
                                </div>
                                <div class="m-1.5 order-first">
                                    <p>Date:</p>
                                    {{ $transaction->created_at }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
