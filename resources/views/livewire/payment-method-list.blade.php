<div>

    <section class="card relative">

        <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="20" />
        </div>

        <div class="px-6 py-4 bg-gray-50">
            <h1 class="text-gray-700 text-lg font-bold">Métodos de pago agregado</h1>
        </div>

        <div class="card-body divide-y divide-gray-200">

            @forelse ($paymentMethods as $paymentMethod)

                <article class="text-sm text-gray-700 py-2 flex justify-between items-center">
                    <div>
                        <h1><span class="font-bold">{{$paymentMethod->billing_details->name}}</span> xxxx-{{$paymentMethod->card->last4}}
                            @if ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id)
                                (default)
                            @endif
                        </h1>
                        <p>Expira {{$paymentMethod->card->exp_month}}/{{$paymentMethod->card->exp_year}}</p>
                    </div>

                    <div class="grid grid-cols-2 border border-gray-200 rounded text-gray-500 divide-x divide-gray-200">

                        @unless ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id)

                            <svg wire:click="defaultPaymentMethod('{{$paymentMethod->id}}')" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer p-3 text-gray-500 hover:text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>

                            <svg wire:click="deletePaymentMethod('{{$paymentMethod->id}}')" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer p-3 text-gray-500 hover:text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>

                        @endunless

                    </div>
                </article>

            @empty

                <article class="p-2">
                    <h1 class="text-sm text-gray-700">No cuenta con ningún método de pago</h1>
                </article>

            @endforelse

        </div>
    </section>

</div>
