<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {!! $load_header !!}
    {!! $list->headerScript() !!}
    @yield('head')
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
    <div id="listing">
        @include('notification')
        @yield('content')
    </div>
</body>
</html>