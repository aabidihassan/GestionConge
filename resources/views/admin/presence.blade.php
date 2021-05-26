<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="css/presence.css"/>
<script>
window.print();
</script>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin-top: 2%;  /* this affects the margin in the printer settings */
}
/* @media print {
  div.divFooter {
    position: fixed;
    top: 0;
  }
} */
</style>
</head>
<body dir="rtl">
<div class="divFooter">
<img src="images/header.png" class="header">
<hr><hr>

<center>
    
    <h3 class="title">لائحة الحضور</h1>
    <h3>{{date('Y-m-d')}}</h1>
</center>
</div>
<center>
    <table>
        <thead>
        <tr>
            <th>الاسم والنسب</th>
            <th>الدخول</th>
            <th>الخروج</th>
            <th>ملاحظة</th>
        </tr>
        </thead>
        <tbody>
        @foreach($liste as $row)

            <tr>
                <td>{{$row->name}}</td>
                <td>
                @if($row->etat==2)
                    عطلة
                @endif
                </td>
                <td>
                @if($row->etat==2)
                    عطلة
                @endif</td>
                <td></td>
            </tr>

        @endforeach
        </tbody>
    </table>
</center>
</body>
</html>