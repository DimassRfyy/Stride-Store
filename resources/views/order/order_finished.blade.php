<x-layouts.app>
    <div class="flex flex-col items-center justify-center px-4 gap-[30px] my-auto">
        <div class="w-[330px] h-[196px] flex overflow-hidden">
            <img src="{{ Storage::url($productTransaction->shoe->thumbnail) }}" class="w-full h-full object-contain" alt="thumbnail">
        </div>
        <div class="flex flex-col w-full max-w-[340px] rounded-[20px] p-[20px_16px_30px_16px] gap-[30px] bg-white">
            <div class="flex flex-col text-center gap-[10px]">
                <h1 class="font-bold text-xl leading-[30px]">New Shoes Coming!</h1>
                <p class="leading-[30px]">Kami akan memeriksa pesanan anda silahkan cek order secara berkala</p>
            </div>
            <div class="flex items-center justify-between rounded-2xl border-2 border-[#FFC700] border-dashed p-[12px_16px]">
                <div class="flex items-center gap-[10px]">
                    <img src="{{ asset('assets/images/icons/delivery.svg') }}" class="w-8 h-8 flex shrink-0" alt="icon">
                    <p>Booking ID <span class="font-bold">{{ $productTransaction->booking_trx_id }}</span></p>
                </div>
                <img src="{{ asset('assets/images/icons/verify.svg') }}" class="w-6 h-6" alt="icon">
            </div>
            <div class="flex flex-col gap-3">
                <a href="/" class="rounded-full p-[12px_20px] text-center w-full bg-[#C5F277] font-bold">Order More</a>
                <a href="booking-details.html" class="rounded-full p-[12px_20px] text-center w-full bg-[#090917] font-bold text-white">View Booking</a>
            </div>
        </div>
    </div>
</x-layouts.app>
