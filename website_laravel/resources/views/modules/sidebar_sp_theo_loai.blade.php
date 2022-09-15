<div class="container_side_bar_sp_theo_loai col-sm-12 col-md-3">
    <div class="ds_module">
        <div class="loai_sach_container">
            <div class="ds_loai_sach">
                <ul class="" id="menu1">
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
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        var width_module = $('.container_side_bar_sp_theo_loai .ds_module ul').width();

        $( window ).scroll(function() {
            //console.log($(this).scrollTop(), $('.container_side_bar_sp_theo_loai').offset().top);
            if($(this).scrollTop() >= $('.container_side_bar_sp_theo_loai').offset().top - 10){
                $('.ds_module').css({
                    position: 'fixed',
                    top: '10px',
                    left: '30px',
                })

                $('.container_side_bar_sp_theo_loai .ds_module ul').width(width_module);
            }
            else {
                $('.ds_module').css({
                    position: 'relative',
                    top: '0px',
                    left: '0px'
                });
            }
        });
    })
</script>