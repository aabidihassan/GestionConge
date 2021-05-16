<title>واجهة المستخدم</title>
<link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
<script>
window.onload = function () {

// Construct options first and then pass it as a parameter
var options = {
	title: {
		text: "عدد الأيام المستهلكة حسب السنوات"              
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "column",
		dataPoints: [
			{ label: "2019", y: {{$a2019}}  },
			{ label: "2020", y: {{$a2020}}  },
			{ label: "2021", y: {{$a2021}}  }
		]
	}
	]
};

$("#chartContainer").CanvasJSChart(options);

$('.canvasjs-chart-credit').hide();
}
</script>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'rtl')}}">

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
    





























<center>
<div id="chartContainer" style="height: 370px; width: 80%; margin-top:3%;"></div>
</center>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>





</x-app-layout>