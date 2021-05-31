@if(auth()->user()->id!=86 && auth()->user()->id!=2)
<script>window.location = "/dashboard";</script>
@endif
<title>تغيير كلمة المرور</title>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'rtl')}}">
<link href="css/tablee.css" rel="stylesheet" media="all">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<style>
    img:hover{
        cursor: pointer;
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
          <h4 class="modal-title">كلمة مرور جديدة :</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form id="serv" method="POST" action="{{route('changeService')}}">
        @csrf
        <input id="serviceUpdate" type="text" name="pass" data="null" class="input" style="width:80%;">
        
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-default" id="done" data-dismiss="modal" style="background-color: green; color:white;">حفظ</button>
        <button type="button" class="btn btn-default close" id="close" data-dismiss="modal" style="background-color: red; color:white;">اغلاق</button>
        </form>
        </div>
      </div>
      
    </div>
  </div>


    <form id="search" method="post" action="{{route('getEmployees')}}">
@csrf
    <table align="center" style="width: 60%;">
    <thead>
        <tr>
            <td class="cls">القسم : </td>
            <td>
                <select id="service" name="service" class="input" style="width:80%;" >

                    <option selected disabled>اختر القسم</option>

                    @foreach($list as $row)

                    <option value="{{$row['id']}}">{{$row['nom']}}</option>

                    @endforeach

                </select>
            </td>
        </tr>
        </thead>
    </table>
</form>

<center>
<h1 id="nothing" style="margin-top:2%;">لا بوجد أي موظف بهذا القسم</h1>
</center>

<table id="mytable" align="center" style="width: 90%; margin-bottom:3%;">
    <thead>
    <tr><th>اسم الموظف</th><th>القسم</th><th></th></tr>
    
    </thead>
    <tbody>

    </tbody>
</table>



<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $("#service").change(function(){
        $('#search').submit();
    });
    $('#mytable').hide();
    $('#nothing').hide();
    $('#search').on('submit', function(e){
        e.preventDefault();
        $('#mytable tbody').empty();
        $('#nothing').hide();
        $('#mytable').hide();
        var formData =  $('form').serializeArray();
        $.ajax({
            url:"{{url('employees')}}",
            type: 'post',
            data: formData,
            success:function(res){
                 console.log(res.lt);
                if(res.lt.length==0){
                    $('#nothing').show();
                }else{  
                    var hh =[];     
               $('#mytable').show();
               for(var i = 0 ;i<res.lt.length;i++){
                 
                    $('#mytable tbody').eq(0).append("<tr>");
                    $('#mytable tbody').eq(0).append("<td>"+res.lt[i].name+"</td>");
                    $('#mytable tbody').eq(0).append("<td class=\"ser\">"+res.lt[i].nom+"</td><td><img class=\"imaa\" src=\"images/pen.png\" style=\"width:20px; height:20px;\" onclick=\"logo(this)\" data=\""+res.lt[i].id_user+"\">");

                   $('#mytable tbody').eq(0).append("</td></tr>");
                 }

                }
                
            }
        });
    });

    $('.close').click(function(){
        $('#myModal').modal('hide');
    })
    $('#serv').on('submit', function(e){
        e.preventDefault();
        var formData = $('#serv').serializeArray();
        formData.push({name:'idEmp', value: $('#serviceUpdate').attr('data')});
        $.ajax({
            url:"{{url('changePass')}}",
            type: 'post',
            data: formData,
            success:function(res){
                $('#myModal').modal('hide');
                $('#serviceUpdate').attr('data',"null");
                $('#search').submit();
                alert('تم التعديل بنجاح');
            }
        });
    });

function logo(param){
    $('#myModal').modal('show');
    $('#serviceUpdate').attr('data',$(param).attr("data"));
    
}
</script>






</x-app-layout>