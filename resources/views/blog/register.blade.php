<html>
    <head>
        <title>Trang đăng ký thành viên </title>
        <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" > 
    
    </head>
    <body>
        <header>
            <div class="container">
            <a href="{{ url('register') }}">Đăng ký</a>
            <a href="{{ url('login') }}">Đăng nhập</a>
            <a href="{{ url('blog/create') }}">Tạo blog</a>
            </div>
        </header>
        <div class="container">
        <div class="alert alert-success">Đăng ký thành viên</div>
        <div class="row">
        </div class="col-12">
        <form action="{{url('register') }}" method="POST">
           <input type="email" name="email" placeholder="Email">
           <input type="password" name="password" placeholder="Password">
           <input type="submit" value="Đăng ký">
        </form>
    </div>
   
</div>
        <footer>
            <div>Copy right @ {{date('Y')  }}</div>
        </footer>
    </body>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
</html>