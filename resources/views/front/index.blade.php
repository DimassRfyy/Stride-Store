<x-layouts.app>
    <x-slot:title>
        Home
    </x-slot:title>
    <x-slot:topbar>
        <img src="{{ asset('assets/images/logos/stride-logo.png') }}" class="flex shrink-0" alt="logo">
        <a href="#">
            <img src="{{ asset('assets/images/icons/notification.svg') }}" class="w-10 h-10" alt="icon">
        </a>
    </x-slot:topbar>
    <form action="{{ route('front.search') }}" class="flex justify-between items-center mx-4">
        <div class="relative flex items-center w-full rounded-l-full px-[14px] gap-[10px] bg-white transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
            <img src="{{ asset('assets/images/icons/search-normal.svg') }}" class="w-6 h-6" alt="icon">
            <input type="text" name="keyword" class="w-full py-[14px] appearance-none bg-white outline-none font-semibold placeholder:font-normal placeholder:text-[#878785]" placeholder="Search product...">
        </div>
        <button type="submit" class="h-full rounded-r-full py-[14px] px-5 bg-[#C5F277]">
            <span class="font-semibold">Explore</span>
        </button>
    </form>
    <section id="category" class="flex flex-col gap-4 px-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold leading-[20px]">Our Featured <br>Categories</h2>
            <a href="category.html" class="rounded-full p-[6px_14px] border border-[#2A2A2A] text-xs leading-[18px]">
                View All
            </a>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @forelse($categories as $item)
            <a href="{{ route('front.category', $item->slug) }}">
                <div class="flex items-center justify-between w-full rounded-2xl overflow-hidden bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700]">
                    <div class="flex flex-col gap-[2px] px-[14px]">
                        <h3 class="font-bold text-sm leading-[21px]">{{ $item->name }}</h3>
                        <p class="text-xs leading-[18px] text-[#878785]">{{ $item->shoes->count() }} Shoes</p>
                    </div>
                    <div class="flex shrink-0 w-20 h-[90px] overflow-hidden">
                        <img src="{{ Storage::url($item->icon) }}" class="w-full h-full object-cover object-left" alt="thumbnail">
                    </div>
                </div>
            </a>
            @empty
            <p>There's no category available</p>
            @endforelse
        </div>
    </section>
    <section id="brands" class="flex flex-col gap-4 px-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold leading-[20px]">Our Featured <br>Brands</h2>
            <a href="brands.html" class="rounded-full p-[6px_14px] border border-[#2A2A2A] text-xs leading-[18px]">
                View All
            </a>
        </div>
        <div class="grid grid-cols-3 gap-4">
            @forelse($brands as $brand)
            <a href="{{ route('front.brand', $brand->slug) }}">
                <div class="flex flex-col items-center justify-center w-full rounded-2xl overflow-hidden bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700] p-1">
                    <div class="flex w-20 h-20 overflow-hidden">
                        <img src="{{ Storage::url($brand->logo) }}" class="w-full h-full object-contain" alt="Brand Logo">
                    </div>
                </div>
            </a>
            @empty
            <p>There's no brand available</p>
            @endforelse
        </div>
    </section>
    <section id="featured" class="flex flex-col gap-4">
        <div class="flex items-center justify-between px-4">
            <h2 class="font-bold leading-[20px]">Explore Our <br>Featured</h2>
            <a href="#" class="rounded-full p-[6px_14px] border border-[#2A2A2A] text-xs leading-[18px]">
                View All
            </a>
        </div>
        <div class="swiper w-full overflow-hidden">
            <div class="swiper-wrapper">
                @forelse($popularShoes as $item)
                <div class="swiper-slide !w-fit py-[2px]">
                    <a href="{{ route('front.details', $item->slug) }}">
                        <div class="flex flex-col shrink-0 w-[230px] h-full rounded-3xl gap-[14px] p-[10px] pb-4 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700]">
                            <div class="w-[210px] h-[230px] rounded-3xl bg-[#D9D9D9] overflow-hidden">
                                <img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[14px] justify-between">
                                <div class="flex items-center justify-between gap-4">
                                    <h3 class="font-bold leading-[20px]">{{ $item->name }}</h3>
                                    <p class="font-bold text-sm leading-[21px] text-nowrap">Rp{{ number_format($item->price, 0, ',','.') }}</p>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-1">
                                        <img src="assets/images/icons/Star 1.svg" class="w-[22px] h-[22px]" alt="star">
                                        <p class="font-semibold text-sm leading-[21px]">4.5</p>
                                    </div>
                                    <p class="text-sm leading-[21px] text-[#878785]">(18,485 reviews)</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <p>There's no item available</p>
                @endforelse
            </div>
        </div>
    </section>
    
    <section id="fresh" class="flex flex-col gap-4 px-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold leading-[20px]">Fresh From <br>Great Designers</h2>
            <a href="#" class="rounded-full p-[6px_14px] border border-[#2A2A2A] text-xs leading-[18px]">
                View All
            </a>
        </div>
        <div class="flex flex-col gap-4">
            @forelse($newShoes as $item)
            <a href="{{ route('front.details', $item->slug) }}">
                <div class="flex items-center rounded-3xl p-[10px_16px_16px_10px] gap-[14px] bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700]">
                    <div class="w-20 h-20 flex shrink-0 rounded-2xl bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                    </div>
                    <div class="flex w-full items-center justify-between gap-[14px]">
                        <div class="flex flex-col gap-[6px]">
                            <h3 class="font-bold leading-[20px]">{{ $item->name }}</h3>
                            <p class="text-sm leading-[21px] text-[#878785]">{{ $item->category->name }}</p>
                        </div>
                        <div class="flex flex-col gap-1 items-end shrink-0">
                            <div class="flex">
                                <img src="assets/images/icons/Star 1.svg" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                <img src="assets/images/icons/Star 1.svg" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                <img src="assets/images/icons/Star 1.svg" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                <img src="assets/images/icons/Star 1.svg" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                <img src="assets/images/icons/Star 1.svg" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                            </div>
                            <p class="font-semibold text-sm leading-[21px]">4.5</p>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <p>There's no item available</p>
            @endforelse
        </div>
    </section>
    <x-layouts.nav-bottom />
    <x-slot:script>
        <script src="{{ asset('js/index.js') }}"></script>

    </x-slot:script>
</x-layouts.app>
