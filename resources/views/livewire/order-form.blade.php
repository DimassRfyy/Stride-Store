<div>
    <div class="flex w-[260px] h-[160px] shrink-0 overflow-hidden mx-auto">
        <img id="main-thumbnail" src="{{ Storage::url($shoe->thumbnail) }}" class="w-full h-full object-contain object-center" alt="thumbnail">
    </div>
    <form wire:submit.prevent='submit' class="flex flex-col gap-5">
        <div class="flex flex-col rounded-[20px] p-4 mx-4 pb-5 gap-5 bg-white">
            <div id="info" class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h1 id="title" class="font-bold text-[22px] leading-[30px]">{{ $shoe->name }}</h1>
                    <p class="font-semibold text-lg leading-[27px]">Rp{{ number_format($shoe->price, 0, ',', '.') }} • {{ $orderData['shoe_size'] }}</p>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[26px] h-[26px]" alt="star">
                    <span class="font-semibold text-xl leading-[30px]">4.5</span>
                </div>
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Complete Name</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/user.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input type="text" wire:model='name' name="name" id="name" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" placeholder="Type your complete name">
                    @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="email" class="font-semibold">Email Address</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input type="text" wire:model='email' name="email" id="email" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" placeholder="Type your email address">
                    @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex flex-col gap-2">
                <p class="font-semibold">Quantity</p>
                <div class="relative flex items-center gap-[30px]">

                    <button type="button" wire:click='decrementQuantity()' class="flex w-full h-[54px] items-center justify-center rounded-full bg-[#2A2A2A] overflow-hidden">
                        <span class="font-bold text-xl leading-[30px] text-white">-</span>
                    </button>

                    <p id="quantity-display" class="font-bold text-xl leading-[30px]">
                        {{$quantity}}
                    </p>
                    <input type="number" wire:model.live.debounce.500ms='quantity' name="quantity" id="quantity" value="1" class="sr-only -z-10">

                    <button type="button" wire:click='incrementQuantity()' class="flex w-full h-[54px] items-center justify-center rounded-full bg-[#C5F277] overflow-hidden">
                        <span class="font-bold text-xl leading-[30px]">+</span>
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="promo" class="font-semibold">Promo Code</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/discount-shape.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input type="text" wire:model.live.debounce.500ms='promoCode' name="promo" id="promo" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" placeholder="Input the promo code">
                </div>
                @if (session()->has('message'))
                <span class="font-semibold text-sm leading-[21px] text-[#01A625]">Yeay! anda mendapatkan promo spesial</span>
                @endif
                @if (session()->has('error'))
                <span class="font-semibold text-sm leading-[21px] text-[#FF1943]">Sorry, kode promo tersebut tidak tersedia</span>
                @endif
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex items-center justify-between">
                <p class="font-semibold">Sub Total</p>
                <p class="font-bold">Rp{{ number_format($subTotalAmount, 0, ',','.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold">Discount</p>
                <p id="discount" class="font-bold text-[#FF1943]">- Rp{{ number_format($discount, 0, ',','.') }}</p>
            </div>
        </div>
        <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
            <div class="fixed bottom-5 w-full max-w-[640px] z-30 px-4">
                <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6">
                    <div class="flex flex-col gap-[2px]">
                        <p class="font-bold text-[20px] leading-[30px] text-white">Rp{{ number_format($grandTotalAmount,0,',','.') }}</p>
                        <p class="text-sm leading-[21px] text-[#878785]">Grand total</p>
                    </div>
                    <button type="submit" class="rounded-full p-[12px_20px] bg-[#C5F277] font-bold">
                        Continue
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
