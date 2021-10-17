<!DOCTYPE html>
<html dir="rtl" lang="ar">
    <head>
        <title>أحمد بدر</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body { font-family: DejaVu Sans, sans-serif; }
        </style>
    </head>

    <body>
<h2 dir="rtl">السلام عليكم ورحمة الله وبركاته</h2>
@foreach($data as $key => $employee)
    <h1>معلومات الموظف</h1>
    <h2>user Name: {{ $employee->name }}</h2>
    <p>phone : {{$employee->phone}}</p>
    <p>email : {{$employee->email}}</p>
    <p>salary : {{$employee->salary}}</p>
    <p>department : {{$employee->department}}</p>
@endforeach
        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
