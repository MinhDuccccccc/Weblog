<html>
    <head>
        <title>Welcome to our Blog</title>
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
        <div class="alert alert-success">Xin chào, đây là blog của tôi</div>
        <div class="row">
        </div class="col-3"><a href="">Tiêu đề</a>/div>   
        </div class="col-9">Nội dung</div>
    </div>
    <div class="row">
    </div class="col-3"><a href="">Tiêu đề</a>/div>   
    </div class="col-9">Nội dung</div>
</div>
     <div class="row">
     </div class="col-3"><a href="">Tiêu đề</a>/div>   
     </div class="col-9">Nội dung</div>
</div>  
   <div class="row">
   </div class="col-3"><a href="">Tiêu đề</a>/div>   
   </div class="col-9">Nội dung</div>
</div>

</div>
        <footer>
            <div>Copy right @ {{date('Y')  }}</div>
        </footer>
    </body>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
</html>