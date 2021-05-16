<title>لائحة الطلبات</title>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'rtl')}}">
<link href="css/tablee.css" rel="stylesheet" media="all">
<style>
    input[type='submit']{
        cursor:pointer;
        width:120px;
        height:30px;
        background-color: green;
        color:white;
        border-radius:5px;
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
    <tr><th>رقم الطلب</th><th>المطالب</th><th>من</th><th>الى</th><th>نوع الرخصة</th><th>قبول أو رفض</th></tr>
    @foreach($list as $l)
    <tr>
        <td>{{$l['referance']}}</td>
        <td>{{$l['id_user']}}</td>
        <td>{{$l['date_debut']}}</td>
        <td>{{$l['date_fin']}}</td>
        <td>{{$l['type_vac']}}</td>
        <td>
        <div style="display: flex;">
            <form id="accept" method="POST" action="{{route('adjointAccepte')}}">
                @csrf
                <input type="text" value="{{$l['id']}}" name="id" hidden="true">
                <input type="submit" value="قبول" name="accept">
            </form>
            <form id="decline" method="POST" action="{{route('adjointDecline')}}">
                @csrf
                <input type="text" value="{{$l['id']}}" name="id" hidden="true">
                <input type="submit" value="رفض" name="decline" style="background-color:red;">
            </form>
        </div>
        </td>
    </tr>
    @endforeach
    </thead>
    <tbody>
    </tbody>
    </table>





    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $("#accept").on('submit', function(e){
            e.preventDefault();
            var idConge = $(this).closest("tr").find("input[name='id']").val();
            
            var formData =  $('#accept').serializeArray();
            formData.push({name: 'idd', value: idConge});
            formData.push({name: 'action', value: 2});
                console.log(formData);
                $(this).closest('tr').remove();
                $.ajax({
                    url:"{{url('adjointAccepte')}}",
                    type: 'post',
                    data: formData,
                    success:function(res){
                        alert("تم القبول بنجاح !!");
                    }
                });
        });

        $("#decline").on('submit', function(e){
            e.preventDefault();
            var idConge = $(this).closest("tr").find("input[name='id']").val();
            //var formData =  $('#accept').serializeArray();
            // formData.push({name: 'idd', value: idConge});
            // formData.push({name: 'action', value: 5});
                //console.log(formData);
            var formData ={
                idd: idConge,
                action: 5,
                _token:'{{ csrf_token() }}'
            };
            console.log(formData);
                $.ajax({
                    url:"{{url('adjointAccepte')}}",
                    type: 'post',
                    data: formData
                });
                alert("تم الرفض بنجاح !!");
                $(this).closest('tr').remove();
        });

    </script>



</x-app-layout>