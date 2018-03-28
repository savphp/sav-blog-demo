<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{$title}}</title>
</head>
<body>
  @yield('content')
  <br>
  访问统计: {{$viewCount}}
</body>
</html>