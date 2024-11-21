<x-layouts.app>
    <x-slot:topbar>
        <a href="customer-data.html">
            <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-10 h-10" alt="icon">
        </a>
        <p class="font-bold text-lg leading-[27px]">Review & Payment</p>
        <div class="dummy-btn w-10"></div>
    </x-slot:topbar>
    <form method="POST" enctype="multipart/form-data" action="{{ route('front.payment_confirm') }}" class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
        @csrf
        <section id="your-order" class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between">
                <h2 class="font-bold text-xl leading-[30px]">Your Order</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                <input type="checkbox" class="hidden">
            </label>
            <div class="flex items-center gap-[14px]">
                <div class="flex shrink-0 w-20 h-20 rounded-[20px] bg-[#D9D9D9] p-1 overflow-hidden">
                    <img src="{{ Storage::url($shoe->thumbnail) }}" class="w-full h-full object-contain" alt="">
                </div>
                <h3 class="font-bold text-lg leading-6">
                    {{ $shoe->name }}
                </h3>
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex items-center justify-between">
                <p class="font-semibold">Brand</p>
                <p class="font-bold">{{ $shoe->brand->name }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Price</p>
                <p class="font-bold">Rp{{ number_format($shoe->price, 0, ',','.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Quantity</p>
                <p class="font-bold">{{ $orderData['quantity'] }} Pcs</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Shoe Size</p>
                <p class="font-bold">{{ $orderData['shoe_size'] }}</p>
            </div>
        </section>
        <section id="customer" class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between">
                <h2 class="font-bold text-xl leading-[30px]">Customer</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                <input type="checkbox" class="hidden">
            </label>
            <div class="flex items-center gap-5">
                <img src="{{ asset('assets/images/icons/user.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                <div class="flex flex-col gap-[6px]">
                    <p class="font-semibold">Name</p>
                    <p class="font-bold">{{ $orderData['name'] }}</p>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                <div class="flex flex-col gap-[6px]">
                    <p class="font-semibold">Phone No.</p>
                    <p class="font-bold">{{ $orderData['phone'] }}</p>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                <div class="flex flex-col gap-[6px]">
                    <p class="font-semibold">Email</p>
                    <p class="font-bold">{{ $orderData['email'] }}</p>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <img src="{{ asset('assets/images/icons/house-2.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                <div class="flex flex-col gap-[6px]">
                    <p class="font-semibold">Delivery to</p>
                    <p class="font-bold">{{ $orderData['address'] }}, {{ $orderData['city'] }} - {{ $orderData['post_code'] }}</p>
                </div>
            </div>
        </section>
        <section id="payment-details" class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between">
                <h2 class="font-bold text-xl leading-[30px]">Payment Details</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                <input type="checkbox" class="hidden">
            </label>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Sub Total</p>
                <p class="font-bold">Rp{{ number_format($orderData['sub_total_amount'], 0, ',','.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Promo Code</p>
                <p class="font-bold">{{ $orderData['promo_code'] }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Discount</p>
                <p class="font-bold text-[#FF1943]">- Rp{{ number_format($orderData['discount_amount'], 0, ',','.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">PPN 11%</p>
                <p class="font-bold">Rp{{ number_format($orderData['total_tax'], 0, ',','.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Delivery</p>
                <p class="font-bold">Rp 0</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Grand Total</p>
                <p class="font-bold text-2xl leading-9 text-[#07B704]">Rp{{ number_format($orderData['grand_total_amount'], 0, ',','.') }}</p>
            </div>
        </section>
        <section id="send-payment-to" class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
            <label class="group flex items-center justify-between">
                <h2 class="font-bold text-xl leading-[30px]">Send Payment to</h2>
                <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                <input type="checkbox" class="hidden">
            </label>
            <div class="flex items-center gap-3">
                <div class="flex shrink-0 w-[71px] h-[50px] overflow-hidden">
                    <img src="{{ asset('assets/images/logos/bca-bank-central-asia 1.svg') }}" class="w-full h-full object-contain" alt="bank logo">
                </div>
                <div class="flex flex-col gap-[2px]">
                    <p class="font-semibold flex items-center">JuaraTiket Indonesia <img src="{{ asset('assets/images/icons/verify.svg') }}" class="ml-1" alt="icon"></p>
                    <p>8008129839</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex shrink-0 w-[71px] h-[50px] overflow-hidden">
                    <img src="{{ asset('assets/images/logos/bank-mandiri 1.svg') }}" class="w-full h-full object-contain" alt="bank logo">
                </div>
                <div class="flex flex-col gap-[2px]">
                    <p class="font-semibold flex items-center">JuaraTiket Indonesia <img src="{{ asset('assets/images/icons/verify.svg') }}" class="ml-1" alt="icon"></p>
                    <p>12379834983281</p>
                </div>
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex flex-col gap-2">
                <p class="font-semibold">Bukti Transfer</p>
                <div class="group w-full rounded-full px-[14px] flex items-center ring-1 ring-[#090917] gap-[10px] relative transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets/images/icons/security-card.svg') }}" alt="icon">
                    </div>
                    <button type="button" id="Upload-btn" class="appearance-none outline-none w-full py-[14px] text-left text-sm overflow-hidden text-[#878785]" onclick="document.getElementById('Proof').click()">
                        Add an attachment
                    </button>
                    <input type="file" name="proof" id="Proof" class="absolute -z-10 opacity-0" required>
                </div>
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex items-center gap-[10px]">
                <img src="{{ asset('assets/images/icons/shield-tick.svg') }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <p class="leading-[26px]">Kami melindungi data privasi anda dengan baik bantuan Angga X.</p>
            </div>
        </section>
        <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
            <div class="fixed bottom-5 w-full max-w-[640px] z-30 px-4">
                <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6">
                    <div class="flex flex-col gap-[2px] mr-2">
                        <p class="text-white">Apakah anda sudah benar membayar?</p>
                    </div>
                    <button type="submit" class="rounded-full p-[12px_20px] bg-[#C5F277] font-bold text-nowrap">
                        Confirm Now
                    </button>
                </div>
            </div>
        </div>
    </form>

    <x-slot:script>
        <script src="{{ asset('js/accordion.js') }}"></script>
        <script src="{{ asset('js/payment.js') }}"></script>
    </x-slot:script>
</x-layouts.app>
