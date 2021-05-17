<title>طلب رخصة</title>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'rtl')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        {{ __('لائحة طلبات  النيابة') }}
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
    
<center><h1 id="para"></h1></center>
<form method="POST" action="{{route('newDemande')}}">
@csrf
    <table align="center" style="width: 70%; border: 4px solid black;">
    <tbody>
    <tr>
        <td class="cls">نوع الرخصة :</td>
        <td colspan="2">
            <select name="type" id="type" class="input">
                <option value="1">عطلة سنوية</option>
                <option value="2">اذن بالتغيب</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="cls">السنة : </td>
        <td colspan="2">
            <select name="annee" id="annee" class="input">
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
            </select></td>
    </tr>
    <tr>
        <td class="cls">الفترة : </td>
        <td>من: <input name="de" type="text" id="de" style="width:80%; border-radius:6px;" required></td>
        <td>الى: <input name="jusqua" type="text" id="jusqua" style="width:80%; border-radius:6px;" required></td>
    </tr>
    <tr>
        <td class="cls">القائم بالنيابة : </td>
        <td colspan="2">
            <select id="adjoint" name="adjoint" class="input">
                <option value="1">أحمد</option>
                <option value="2">محمد</option>
                <option value="3">يونس</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <button id="sub">وضع الطلب</button>
            <input type="reset" value="افراغ">
        </td>
        
    </tr>
    </tbody>
    </table>
    </form>



    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script>
        (function( factory ) {
            if ( typeof define === "function" && define.amd ) {

                define([ "../jquery.ui.datepicker" ], factory );
            } else {

                factory( jQuery.datepicker );
            }
        }
        (function( datepicker ) {
            datepicker.regional['ar'] = {
                closeText: 'إغلاق',
                prevText: '&#x3C;السابق',
                nextText: 'التالي&#x3E;',
                currentText: 'اليوم',
                monthNames: ['يناير', 'فبراير', 'مارس', 'أبريل', 'ماي', 'يونيو',
                'يوليوز', 'غشت', 'شتنبر',	'أكتوبر', 'نونبر', 'دجنبر'],
                monthNamesShort: ['يناير', 'فبراير', 'مارس', 'أبريل', 'ماي', 'يونيو',
                'يوليوز', 'غشت', 'شتنبر',	'أكتوبر', 'نونبر', 'دجنبر'],
                dayNames: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
                dayNamesShort: ["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday"],
                //dayNamesMin: ['أ', 'ن', 'ث', 'ر', 'خ', 'ج', 'س'],
                dayNamesMin: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
                weekHeader: 'أسبوع',
                dateFormat: 'yy-mm-dd',
                firstDay: 6,
                isRTL: true,
                showMonthAfterYear: false,
                yearSuffix: ''};
            datepicker.setDefaults(datepicker.regional['ar']);

            return datepicker.regional['ar'];

        }));
        $('#de, #jusqua').attr('autocomplete','off');
        $( "#de, #jusqua" ).datepicker({
            isRTL:false,
            changeMonth: true,
            changeYear: true
        });

        


        
        $("form").on('submit', function(e){
            //e.preventDefault();

            if ($("#jusqua").val() <= $("#de").val()) {
                alert("المرجو وضع فترة صحيحة !!");                
            }
            else if($("#jusqua").val() > $("#de").val()){

                if($.datepicker.formatDate("yy-mm-dd",new Date()) >= $("#de").val()){
                    alert("المرجو وضع فترة صحيحة !!");
                }
                else{
                    var formData =  $('form').serializeArray();
                    console.log(formData);
                    $.ajax({
                        url:"{{url('newDemande')}}",
                        type: 'post',
                        data: formData,
                        success:function(res){
                            alert("تم وضع الطلب بنجاح !!");
                            $("#jusqua, #de").val("");
                        },
                        error:function(res){
                            alert("المعذرة !! لا تتوفرون على هذه الفترة");
                        }
                    });
                }
            }
        });
    </script>

</x-app-layout>