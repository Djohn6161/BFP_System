<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <link href="{{asset('assets/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/select2/dist/js/select2.min.js')}}"></script>
</head>
<body>
    <select class="js-example-basic-single" name="state" style="width:100">
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
      </select>
      <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
      </script>
</body>
</html>