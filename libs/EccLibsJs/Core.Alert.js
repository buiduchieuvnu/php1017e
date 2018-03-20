function CORE_ALERT() {
    this.showSuccess = function (_div, _content) {
        $(_div).html('<div class="alert alert-success"> ' + _content + ' </div>');
    };
    this.showWarning = function (_div, _content) {
        $(_div).html('<div class="alert alert-warning"> ' + _content + ' </div>');
    };
    this.showDanger = function (_div, _content) {
        $(_div).html('<div class="alert alert-danger"> ' + _content + ' </div>');
    };
    this.showInfo = function (_div, _content) {
        $(_div).html('<div class="alert alert-info"> ' + _content + ' </div>');
    };
    
    this.hide = function (_div) {
        $(_div).html('');
    };
    var that = this;
}

﻿function CORE_ALERT_2(pDiv) {
    
    this.Div = pDiv;
    
    this.show = function (pCode, pContent) {
        switch (pCode) {
            case '0':
                $(that.Div).html('<div class="alert alert-success"> ' + pContent + ' </div>');
                break;
            case '1':
                $(that.Div).html('<div class="alert alert-danger"> ' + pContent + ' </div>');
                break;
            case '2':
                $(that.Div).html('<div class="alert alert-warning"> ' + pContent + ' </div>');
                break;
            case '3':
                $(that.Div).html('<div class="alert alert-info"> ' + pContent + ' </div>');
                break;
            default:
                $(that.Div).html('<div class="alert alert-info"> ' + pContent + ' </div>');
                break;
        }
    };

    this.hide = function (_div) {
        $(_div).html('');
    };
    var that = this;
}