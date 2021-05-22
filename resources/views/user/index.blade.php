<!--
<div id="index">-->
<title>واجهة المستخدم</title>
<link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
<link href="css/tablee.css" rel="stylesheet" media="all">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script>
window.onload = function () {
    var r = 22-{{$a2021}};

// Construct options first and then pass it as a parameter
var options = {
	title: {
		text: "العطلة السنوية 2021"              
	},
	data: [           
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "doughnut",
		dataPoints: [
			{ label: "عدد الأيام المستهلكة : " + {{$a2021}}, y: {{$a2021}}  },
			{ label: "عدد الأيام المتبقية : " + r , y: 22-{{$a2021}}  }
		]
	}
	]
};

$("#chartContainer").CanvasJSChart(options);

$('.canvasjs-chart-credit').hide();
// $('#theDemande').hide();
// $('#dem').on("click", function(){
//     $('#theDemande').show();
//     $('#index').hide();
//     loadSer();
// });
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
            
        </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    </div>
</nav>
    </x-slot>

<center>
<div id="chartContainer" style="height: 370px; width: 80%; margin-top:3%;"></div>


@if(!$list->isEmpty())
<table align="center" style="width: 80%; margin-bottom:3%;">
    <thead>
    <tr><th>رقم الطلب</th><th>من</th><th>الى</th><th>نوع الرخصة</th><th>الحالة</th></tr>
    @foreach($list as $l)
    <tr>
        <td>{{$l['referance']}}</td>
        <td>{{$l['date_debut']}}</td>
        <td>{{$l['date_fin']}}</td>
        <td>
            @switch($l['type_vac'])
                @case(1) عطلة سنوية @break
                @case(2) اذن بالتغيب @break
            @endswitch
        </td>
        <td>
            @switch($l['etat'])
                @case(5) طلب مرفوض @break
                @case(1) في انتظار مراجعة النائب @break
                @case(2) في انتظار مراجعة رئيس القسم @break
                @case(3) في انتظار مراجعة الرئيس @break
                @case(4) طلب مقبول @break
            @endswitch
        </td>
    </tr>
    @endforeach
    </thead>
    <tbody>
    </tbody>
    </table>
@else
<h1 style="margin-top:3%; ">لا توجد لديك أي طلبات</h1>
@endif

</center>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>





</x-app-layout>
<!--</div>-->