<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Starter</title>
  <title>{{ setting('name') }}</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset ('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('backend/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset ('backend/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset ('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <style>
    /*!
    * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
    * Copyright 2015 Daniel Cardoso <@DanielCardoso>
    * Licensed under MIT
    */
    .la-ball-spin,
    .la-ball-spin > div {
        position: relative;
        -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
                box-sizing: border-box;
    }
    .la-ball-spin {
        display: block;
        font-size: 0;
        color: #fff;
    }
    .la-ball-spin.la-dark {
        color: #333;
    }
    .la-ball-spin > div {
        display: inline-block;
        float: none;
        background-color: currentColor;
        border: 0 solid currentColor;
    }
    .la-ball-spin {
        width: 32px;
        height: 32px;
    }
    .la-ball-spin > div {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 8px;
        height: 8px;
        margin-top: -4px;
        margin-left: -4px;
        border-radius: 100%;
        -webkit-animation: ball-spin 1s infinite ease-in-out;
          -moz-animation: ball-spin 1s infinite ease-in-out;
            -o-animation: ball-spin 1s infinite ease-in-out;
                animation: ball-spin 1s infinite ease-in-out;
    }
    .la-ball-spin > div:nth-child(1) {
        top: 5%;
        left: 50%;
        -webkit-animation-delay: -1.125s;
          -moz-animation-delay: -1.125s;
            -o-animation-delay: -1.125s;
                animation-delay: -1.125s;
    }
    .la-ball-spin > div:nth-child(2) {
        top: 18.1801948466%;
        left: 81.8198051534%;
        -webkit-animation-delay: -1.25s;
          -moz-animation-delay: -1.25s;
            -o-animation-delay: -1.25s;
                animation-delay: -1.25s;
    }
    .la-ball-spin > div:nth-child(3) {
        top: 50%;
        left: 95%;
        -webkit-animation-delay: -1.375s;
          -moz-animation-delay: -1.375s;
            -o-animation-delay: -1.375s;
                animation-delay: -1.375s;
    }
    .la-ball-spin > div:nth-child(4) {
        top: 81.8198051534%;
        left: 81.8198051534%;
        -webkit-animation-delay: -1.5s;
          -moz-animation-delay: -1.5s;
            -o-animation-delay: -1.5s;
                animation-delay: -1.5s;
    }
    .la-ball-spin > div:nth-child(5) {
        top: 94.9999999966%;
        left: 50.0000000005%;
        -webkit-animation-delay: -1.625s;
          -moz-animation-delay: -1.625s;
            -o-animation-delay: -1.625s;
                animation-delay: -1.625s;
    }
    .la-ball-spin > div:nth-child(6) {
        top: 81.8198046966%;
        left: 18.1801949248%;
        -webkit-animation-delay: -1.75s;
          -moz-animation-delay: -1.75s;
            -o-animation-delay: -1.75s;
                animation-delay: -1.75s;
    }
    .la-ball-spin > div:nth-child(7) {
        top: 49.9999750815%;
        left: 5.0000051215%;
        -webkit-animation-delay: -1.875s;
          -moz-animation-delay: -1.875s;
            -o-animation-delay: -1.875s;
                animation-delay: -1.875s;
    }
    .la-ball-spin > div:nth-child(8) {
        top: 18.179464974%;
        left: 18.1803700518%;
        -webkit-animation-delay: -2s;
          -moz-animation-delay: -2s;
            -o-animation-delay: -2s;
                animation-delay: -2s;
    }
    .la-ball-spin.la-sm {
        width: 16px;
        height: 16px;
    }
    .la-ball-spin.la-sm > div {
        width: 4px;
        height: 4px;
        margin-top: -2px;
        margin-left: -2px;
    }
    .la-ball-spin.la-2x {
        width: 64px;
        height: 64px;
    }
    .la-ball-spin.la-2x > div {
        width: 16px;
        height: 16px;
        margin-top: -8px;
        margin-left: -8px;
    }
    .la-ball-spin.la-3x {
        width: 96px;
        height: 96px;
    }
    .la-ball-spin.la-3x > div {
        width: 24px;
        height: 24px;
        margin-top: -12px;
        margin-left: -12px;
    }
    /*
    * Animation
    */
    @-webkit-keyframes ball-spin {
        0%,
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
                    transform: scale(1);
        }
        20% {
            opacity: 1;
        }
        80% {
            opacity: 0;
            -webkit-transform: scale(0);
                    transform: scale(0);
        }
    }
    @-moz-keyframes ball-spin {
        0%,
        100% {
            opacity: 1;
            -moz-transform: scale(1);
                transform: scale(1);
        }
        20% {
            opacity: 1;
        }
        80% {
            opacity: 0;
            -moz-transform: scale(0);
                transform: scale(0);
        }
    }
    @-o-keyframes ball-spin {
        0%,
        100% {
            opacity: 1;
            -o-transform: scale(1);
              transform: scale(1);
        }
        20% {
            opacity: 1;
        }
        80% {
            opacity: 0;
            -o-transform: scale(0);
              transform: scale(0);
        }
    }
    @keyframes ball-spin {
        0%,
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
              -moz-transform: scale(1);
                -o-transform: scale(1);
                    transform: scale(1);
        }
        20% {
            opacity: 1;
        }
        80% {
            opacity: 0;
            -webkit-transform: scale(0);
              -moz-transform: scale(0);
                -o-transform: scale(0);
                    transform: scale(0);
        }
    }
  </style>
   <livewire:styles />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

   @include('layouts.partials.navbar')

  <!-- Main Sidebar Container -->
  @include('layouts.partials.aside')


    <div class="content-wrapper">
        {{ $slot }}
    </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<!-- ./wrapper -->
<script>

    $(document).ready(function(){
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
      }
    });
    window.addEventListener('hide-form', event =>{
      $('#form').modal('hide');
      toastr.success(event.detail.message,'success!')
    })
</script>
<script>
  window.addEventListener('show-form', event =>{
    $('#form').modal('show');
  })
  window.addEventListener('hide-form', event =>{
    $('#form').modal('hide');
    toastr.success(event.detail.message,'success!')
  })
  window.addEventListener('show-delete-modal', event =>{
    $('#confirmationModal').modal('show');
  })
  window.addEventListener('hide-delete-model', event =>{
    $('#confirmationModal').modal('hide');
    toastr.success(event.detail.message,'success!')
  })
</script>
<script>
  $(document).ready(function(){
    $('#appointmentDate').datetimepicker({
      format : 'L',
    });
  });

  $('#appointmentDate').on("change.datetimepicker".function(e){
    let date = $(this).data('appointmentdate');
    eval(date).set('state.date',$('#appointmentDate').val());
  });
</script>
<!-- REQUIRED SCRIPTS -->
 <livewire:scripts />
<!-- jQuery -->
  <script type="text/javascript" src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script type="text/javascript" src="https://unpkg.com/moment"></script>
<script src="{{ asset ('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('backend/dist/js/adminlte.min.js')}}"></script>
<!-- DataTables -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script src="{{ asset ('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset ('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset ('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
</body>
</html>
