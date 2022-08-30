@extends('templates.template_admin')

@section('main-content')
    <!--main content start-->
    <link rel="stylesheet" href="/css/data_table.min.css">
    <script src="/js/data_table.min.js"></script>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                        <li><i class="fa fa-table"></i>Table</li>
                        <li><i class="fa fa-th-list"></i>Basic Table</li>
                    </ol>
                </div>
            </div>
            <!-- page start-->

            @if($errors->NoticeDelete->first())
            {{-- <div class="error_message panel panel-danger">
                <div class="panel-heading">Vui lòng kiểm tra lỗi</div>
                @foreach ($errors->loginErrors->all() as $error)
                    <div class="panel-body item_message text-danger">{{$error}}</div>
                @endforeach
            </div> --}}
            <script>
                alert('{{$errors->NoticeDelete->first()}}');
            </script>
            @endif
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Advanced Table
                        </header>

                        <table id="ds_sach" class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th><i class="icon_profile"></i> Tên sách</th>
                                    <th><i class="icon_calendar"></i> Ngày xuất bản</th>
                                    <th><i class="icon_mail_alt"></i> Tác giả</th>
                                    <th><i class="icon_pin_alt"></i> Nhà Xuất Bản</th>
                                    <th><i class="icon_mobile"></i> Nổi bật</th>
                                    <th><i class="icon_cogs"></i> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ds_sach as $sach)
                                <tr>
                                    <td>{{$sach->ten_sach}}</td>
                                    <td>{{$sach->ngay_xuat_ban}}</td>
                                    <td>{{$sach->ten_tac_gia}}</td>
                                    <td>{{$sach->ten_nha_xuat_ban}}</td>
                                    <td>{{($sach->noi_bat)?1:0}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="/admin/ql-sach/edit/{{$sach->id}}"><i class="icon_pencil"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm_delete();" href="/admin/sach/delete/{{$sach->id}}"><i class="icon_trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>

    <script>
        $(document).ready( function () {
            $('#ds_sach').DataTable();
        });
    </script>
    <!--main content end-->
@endsection
