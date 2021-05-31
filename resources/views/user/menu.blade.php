<x-slot name="header">
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
        <div class="flex justify-between h-16" style="margin-top:-2%;">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('الصفحة الرئيسية') }}
                    </x-nav-link>
                </div>
            </div>


            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link id="dem" :href="route('demande')" :active="request()->routeIs('demande')">
                        {{ __('طلب رخصة') }}
                    </x-nav-link>
                </div>
            </div>


            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('demandes')" :active="request()->routeIs('demandes')">
                        {{ __('لائحة طلبات النيابة') }}
                    </x-nav-link>
                </div>
            </div>

            @if(auth()->user()->type == "chef")
                <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('service')" :active="request()->routeIs('service')">
                        {{ __('طلبات الموظفين') }}
                    </x-nav-link>
                </div>
            </div>
            @endif


            @if(auth()->user()->id==2 || auth()->user()->id==86)
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('password')" :active="request()->routeIs('password')">
                        {{ __('تعديل كلمة المرور') }}
                    </x-nav-link>
                </div>
            </div>
            @endif
            
        </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    </div>
</nav>
    </x-slot>