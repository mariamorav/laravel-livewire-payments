<div>
    <article class="card relative">

        <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 justify-center items-center">
            <x-spinner size="16"/>
        </div>

        <form id="card-form">
            @csrf
            <div class="card-body">
                <h1 class="text-gray-700 text-lg font-bold mb-4">Agregar Método de Pago</h1>
                <div class="flex">
                    <p class="text-gray-700">Información de la tarjeta</p>
                    <div class="flex-1 ml-6">
                        <div class="form-group">
                            <input class="form-control" id="card-holder-name" type="text" placeholder="Nombre del titular de la tarjeta" required>
                        </div>

                        <!-- Stripe Elements Placeholder -->
                        <div>
                            <div class="form-control" id="card-element"></div>

                            <span class="invalid-feedback" id="cardErrors"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-gray-500 flex justify-end">
                <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </button>
            </div>
        </form>
    </article>

    @slot('js')

        <script>

            document.addEventListener('livewire:load', function() {
                stripe();

                Livewire.on('resetStripe', function() {
                    document.getElementById('card-form').reset();
                    stripe();
                });
            });

            function stripe() {

                const stripe = Stripe("{{ env('STRIPE_KEY') }}");

                const elements = stripe.elements();
                const cardElement = elements.create('card');

                cardElement.mount('#card-element');

                // Generate Token

                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                const cardForm = document.getElementById('card-form');
                const clientSecret = cardButton.dataset.secret;

                cardForm.addEventListener('submit', async (e) => {

                    e.preventDefault();

                    const { setupIntent, error } = await stripe.confirmCardSetup(
                        clientSecret, {
                            payment_method: {
                                card: cardElement,
                                billing_details: { name: cardHolderName.value }
                            }
                        }
                    );

                    if (error) {
                        // Display "error.message" to the user...
                        document.getElementById("cardErrors").textContent = error.message;
                    } else {

                        Livewire.emit('paymentMethodCreate', setupIntent.payment_method);
                    }
                });

            };
        </script>
    @endslot
</div>
