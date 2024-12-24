<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">


  <!-- Bootstrap CSS v5.2.1 -->

  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <link rel="shortcut icon" href="https://suustore.com/assets/frontend/images/favicon.ico" type="image/x-icon">



  <script>
    window.SuuTruyen = {
      baseUrl: 'https://suustore.com',
      urlCurrent: 'https://suustore.com',
      csrfToken: '4EebYu2rWivdRk1ET12dyuY0CJjpRERhJynPtvUy'
    }
  </script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body style="background-color:#121214;">
  @include('layouts.header')
  @section('detail')
  @show
  @section('content1')
  @show
  @section('support')
  @show
  @section('create')
  @show
  @section('profile')
  @show
  @section('edit')
  @show

  @include('layouts.footer')
</body>

</html>