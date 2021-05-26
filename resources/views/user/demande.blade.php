<div id="theDemande">

<title>طلب رخصة</title>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'rtl')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<link href="css/tablee.css" rel="stylesheet" media="all">

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
                @foreach($list as $l)
                    <option value="{{$l['id']}}">{{$l['name']}}</option>
                @endforeach
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

        
$('.close').click(function(){
    $('#myModal').modal('hide');
});
//  function loadSer(){
//     $.ajax({
//         url:"{{url('getEmployeeService')}}",
//         type: 'get',
//         success:function(res){
//             for(var i = 0 ;i<res.list.length;i++)
//                  {
//                     $('#adjoint').append("<option value=\""+res.list[i].id+"\">"+res.list[i].name+"</option>");
//                  }
//         }
//     });
// };
        
        $("form").on('submit', function(e){
            e.preventDefault();

            if ($("#jusqua").val() <= $("#de").val()) {
                $('#text-p').text('المرجو وضع فترة صحيحة !!')
                $('#myModal').modal('show');               
            }
            else if($("#jusqua").val() > $("#de").val()){

                if($.datepicker.formatDate("yy-mm-dd",new Date()) >= $("#de").val()){
                    $('#text-p').text('المرجو وضع فترة صحيحة !!')
                    $('#myModal').modal('show');
                }
                else{
                    var formData =  $('form').serializeArray();
                    console.log(formData);
                    $.ajax({
                        url:"{{url('newDemande')}}",
                        type: 'post',
                        data: formData,
                        success:function(res){
                            //alert("تم وضع الطلب بنجاح !!");
                            $('#text-p').text('تم وضع الطلب بنجاح !!')
                            $('#myModal').modal('show');
                            $("#jusqua, #de").val("");
                        },
                        error:function(res){
                            //alert("المعذرة !! لا تتوفرون على هذه الفترة");
                            $('#text-p').text('المعذرة !! لا تتوفرون على هذه الفترة')
                            $('#myModal').modal('show');
                        }
                    });
                }
            }
        });
    </script>

</x-app-layout>
</div>