@if(auth()->user()->type!="chef")
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
@include('user.menu')


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">الاجابة :</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p id="text-p"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default close" id="close" data-dismiss="modal" style="background-color: red; color:white;">اغلاق</button>
        </div>
      </div>
      
    </div>
  </div>


    <table align="center" style="width: 90%;">
    <thead>
    <tr><th>رقم الطلب</th><th>الطالب</th><th>من</th><th>الى</th><th>نوع الرخصة</th><th>القائم بالنيابة</th><th>قبول أو رفض</th></tr>
    @php($i =0)
    @foreach($list as $l)
    <tr>
        <td>{{$l['referance']}}</td>
        <td>{{$l['name']}}</td>
        <td>{{$l['date_debut']}}</td>
        <td>{{$l['date_fin']}}</td>
        <td>
            @switch($l['type_vac'])
                @case(1) عطلة سنوية @break
                @case(2) اذن بالتغيب @break
            @endswitch
        </td>
        <td>
            {{$lt[$i]['ad']}}
            @php($i++)
        </td>
        <td>
        <div style="display: flex;">
            <form id="accept" method="POST" action="{{route('serviceAccepte')}}">
                @csrf
                <input type="text" value="{{$l['id']}}" name="id" hidden="true">
                <input type="submit" value="قبول" name="accept">
            </form>
            <form id="decline" method="POST" action="{{route('serviceDecline')}}">
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

$('.close').click(function(){
    $('#myModal').modal('hide');
});

        $("#accept").on('submit', function(e){
            e.preventDefault();
            var idConge = $(this).closest("tr").find("input[name='id']").val();
            
            var formData ={
                idd: idConge,
                action: 2,
                _token:'{{ csrf_token() }}'
            };
                $(this).closest('tr').remove();
                $.ajax({
                    url:"{{url('serviceAccepte')}}",
                    type: 'post',
                    data: formData,
                    success:function(res){
                        $('#text-p').text('تم قبول الطلب بنجاح !!')
                        $('#myModal').modal('show');
                    }
                });
        });

        $("#decline").on('submit', function(e){
            e.preventDefault();
            var idConge = $(this).closest("tr").find("input[name='id']").val();
            var formData ={
                idd: idConge,
                action: 5,
                _token:'{{ csrf_token() }}'
            };
            $(this).closest('tr').remove();
                $.ajax({
                    url:"{{url('serviceAccepte')}}",
                    type: 'post',
                    data: formData,
                    success:function(res){
                        $('#text-p').text('تم رفض الطلب بنجاح !!')
                        $('#myModal').modal('show');
                    }
                });
        });

    </script>



</x-app-layout>