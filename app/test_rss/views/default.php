<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ví dụ lấy tin tức từ RSS</h1>
    </div>
</div>
<div class="row well">
    <div class="col-md-12">
        <div class="col-md-3">
            <label>Chọn chủ đề</label>
            <select id="sel_ChuDe" class="form-control">
                <option value="sukien">Sự kiện</option>
                <option value="xahoi">Xã hội</option>
                <option value="thegioi">Thế giới</option>
            </select>
        </div>
        <button type="button" class="btn btn-warning" id="btn_RSS" style="margin-top: 25px"><i class="fa fa-rss"></i> Tải RSS</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Danh sách tin tức</div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

    function Rss_get() {
        var _gui = {};
        var request = $.ajax({
            url: "?app=dm_hang&task=tim&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            var _html = "";
            for (var i = 0; i < DS.length; i++) {
                var sv = DS[i];
                _html += '<tr class="odd gradeX">';
                _html += '<td>' + (i + 1) + '</td>';
                _html += '<td>' + sv.ma_danh_muc + '</td>';
                _html += '<td>' + sv.ten_danh_muc + '</td>';
                _html += '<td class="center">';
                _html += '<img src="' + sv.hinh_anh + '" alt="hinhanh" width="70" height="50" />';
                _html += '</td>';
                _html += '<td class="center">';
                _html += '<div class="btn-group dropup">	';
                _html += '<button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-bars m-r-5"></i><span class="caret"></span></button>	';
                _html += '<ul role="menu" class="dropdown-menu">		';
                _html += '<li><a href="#"><i class="fa fa-trash"></i> Xóa </a></li>';
                _html += '<li><a href="#"><i class="fa fa-lock"></i> Khóa</a></li>';
                _html += '<li><a href="#" data-id="20171219000037" class="btnSua"  data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Sửa</a></li>';
                _html += '</ul>';
                _html += '</div>';
                _html += '</td>';
                _html += '</tr>';
            }
            // Chèn dữ liệu vào bảng
            $('#tblDanhSach tbody').html(_html);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }

    $(function () {
        $('#btn_RSS').on('click',function(){
            var _chude = $('#sel_ChuDe').val();
            alert(_chude);
            
        var _gui = {chu_de:_chude};
        var request = $.ajax({
            url: "?app=test_rss&task=rss&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            var _rs = JSON.parse(ketqua);
            console.log(_rs);
            
            var _html = '';
            for (var i = 0; i < _rs.length; i++) {
                var _item = _rs[i];
                _html +='<tr>';
                _html +='<td>'+(i+1)+'</td>';
                _html +='<td>'+_item.mota+'</td>';
                _html +='<td>'+_item.tieude+'</td>';
                _html +='<td><a href="'+_item.link+'" target="_blank"> Xem</a></td>';
                _html +='</tr>';
            }
            $('#tblDanhSach tbody').html(_html);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
        });
    });

</script>