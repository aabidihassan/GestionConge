@if(auth()->user()->type!="admin")
<script>window.location = "/dashboard";</script>
@endif

<title>لائحة الطلبات</title>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'rtl')}}">
<link href="css/tablee.css" rel="stylesheet" media="all">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


<style>
    .cls{
        width:9%;
    }
</style>
<x-app-layout>
    <x-slot name="header">
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
        <div class="flex justify-between h-16" style="margin-top:-2%;">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('لائحة الموظفين') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('employees')" :active="request()->routeIs('employees')">
                        {{ __('لائحة عطل الموظفين') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('demandes')" :active="request()->routeIs('demandes')">
                        {{ __('طلبات الموظفين') }}
                    </x-nav-link>
                </div>
            </div>
            
        </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    </div>
</nav>
    </x-slot>

<form method="post" action="{{route('getEmployees')}}">
@csrf
    <table align="center" style="width: 60%;">
    <thead>
        <tr>
            <td class="cls">القسم : </td>
            <td colspan="2">
                <select id="service" name="service" class="input">
                    @foreach($list as $row)

                    <option value="{{$row['id']}}">{{$row['nom']}}</option>

                    @endforeach
                    </select>
            </td>
            <td class="cls">شهر : </td>
            <td>
                <select id="mois" name="mois" class="input">
                    @for($i = 1; $i < 13; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </td>
            <td class="cls">
            <button id="sub" style="width:90%;">بحث</button>
            </td>
        </tr>
        </thead>
    </table>
</form>

<center>
<h1 id="nothing" style="margin-top:2%;">لا توجد أي عطل</h1>
<table id="nb" align="center" style="width: 50%;">
    <tbody>

    </tbody>
</table>
</center>



<table id="mytable" align="center" style="width: 90%;">
    <thead>
    <tr><th>رقم الطلب</th><th>الطالب</th><th>من</th><th>الى</th><th>نوع الرخصة</th><th>القائم بالنيابة</th></tr>
    
    </thead>
    <tbody>

    </tbody>
</table>

<center>
<div id="chartContainer" style="height: 370px; width: 70%; margin-top:3%; margin-bottom:3%;"></div>
</center>








<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

<script>
    $('#mytable').hide();
    $('#nothing').hide();
    $('#nb').hide();
    $('form').on('submit', function(e){
        e.preventDefault();
        $('#mytable tbody').empty();
        $('#nb tbody').empty();
        $('#nothing').hide();
        $('#mytable').hide();
        var formData =  $('form').serializeArray();
        $.ajax({
            url:"{{url('getEmployees')}}",
            type: 'post',
            data: formData,
            success:function(res){
                 console.log(res.lt);
                if(res.lt.length==0){
                    $('#nothing').show();
                }else{
               $('#mytable').show();
               $('#nb').show();
               $('#nb tbody').eq(0).append("<tr>");
               $('#nb tbody').eq(0).append("<td>عدد الموظفين بهذا القسم :</td>");
               $('#nb tbody').eq(0).append("<td>"+res.nb+"</td></tr>");
               $('#nb tbody').eq(0).append("<tr>");
               $('#nb tbody').eq(0).append("<td>أقل عدد :</td>");
               $('#nb tbody').eq(0).append("<td>"+res.min['minim']+"</td></tr>");
               for(var i = 0 ;i<res.lt.length;i++){
                 
                    $('#mytable tbody').eq(0).append("<tr>");
                    $('#mytable tbody').eq(0).append("<td>"+res.lt[i].referance+"</td>");
                    $('#mytable tbody').eq(0).append("<td>"+res.lt[i].name+"</td>");
                    $('#mytable tbody').eq(0).append("<td>"+res.lt[i].date_debut+"</td>");
                    $('#mytable tbody').eq(0).append("<td>"+res.lt[i].date_fin+"</td>");

                    switch(res.lt[i].type_vac){
                        case 1: $('#mytable tbody').eq(0).append("<td>عطلة سنوية</td>"); break;
                        case 2: $('#mytable tbody').eq(0).append("<td>اذن بالتغيب</td>"); break;
                    }
                    $('#mytable tbody').eq(0).append("<td>"+res.list[i].ad+"</td>");
                   $('#mytable tbody').eq(0).append("</tr>");
                 }
                }
                
            }
        });
    });
</script>







</x-app-layout>