
<div id="ChiTietSanPham" style="padding: 20px;">
    <div class="row well">
        <div class="form-group col-xs-3">
            <label>Danh mục hàng <span class="text-warning">(*)</span>: </label>
            <select class="form-control" id="selDmHang">
                <option value="0">-- Chọn DM hàng --</option>
            </select>
        </div>
        <div class="form-group col-xs-3">
            <label>Nhà cung cấp <span class="text-warning">(*)</span>: </label>
            <select class="form-control" id="selDmNCC">
                <option value="0">-- Chọn nhà cung cấp --</option>
            </select>
        </div>
        <div class="form-group col-xs-3">
            <label>Thương hiệu <span class="text-warning">(*)</span>: </label>
            <select class="form-control" id="selDmThuongHieu">
                <option value="0">-- Chọn thương hiệu --</option>
            </select>
        </div>

        <div class="form-group col-xs-3">
            <label>Mã sản phẩm <span class="text-warning">(*)</span>: </label>
            <input type="text" class="form-control input-xs" id="txtMa" placeholder="Mã sản phẩm" />
        </div>

        <div class="form-group col-xs-9">
            <label>Tên sản phẩm <span class="text-warning">(*)</span>: </label>
            <input type="text" class="form-control input-xs" id="txtTen" placeholder="Tên sản phẩm" />
        </div>
        <div class="form-group col-xs-3">
            <label>Hình ảnh <span class="text-warning">(*)</span>: </label>
            <img src="upload/images/sanpham/tivi_1.png" width="150" id="imgHinhAnh" />
            <span class="input-group-addon"><a href="#" id="lnkDownload2" target="_blank"><i class="icon-file-download2"></i></a></span>
                <input type="text" class="form-control input-xs" id="txtFileDinhKem2" readonly="readonly" placeholder="Chọn file 2..." />
                <span class="input-group-addon">
                    <a href="javascript:openFileDinhKem(2)">
                        <i class="icon-folder-upload2"></i>
                    </a>
                </span>
        </div>

        <div class="form-group col-xs-3">
            <label>Giá nhập <span class="text-warning">(*)</span>: </label>
            <input type="number" class="form-control input-xs" id="txtGiaNhap" value="0" />
        </div>

        <div class="form-group col-xs-3">
            <label>Giá bán <span class="text-warning">(*)</span>: </label>
            <input type="number" class="form-control input-xs" id="txtGiaBan" value="0" />
        </div>

        <div class="form-group col-xs-3">
            <label>Giá khuyến mại <span class="text-warning">(*)</span>: </label>
            <input type="number" class="form-control input-xs" id="txtGiaKM" value="0" />
        </div>
        <div class="form-group col-xs-3">
            <label>Trạng thái <span class="text-warning">(*)</span>: </label>
            <select class="form-control" id="selTrangThai">
                <option value="1">Còn hàng</option>
                <option value="2">Hết hàng</option>
                <option value="3">Đặt trước</option>
            </select>
        </div>
        <div class="col-xs-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tabMoTa" aria-controls="thuoc" role="tab" data-toggle="tab" aria-expanded="false">Mô tả ngắn</a></li>
                <li role="presentation"><a href="#tabChiTiet" aria-controls="thuthuat" role="tab" data-toggle="tab" aria-expanded="true">Chi tiết</a></li>
                <li role="presentation"><a href="#tabThuocTinh" aria-controls="thuthuat" role="tab" data-toggle="tab" aria-expanded="true">Thuộc tính</a></li>
            </ul>
            <div class="tab-content" style="border: 1px solid #ddd;padding:5px;">
                    <div role="tabpanel" class="tab-pane active" id="tabMoTa">
                        <label>Mô tả ngắn <span class="text-warning">(*)</span>: </label>
                        <textarea id="txtMoTaNgan" cols="60" rows="5"></textarea>
                        
                    </div>                    
                    <div role="tabpanel" class="tab-pane" id="tabChiTiet">
                        <label>Mô tả chi tiết <span class="text-warning">(*)</span>: </label>
                        <textarea id="txtMoTaChiTiet" cols="60" rows="5"></textarea>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tabThuocTinh">
                        <label>Thuộc tính <span class="text-warning">(*)</span>: </label>
                        <textarea id="txtThuocTinh" cols="60" rows="5"></textarea>
                    </div>
                </div>
        </div>
    </div>
    <div class="well row" id="ACTIONS">
        <button type="button" class="btn btn-success" id="SAVE"><i class="icon icon-floppy-disk"></i> Lưu </button>
        <button type="button" class="btn btn-danger" id="CLOSE"><i class="icon icon-eject"></i> Đóng </button>
    </div>
</div>
<div id="roxyCustomPanel" style="display: none;">
    <iframe id="CvFileMan" src="/Libs/fileman/index.html?integration=custom&txtFieldId=txtFileDinhKem" style="width: 100%; height: 100%" frameborder="0"></iframe>
</div>

<!--Tiny MCE-->
<script type="text/javascript" src="<?= AppObject::getBaseFile('libs/tinymce/jquery.tinymce.min.js') ?>"></script>
<script type="text/javascript" src="<?= AppObject::getBaseFile('libs/tinymce/tinymce.min.js') ?>"></script>

<!-- App objects -->
<script type="text/javascript">
    
    function open_popup(url) {
        var w = 700;
        var h = 500;
        var l = Math.floor((screen.width - w) / 2);
        var t = Math.floor((screen.height - h) / 2);
        var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
    }

    function responsive_filemanager_callback(field_id) {
        console.log(field_id);
        var url = jQuery('#' + field_id).val();
        alert('update ' + field_id + " with " + url);
        //your code
    }
    
    function Page_init(){
        tinymce.init({
            selector: '#txtMoTaNgan,#txtMoTaChiTiet,#txtThuocTinh',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
            image_advtab: true,

            external_filemanager_path: "<?= AppObject::getBaseFile('libs/filemanager/') ?>",
            filemanager_title: "Quản lý file",
            external_plugins: {"filemanager": "filemanager/plugin.min.js"}
        });
    }

    function DmHang_bind(){
        var _gui = {};
        var request = $.ajax({
            url: "?app=san_pham&task=dm_hang_tim&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            var _html = '';
            for (var i = 0; i < DS.length; i++) {
                var _row = DS[i];
               _html +='<option value="'+_row.id_dm_hang+'">'+_row.ten_danh_muc+'</option>';
            }
            $('#selDmHang').html(_html);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }
    
    function DmNcc_bind(){
        var _gui = {};
        var request = $.ajax({
            url: "?app=san_pham&task=dm_ncc_tim&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            var _html = '';
            for (var i = 0; i < DS.length; i++) {
                var _row = DS[i];
               _html +='<option value="'+_row.id_dm_nha_cung_cap+'">'+_row.ten+'</option>';
            }
            $('#selDmNCC').html(_html);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }
    
    function DmThuongHieu_bind(){
        var _gui = {};
        var request = $.ajax({
            url: "?app=san_pham&task=dm_thuonghieu_tim&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            var _html = '';
            for (var i = 0; i < DS.length; i++) {
                var _row = DS[i];
               _html +='<option value="'+_row.id_dm_thuong_hieu+'">'+_row.ten+'</option>';
            }
            $('#selDmThuongHieu').html(_html);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }


    (function () {
        Page_init();
        DmHang_bind();
        DmNcc_bind();
        DmThuongHieu_bind();
    })(jQuery);

</script>
