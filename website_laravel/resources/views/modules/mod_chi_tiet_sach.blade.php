<section class="chi_tiet_sach">
	<div class="row thong_tin_co_ban_sach">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="title_module">
				{{$thong_tin_sach->ten_sach}}
			</div>
		</div>
		
		<form action="them_vao_gio_hang.php" method="post">
			<div class="col-md-4 col-lg-4">
				<div class="thong_tin_hinh">
					<div class="chi_tiet_hinh">
						<img src="images/sach/{{$thong_tin_sach->hinh}}" alt="" title="" />
					</div>
					<?php
					if($thong_tin_sach->doc_thu)
					{
					?>
						<div class="doc_thu_sach" data-toggle="modal" href='#modal-id'>Đọc thử</div>
					<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-8 col-lg-8">
				<div class="thong_tin_sach">
					<div class="tac_gia">
						<?php
						if($thong_tin_sach->ten_tac_gia)
						{
						?>
							<span>Tác giả: </span>{{ $thong_tin_sach->ten_tac_gia}}
						<?php
						}
						?>
					</div>
					<div class="gia_ban">
						<?php
						if($thong_tin_sach->don_gia)
						{
						?>
							<span>Giá bán tại Bookstore: </span>{{ number_format($thong_tin_sach->don_gia,0,",",".")}} ₫
						<?php
						}
						?>
					</div>
					<div>
						<?php
						if($thong_tin_sach->don_gia)
						{
						?>
							<span>Giá bìa: </span><span class="gia_bia">{{ number_format($thong_tin_sach->gia_bia,0,",",".")}} ₫</span>
						<?php
						}
						?>
					</div>
					<div class="div_chua_btn_dat_hang">
						<input type="hidden" name="id_sach" value="{{ $thong_tin_sach->id}}" />
						<input type="number" name="so_luong_mua" value="1" min="1" max="10" />
						<input type="submit" class="btn_dat_mua" value="Thêm vào giỏ hàng"/>
					</div>

					<!-- facebook like share -->
					<!-- <div class="fb-like" data-href="http://locahost:81{{ $_SERVER["PHP_SELF"]}}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script> -->

					<!-- <div class="fb-share-button" data-href="http://{{$share_url}}" data-layout="button" data-size="small">
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://{{$share_url}}" class="fb-xfbml-parse-ignore">Share</a>
					</div> -->

					<div id="fb-root"></div>
					<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v15.0" nonce="DXfCqvvW"></script>
					<div class="fb-like" data-href="http://{{$share_url}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
					<!-- END facebook like share -->

					<!-- twitter share button -->

					<div>
						<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
						<a class="twitter-share-button"
						href="https://twitter.com/intent/tweet?text=This book is very good for you"
						data-size="large" rel="canonical">
							Twitter
						</a>
					</div>
					
					<!-- END twitter share button -->
					
					<div class="cac_thong_tin_khac">
						<table class="table table-hover">
							<tbody>
								<?php
								if($thong_tin_sach->don_gia)
								{
								?>
								<tr>
									<td style="width: 300px;">Nhà xuất bản: </td>
									<td>{{ $thong_tin_sach->ten_nha_xuat_ban}}</td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->kich_thuoc)
								{
								?>
								<tr>
									<td style="width: 300px;">Kích thước: </td>
									<td>{{ $thong_tin_sach->kich_thuoc}}</td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->sku)
								{
								?>
								<tr>
									<td style="width: 300px;">Mã SKU: </td>
									<td>{{ $thong_tin_sach->sku}}</td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->trong_luong)
								{
								?>
								<tr>
									<td style="width: 300px;">Trọng lượng vận chuyển (gram): </td>
									<td>{{ $thong_tin_sach->trong_luong}}</td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->ngay_xuat_ban)
								{
								?>
								<tr>
									<td style="width: 300px;">Ngày xuất bản: </td>
									<td>{{ $thong_tin_sach->ngay_xuat_ban}}</td>
								</tr>
								<?php
								}
								?>

								<?php
								if($thong_tin_sach->ten_loai_sach)
								{
								?>
								<tr>
									<td style="width: 300px;">Thuộc thể loại: </td>
									<td>{{ $thong_tin_sach->ten_loai_sach}}</td>
								</tr>
								<?php
								}
								?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="thanh_ngan_cach_module"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 gioi_thieu_sach">
		{!!$thong_tin_sach->gioi_thieu!!}
	</div>

	<!-- facebook comment -->
	<div class="fb-comments" data-href="http://{{ $_SERVER["HTTP_HOST"] .$_SERVER["REQUEST_URI"]}}" data-numposts="5"></div>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- END facebook comment -->

</section>
<?php
if($thong_tin_sach->doc_thu)
{
	
	?>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog ">
			<div class="modal-content">
				<button type="button" class="close dong_doc_thu" data-dismiss="modal">×</button>
				<div class="modal-body sach_doc_thu">
					{!! $noi_dung_doc_thu !!}
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>


<div class="container">
	<div class="container_binh_luan">
		<div class="title_binh_luan">
			Nhận xét sản phẩm
		</div>
		
		<div class="container_list_binh_luan">
			<div class="list_binh_luan">
				@for($i = 0; $i < count($list_binh_luan); $i++)
				<div class="item_binh_luan">
					<div class="info_user_binh_luan">
						<div class="ho_ten_user">
							{{$list_binh_luan[$i]->ho_ten}}
						</div>
					</div>
					<div class="noi_dung_binh_luan">
						{{$list_binh_luan[$i]->noi_dung}}
					</div>
				</div>
				@endfor
			</div>
			<div class="form_binh_luan">
				@if(session()->has('user_info'))
					<div class="include_input">
						@csrf
						<textarea name="" id="noi_dung" class="form-control"></textarea>
						<div class="btn btn-primary btn_binh_luan">
							Gửi bình luận
						</div>
					</div>
					<script>
						$(() => {
							var token = $('input[name="_token"]').val();

							$('.btn_binh_luan').click(() => {
								//console.log(123);
								if($('#noi_dung').val()){
									$.post('/api/binh-luan', {
										noi_dung:  $('#noi_dung').val(),
										id_sach: '{{$thong_tin_sach->id}}',
										id_nguoi_dung: '{{session('user_info')->id}}',
										_token: token
									})
									.then((response) => {
										//console.log(response);

										var html = `
										<div class="item_binh_luan">
											<div class="info_user_binh_luan">
												<div class="ho_ten_user">
													{{session('user_info')->ho_ten}}
												</div>
											</div>
											<div class="noi_dung_binh_luan">
												${response.binh_luan_info.noi_dung}
											</div>
										</div>
										`

										$('.list_binh_luan').append(html);
										$('#noi_dung').val('');
									});
								}
								
							})
						});
					</script>
				@else
					<a href="#" id="myBtn" class="myBtnLogin btn btn-primary"><span class="glyphicon glyphicon-user"></span> Đăng nhập để bình luận</a>
				@endif
			</div>
		</div>
	</div>
</div>