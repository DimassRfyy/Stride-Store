<?php

namespace App\Livewire;

use App\Models\Shoe;
use App\Services\OrderService;
use Livewire\Component;

class OrderForm extends Component
{
    public Shoe $shoe;
    public $orderData;
    public $subTotalAmount;
    public $promoCode = null;
    public $promoCodeId = null;
    public $quantity = 1;
    public $discount = 0;
    public $grandTotalAmount;
    public $totalDiscountAmount = 0;
    public $name;
    public $email;

    protected $orderService;

    public function boot(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function mount(Shoe $shoe, $orderData)
    {
        $this->shoe = $shoe;
        $this->orderData = $orderData;
        $this->subTotalAmount = $shoe->price;
        $this->grandTotalAmount = $this->shoe->price;
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->shoe->stock) {
            $this->quantity++;
            $this->calculatedTotal();
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->calculatedTotal();
        }
    }

    public function updatedQuantity()
    {
        $this->validateOnly(
            'quantity',
            [
                'quantity' => 'required|integer|min:1|max:' . $this->shoe->stock,
            ],
            [
                'quantity.max' => 'Stock tidak tersedia',
            ]
        );
    }

    public function updatedPromoCode()
    {
        $this->applyPromoCode();
    }

    public function applyPromoCode()
    {
        if (!$this->promoCode) {
            $this->resetDiscount();
            return;
        }

        $result = $this->orderService->applyPromoCode($this->promoCode, $this->subTotalAmount);

        if (isset($result['error'])) {
            session()->flash('error', $result['error']);
            $this->resetDiscount();
        } else {
            session()->flash('message', 'Kode promo tersedia, yay!');
            $this->discount = $result['discount'];
            $this->calculatedTotal();
            $this->promoCodeId = $result['promoCodeId'];
            $this->totalDiscountAmount = $result['discount'];
        }
    }

    public function resetDiscount()
    {
        $this->discount = 0;
        $this->calculatedTotal();
        $this->promoCodeId = null;
        $this->totalDiscountAmount = 0;
    }

    public function calculatedTotal()
    {
        $this->subTotalAmount = $this->shoe->price * $this->quantity;
        $this->grandTotalAmount = $this->subTotalAmount - $this->discount;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1|max:' . $this->shoe->stock,
        ];
    }

    public function gatherBookingData(array $validatedData)
    {
        return [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'grand_total_amount' => $this->grandTotalAmount,
            'sub_total_amount' => $this->subTotalAmount,
            'total_discount_amount' => $this->totalDiscountAmount,
            'discount_amount' => $this->discount,
            'promo_code' => $this->promoCode,
            'promo_code_id' => $this->promoCodeId,
            'quantity' => $this->quantity,
        ];
    }

    public function submit()
    {
        $validatedData = $this->validate();
        $bookingData = $this->gatherBookingData($validatedData);
        $this->orderService->updateCustomerData($bookingData);
        return redirect()->route('front.customer_data');
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}
