<x-layouts.app>
    <x-slot:topbar>
        <a href="{{ route('front.index') }}">
            <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-10 h-10" alt="icon">
        </a>
        <p class="font-bold text-lg leading-[27px]">Search Result</p>
        <div class="dummy-btn w-10"></div>
    </x-slot:topbar>
    <form action="{{ route('front.search') }}" class="flex justify-between items-center mx-4">
        <div class="relative flex items-center w-full rounded-l-full px-[14px] gap-[10px] bg-white transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
            <img src="{{ asset('assets/images/icons/search-normal.svg') }}" class="w-6 h-6" alt="icon">
            <input type="text" name="keyword" class="w-full py-[14px] appearance-none bg-white outline-none font-bold leading-5 placeholder:font-normal placeholder:text-[#878785]" placeholder="Search product...">
        </div>
        <button type="submit" class="h-full rounded-r-full py-[14px] px-5 bg-[#C5F277]">
            <span class="font-semibold">Explore</span>
        </button>
    </form>
    <section id="result" class="flex flex-col gap-4 px-4 mb-[111px] mt-[10px]">
        @forelse ($shoes as $shoe)
        <a href="{{ route('front.details', $shoe->slug) }}">
            <div class="flex items-center rounded-3xl p-[10px_16px_16px_10px] gap-[14px] bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700]">
                <div class="w-20 h-20 flex shrink-0 rounded-2xl bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ Storage::url($shoe->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                </div>
                <div class="flex w-full items-center justify-between gap-[14px]">
                    <div class="flex flex-col gap-[6px]">
                        <h3 class="font-bold leading-[20px]">{{ $shoe->name }}</h3>
                        <p class="text-sm leading-[21px] text-[#878785]">{{ $shoe->category->name }}</p>
                    </div>
                    <div class="flex flex-col gap-1 items-end shrink-0">
                        <div class="flex">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                        </div>
                        <p class="font-semibold text-sm leading-[21px]">4.5</p>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <p>Tidak ada produk sesuai dengan keyword</p>
        @endforelse


    </section>

</x-layouts.app>
