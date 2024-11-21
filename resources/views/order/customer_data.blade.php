<x-layouts.app>
    <x-slot:topbar>
        <a href="booking.html">
            <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-10 h-10" alt="icon">
        </a>
        <p class="font-bold text-lg leading-[27px]">Delivery</p>
        <div class="dummy-btn w-10"></div>
    </x-slot:topbar>
    <div class="flex items-center rounded-3xl gap-[14px] p-[10px_16px_16px_10px] bg-white mx-4">
        <div class="flex shrink-0 w-20 h-20 rounded-2xl p-1 bg-[#D9D9D9] overflow-hidden">
            <img src="{{ Storage::url($shoe->thumbnail) }}" class="w-full h-full object-contain" alt="">
        </div>
        <div class="flex flex-col w-full">
            <h1 id="title" class="font-bold text-lg leading-6">
                {{ $shoe->name }}
            </h1>
            <p class="font-semibold text-sm leading-[21px]">{{ $orderData['shoe_size'] }} • {{ $orderData['quantity'] }} Pcs</p>
        </div>
        <div class="flex items-center shrink-0 gap-1">
            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[22px] h-[22px]" alt="star">
            <span class="font-semibold text-sm leading-[21px]">4.5</span>
        </div>
    </div>
    <!-- Shipping Address Form -->
    <form action="{{ route('front.save_customer_data') }}" method="POST" class="flex flex-col gap-5">
        @csrf
        <div class="flex flex-col rounded-[20px] p-4 mx-4 pb-5 gap-5 bg-white">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h1 id="title" class="font-bold text-[22px] leading-9[30px]">Shipping Address</h1>
                </div>
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex flex-col gap-2">
                <label for="address" class="font-semibold">Full Address</label>
                <div class="flex items-start w-full rounded-[18px] ring-1 ring-[#090917] p-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/house-2.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <textarea name="address" id="address" rows="6" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785]" placeholder="Type your full address"></textarea>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="phone" class="font-semibold">Phone Number</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input type="tel" name="phone" id="phone" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" placeholder="What’s your phone number">
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="city" class="font-semibold">City</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/global.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input type="text" name="city" id="city" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" placeholder="Type your city">
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="post_code" class="font-semibold">Post Code</label>
                <div class="flex items-center w-full rounded-full ring-1 ring-[#090917] px-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                    <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <input type="text" name="post_code" id="post_code" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785] py-[14px]" placeholder="Type your post code">
                </div>
            </div>
            <hr class="border-[#EAEAED]">
            <div class="flex items-center gap-[10px]">
                <img src="{{ asset('assets/images/icons/shield-tick.svg') }}" class="w-8 h-8 flex shrink-0" alt="icon">
                <p class="leading-[26px]">Kami melindungi data privasi dengan baik.</p>
            </div>
        </div>
        <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
            <div class="fixed bottom-5 w-full max-w-[640px] z-30 px-4">
                <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6">
                    <div class="flex flex-col gap-[2px]">
                        <p id="grand-total" class="font-bold text-[20px] leading-[30px] text-white">Rp{{ number_format($grandTotalBeforeTax, 0, ',','.') }}</p>
                        <p class="text-sm leading-[21px] text-[#878785]">Grand total</p>
                    </div>
                    <button type="submit" class="rounded-full p-[12px_20px] bg-[#C5F277] font-bold">
                        Continue
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-layouts.app>
