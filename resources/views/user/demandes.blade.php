<title>لائحة الطلبات</title>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'rtl')}}">
<link href="css/tablee.css" rel="stylesheet" media="all">

<x-app-layout>
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
                    <x-nav-link :href="route('demande')" :active="request()->routeIs('demande')">
                        {{ __('طلب رخصة') }}
                    </x-nav-link>
                </div>
            </div>


            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('demandes')" :active="request()->routeIs('demandes')">
                        {{ __('لائحة الطلبات') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('restant')">
                        {{ __('لوحة القيادة') }}
                    </x-nav-link>
                </div>
            </div>
            
        </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    </div>
</nav>
    </x-slot>

    <table align="center" style="width: 90%;">
    <thead>
    <tr><th>نوع الرخصة</th><th>السنة</th><th>من</th><th>الى</th><th>القائم بالنيابة</th></tr>
    @foreach($list as $l)
    <tr>
        <td>{{$l['type']}}</td>
        <td>{{$l['type']}}</td>
        <td>{{$l['de']}}</td>
        <td>{{$l['jusqua']}}</td>
        <td>{{$l['adjoint']}}</td>
    </tr>
    @endforeach
    </thead>
    <tbody>
    </tbody>
    </table>



</x-app-layout>