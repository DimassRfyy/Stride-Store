<div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0">
    <nav class="fixed bottom-5 w-full max-w-[640px] px-4 z-30">
        <div class="grid grid-flow-col auto-cols-auto items-center justify-between rounded-full bg-[#2A2A2A] p-2 px-[30px]">
            <a href="{{ route('front.index') }}" class="flex shrink-0 -mx-[22px] {{ request()->routeIs('front.index') ? 'active' : '' }}">
                <div class="flex items-center rounded-full gap-[10px] p-[12px_16px] {{ request()->routeIs('front.index') ? 'bg-[#C5F277]' : '' }}">
                    <img src="{{ request()->routeIs('front.index') ? 'assets/images/icons/3dcube.svg' : 'assets/images/icons/3dcube-white.svg' }}" class="w-6 h-6" alt="icon">
                    @if(request()->routeIs('front.index'))
                        <span class="font-bold text-sm leading-[21px]">Browse</span>
                    @endif
                </div>
            </a>
            <a href="{{ route('front.check_booking') }}" class="flex shrink-0 -mx-[22px] {{ request()->routeIs('front.check_booking') ? 'active' : '' }}">
                <div class="flex items-center rounded-full gap-[10px] p-[12px_16px] {{ request()->routeIs('front.check_booking') ? 'bg-[#C5F277]' : '' }}">
                    <img src="{{ request()->routeIs('front.check_booking') ? 'assets/images/icons/bag-2.svg' : 'assets/images/icons/bag-2-white.svg' }}" class="w-6 h-6" alt="icon">
                    @if(request()->routeIs('front.check_booking'))
                        <span class="font-bold text-sm leading-[21px]">Check Order</span>
                    @endif
                </div>
            </a>
            <a href="#" class="flex shrink-0 -mx-[22px] {{ request()->routeIs('front.star') ? 'active' : '' }}">
                <div class="flex items-center rounded-full gap-[10px] p-[12px_16px] {{ request()->routeIs('front.star') ? 'bg-[#C5F277]' : '' }}">
                    <img src="{{ request()->routeIs('front.star') ? 'assets/images/icons/star.svg' : 'assets/images/icons/star-white.svg' }}" class="w-6 h-6" alt="icon">
                    @if(request()->routeIs('front.star'))
                        <span class="font-bold text-sm leading-[21px]">Favorites</span>
                    @endif
                </div>
            </a>
            <a href="#" class="flex shrink-0 -mx-[22px] {{ request()->routeIs('front.support') ? 'active' : '' }}">
                <div class="flex items-center rounded-full gap-[10px] p-[12px_16px] {{ request()->routeIs('front.support') ? 'bg-[#C5F277]' : '' }}">
                    <img src="{{ request()->routeIs('front.support') ? 'assets/images/icons/24-support.svg' : 'assets/images/icons/24-support-white.svg' }}" class="w-6 h-6" alt="icon">
                    @if(request()->routeIs('front.support'))
                        <span class="font-bold text-sm leading-[21px]">Support</span>
                    @endif
                </div>
            </a>
        </div>
    </nav>
</div>