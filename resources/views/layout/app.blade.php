<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://document.cromacampus.com/public/images/favicon.svg" type="image/ico">
      <title>Document Upload Application </title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="{{basepath('css/bootstrap.min.css')}}">
    <!-- Style -->
    <link rel="stylesheet" href="{{basepath('css/style2.css')}}">
    <link rel="stylesheet" href="{{basepath('css/responsive.css')}}">
    <link rel="stylesheet" href="{{basepath('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{basepath('css/dataTables.min1.css')}}">
    <link rel="stylesheet" href="{{basepath('css/buttons.dataTables.min1.css')}}">


    </head>
    <body>
        
        <div class="main-site">
            @include('layout.header')

            @yield('main')

         </div>



    <script src="{{basepath('js/jquery-3.3.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="{{basepath('js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{basepath('js/dataTables.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="{{basepath('js/main2.js')}}"></script>
<script>
     $(document).ready(function(){
         
         $('.selectcol').select2();
         
         });
</script>

    
    @yield('script')

</body>
</html>