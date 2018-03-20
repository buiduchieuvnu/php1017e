var TAI_KHOAN = function(pAjaxUrl){
    this.AjaxUrl = '?app=sms_taikhoan&view=ajax';
    
    this.DANH_SACH = [];
    this.CHI_TIET = {
            ID_USER:'',
            FULLNAME:'',
            USERNAME : '',
            PASSWORD : ''
    };
    
    this.DS_NHOM_CHUAPHAN = [];
    this.DS_NHOM_DAPHAN = [];

    this.load_DANH_SACH = function(){
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=get_danh_sach',type: "post",data: null,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
             var data = $.parseJSON(response);
             that.DANH_SACH = data.returndata;
        });
        
        _ajax.fail(function (response, textStatus, jqXHR) {
            console.log('ERR: Server  ERROR. ' + textStatus);
        });
        
    };
    
    this.them_TAI_KHOAN = function(p_FULLNAME, p_USERNAME, p_PASSWORD){
        var _code = '0';
        var _msg = '';
        var _data= {
            FULLNAME:p_FULLNAME,
            USERNAME : p_USERNAME,
            PASSWORD : p_PASSWORD
        };
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=luu_tai_khoan',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {
                var data = $.parseJSON(response);
                var ketqua = data.returndata;
                if(ketqua[0].MA_LOI === '0'){
                    _code='0';
                    _msg = 'Thêm thành công tài khoản.';
                }
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        
        return {CODE: _code, MSG : _msg};
    };
    
    this.get_TAI_KHOAN_02 = function(p_ID_USER){
        var _code = '0';
        var _msg = '';
        var _data= {ID_USER:p_ID_USER};
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=get_tai_khoan_02',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {
                var data = $.parseJSON(response);
                if(data.CODE==='0'){
                    that.CHI_TIET.USERNAME  = data.DATA[0]['username'];
                    that.CHI_TIET.FULLNAME  = data.DATA[0]['fullname'];
                    that.CHI_TIET.ID_USER  = data.DATA[0]['id_user'];
                }
                _code= data.CODE;
                _msg = data.MSG;
                
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        
        return {CODE: _code, MSG : _msg};
    };
    
    this.sua = function(p_ID_USER, p_FULLNAME, p_USERNAME){
        var _code = '0';
        var _msg = '';
        var _data= {
            ID_USER : p_ID_USER,
            FULLNAME:p_FULLNAME,
            USERNAME : p_USERNAME
        };
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=tai_khoan_sua_01',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {
                var data = $.parseJSON(response);
                var ketqua = data.returndata;
                if(ketqua[0].MA_LOI === '0'){
                    _code='0';
                    _msg = 'Sửa thành công.';
                }
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        
        return {CODE: _code, MSG : _msg};
    };
    
    this.xoa = function(p_ID_USER){
        var _code = '0';
        var _msg = '';
        var _data= {
            ID_USER : p_ID_USER
        };
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=tai_khoan_delete_01',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {
                var data = $.parseJSON(response);
                var ketqua = data.DATA;
                if(ketqua[0].MA_LOI === '0'){
                    _code='0';
                    _msg = 'Xóa thành công.';
                }else{
                    _code='1';
                    _msg = ketqua[0].THONG_BAO;
                }
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        
        return {CODE: _code, MSG : _msg};
    };
    
    this.get_NHOM_DANHBA_CHUA_PHAN = function(p_ID_USER){
        var _code = '0';
        var _msg = '';
        var _data= {
            ID_USER : p_ID_USER
        };
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=nhom_danhba_get_03',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {

                var _rsp = $.parseJSON(response);
                if(_rsp.CODE === '0'){
                    _code='0';
                    that.DS_NHOM_CHUAPHAN = _rsp.DATA;
                }else{
                    _code = _rsp.CODE;
                    _msg = _rsp.MESSAGE;
                }
                
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        return {CODE: _code, MSG : _msg};
    };
    
    this.get_NHOM_DANHBA_DA_PHAN = function(p_ID_USER){
        var _code = '0';
        var _msg = '';
        var _data= {
            ID_USER : p_ID_USER
        };
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=nhom_danhba_get_02',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {
                var _rsp = $.parseJSON(response);
                if(_rsp.CODE === '0'){
                    _code='0';
                    that.DS_NHOM_DAPHAN = _rsp.DATA;
                }else{
                    _code = _rsp.CODE;
                    _msg = _rsp.MESSAGE;
                }
                
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        return {CODE: _code, MSG : _msg};
    };
    
    this.them_phanquyen_nhom = function(p_ID_USER, p_ID_NHOM_DANHBA){
        var _code = '0';
        var _msg = '';
        var _data= {
            ID_USER:p_ID_USER,
            ID_NHOM_DANHBA : p_ID_NHOM_DANHBA
        };
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=them_phanquyen_nhom',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {
                var data = $.parseJSON(response);
                var ketqua = data.DATA;
                if(ketqua[0].MA_LOI === '0'){
                    _code='0';
                    _msg = 'Thêm thành công.';
                }
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        
        return {CODE: _code, MSG : _msg};
    };
    
    this.huy_phanquyen_nhom = function(p_ID_USERS_NHOM_DANHBA){
        var _code = '0';
        var _msg = '';
        var _data= {
            ID_USERS_NHOM_DANHBA:p_ID_USERS_NHOM_DANHBA
        };
        var _ajax = $.ajax({url: that.AjaxUrl + '&task=huy_phanquyen_nhom',type: "post",data: _data,async: false});
        _ajax.done(function (response, textStatus, jqXHR) {
            try {
                var data = $.parseJSON(response);
                var ketqua = data.DATA;
                if(ketqua[0].MA_LOI === '0'){
                    _code='0';
                    _msg = 'Hủy thành công.';
                }
            } catch (err) {
                _code='1';
                _msg = 'Lỗi: ' + err.message;
                console.log(response);
            }
        });
        _ajax.fail(function (response, textStatus, jqXHR) {
            _code='1';
            _msg = 'Lỗi: ' + response;
        });
        
        return {CODE: _code, MSG : _msg};
    };
    
    var that = this;
    
    
};
