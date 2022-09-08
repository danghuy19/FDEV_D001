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
                                    <th><i class="icon_profile"></i> id đơn hàng </th>
                                    <th><i class="icon_calendar"></i> Họ tên người mua</th>
                                    <th><i class="icon_mail_alt"></i> Tổng tiền </th>
                                    <th><i class="icon_cogs"></i> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ds_don_hang as $don_hang)
                                <tr>
                                    <td>{{$don_hang->id}}</td>
                                    <td>{{$don_hang->ho_ten_nguoi_nhan}}</td>
                                    <td>{{$don_hang->tong_tien}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="/admin/ql-sach/edit/{{$don_hang->id}}"><i class="icon_pencil"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm_delete();" href="/admin/sach/delete/{{$don_hang->id}}"><i class="icon_trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

            {{$so_trang}}
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page=0">First</a></li>
                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{($cur_page - 1 >= 0)?$cur_page - 1:0}}">Previous</a></li>
                
                @if($cur_page >= 5)
                <li><a class="page-link">...</a></li>
                @endif

                @for($i = 0; $i < $so_trang; $i++)
                    @if($i >= $cur_page - 5 && $i <= $cur_page + 5)
                        <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{$i}}">{{$i+1}}</a></li>
                    @endif
                @endfor

                @if($cur_page <= $so_trang - 6)
                <li><a class="page-link">...</a></li>
                @endif

                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{($cur_page + 1 <= $so_trang - 1)?$cur_page + 1:$so_trang - 1}}">Next</a></li>
                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{$so_trang - 1}}">Last</a></li>
            </ul>

            <!-- page end-->
        </section>
    </section>

    

    {{-- <script>
        $(document).ready( function () {
            $('#ds_sach').DataTable();
        });
    </script> --}}
    <!--main content end-->
@endsection
