<div class="container-fluid">
    <div id="carousel-id" class="carousel slide" data-ride="carousel" style="margin-bottom: 0;">
        <ol class="carousel-indicators">
            <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-id" data-slide-to="1" class=""></li>
            <li data-target="#carousel-id" data-slide-to="2" class=""></li>
            <li data-target="#carousel-id" data-slide-to="3" class=""></li>
            <li data-target="#carousel-id" data-slide-to="4" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide"
                    src="images/slide_banner/slide_1.jpg">
            </div>
            <div class="item ">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide"
                    src="images/slide_banner/slide_2.jpg">
            </div>
            <div class="item ">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide"
                    src="images/slide_banner/slide_3.jpg">
            </div>
            <div class="item ">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide"
                    src="images/slide_banner/File-1456730913.jpg">
            </div>
            <div class="item ">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide"
                    src="images/slide_banner/File-1440692711.jpg">
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span
                class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#carousel-id" data-slide="next"><span
                class="glyphicon glyphicon-chevron-right"></span></a>
    </div> <!-- END slide banner -->

    <!-- menu bar -->
    <nav class="navbar navbar-inverse" style="border-radius: 0px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="padding: 0px 15px 0 15px; margin: 0;">
                    <div><img src="images/logo.png" style="height: 50px;" alt=""> Bookstore</div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Trang chủ</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Danh mục sách</a>
                        <ul class="dropdown-menu" id="menu1">
                            @for($i = 0; $i < count($ds_loai_sach); $i++)
                            <li
                            @if(count($ds_loai_sach[$i]->ds_loai_con) > 0)
                            class="dropdown-submenu"
                            @endif
                            >
                                <a href="/sach-theo-loai/{{$ds_loai_sach[$i]->id}}">{{$ds_loai_sach[$i]->ten_loai_sach}}</a>
                                @if(count($ds_loai_sach[$i]->ds_loai_con) > 0)
                                <ul class="dropdown-menu hidden-xs hidden-sm">
                                    @for($j = 0; $j < count($ds_loai_sach[$i]->ds_loai_con); $j++)
                                    <li><a href="/sach-theo-loai/{{$ds_loai_sach[$i]->ds_loai_con[$j]->id}}">{{$ds_loai_sach[$i]->ds_loai_con[$j]->ten_loai_sach}}</a></li>
                                    @endfor
                                </ul>
                                @endif
                            </li>
                            @endfor
                        </ul>
                    </li>
                    <li><a href="/tin-tuc">Tin tức</a></li>
                    <li><a href="/lien-he">Liên hệ</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="cart">
                        @if(session()->has('tong_so_luong'))
                        <div class="number_item_cart">{{(session('tong_so_luong'))?:''}}</div>
                        @endif
                        <a href="/gio-hang">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                        </a>
                    </li>
                    @if(session()->has('user_info'))
                        <li class="dropdown">

                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <span class="glyphicon glyphicon-user"></span>
                                {{session('user_info')->tai_khoan}}
                            </a>
                            
                            <ul class="dropdown-menu hidden-xs hidden-sm">
                                @if(session('user_info')->id_loai_user >= 5)
                                <li>
                                    <a href="/quantri">
                                        Go to Admin dashboard
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="/logout">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                            
                        </li>
                    @else
                        <li><a href="#" id="myBtn"><span class="glyphicon glyphicon-user"></span> Đăng
                            nhập</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @include('modules.mod_form_dang_nhap')

</div>