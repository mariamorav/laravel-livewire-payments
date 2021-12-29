<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Laravel\Cashier\Exceptions\IncompletePayment;

class Subscriptions extends Component
{
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.subscriptions');
    }

    public function newSubscription($name, $price) {

        try {

            auth()->user()->newSubscription($name, $price)
                ->quantity(null)
                ->trialUntil(Carbon::now()->addDays(14))
                ->create();

            $this->emitTo('invoices', 'render');

        } catch (IncompletePayment $exception) {

            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('billing.index')]
            );

        }

    }

    public function cancellingSubscription($name) {
        auth()->user()->subscription($name)->cancel();
    }

    public function resumingSubscription($name) {
        auth()->user()->subscription($name)->resume();
    }
}
