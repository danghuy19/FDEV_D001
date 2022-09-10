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
                            <tbody class="ds_don_hang"></tbody>

                            {{-- <tbody>
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
                                
                            </tbody> --}}
                        </table>
                    </section>
                </div>
            </div>

            <ul class="pagination">
                <li class="page-item"><a class="page-link" onclick="process_load_page(0)">First</a></li>
                <li class="page-item"><a class="page-link" onclick="process_load_page_previous()">Previous</a></li>
            </ul>
            {{-- <ul class="pagination">
                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page=0">First</a></li>
                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{($cur_page - 1 >= 0)?$cur_page - 1:0}}">Previous</a></li>
                @if($cur_page >= 5)
                <li><a class="page-link">...</a></li>
                @endif
            </ul> --}}

            <ul class="pagination list_page">
                {{-- @for($i = 0; $i < $so_trang; $i++)
                    @if($i >= $cur_page - 5 && $i <= $cur_page + 5)
                        <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{$i}}">{{$i+1}}</a></li>
                    @endif
                @endfor --}}
            </ul>

            {{-- <ul class="pagination">
                @if($cur_page <= $so_trang - 6)
                <li><a class="page-link">...</a></li>
                @endif
                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{($cur_page + 1 <= $so_trang - 1)?$cur_page + 1:$so_trang - 1}}">Next</a></li>
                <li class="page-item"><a class="page-link" href="/admin/ql-don-hang/?page={{$so_trang - 1}}">Last</a></li>
            </ul> --}}

            <ul class="pagination">
                <li class="page-item"><a class="page-link" onclick="process_load_page_next()">Next</a></li>
                <li class="page-item"><a class="page-link" onclick="process_load_page({{$so_trang - 1}})">Last</a></li>
            </ul>

            <!-- page end-->
        </section>
        <script>
            // xác định số trang
            var current_page = 0;
            var so_trang = 0;

            function load_ajax_page(cur_page){
                $.get('/admin/ql-don-hang/pagination/' + cur_page)
                    .then((data) => {
                        //console.log(data);
                        so_trang = data.so_trang;

                        var html_list_page = '';

                        for(var i = 0; i < so_trang; i++){
                            if(i >= cur_page - 5 && i <= cur_page + 5)
                            {
                                html_list_page += `
                                <li class="page-item"><a class="page-link" onclick="process_load_page(${i})">${i + 1}</a></li>
                                `
                            }
                        }

                        $('.list_page').html(html_list_page);

                        if(data.ds_don_hang.length > 0){
                            var html_ds_don_hang = '';

                            for(var i = 0; i < data.ds_don_hang.length; i++){
                                html_ds_don_hang += `
                                <tr>
                                    <td>${data.ds_don_hang[i].id}</td>
                                    <td>${data.ds_don_hang[i].ho_ten_nguoi_nhan}</td>
                                    <td>${data.ds_don_hang[i].tong_tien}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="/admin/ql-sach/edit/${data.ds_don_hang[i].id}"><i class="icon_pencil"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm_delete();" href="/admin/sach/delete/${data.ds_don_hang[i].id}"><i class="icon_trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                `;
                            }

                            //console.log(html_ds_don_hang);
                            $('.ds_don_hang').html(html_ds_don_hang);
                        }
                    });
            }

            //lùi 1 trang
            function process_load_page_previous(){
                //console.log('lùi 1 trang');
                if(current_page >= 1){
                    current_page -= 1;
                    console.log(current_page);
                    load_ajax_page(current_page);
                }
            }

            // tiến 1 trang
            function process_load_page_next(){
                if(current_page <= so_trang - 1){
                    current_page += 1;
                    console.log(current_page);
                    load_ajax_page(current_page);
                }
            }

            // mỗi khi thay đổi trang
            function process_load_page(cur_page){
                //console.log(cur_page);
                current_page = cur_page;
                load_ajax_page(current_page);
            }

            //chạy lần đầu tiên sau khi load trang
            $(() => {
                
                load_ajax_page(current_page)
            })
        </script>
    </section>

    

    {{-- <script>
        $(document).ready( function () {
            $('#ds_sach').DataTable();
        });
    </script> --}}
    <!--main content end-->
@endsection
