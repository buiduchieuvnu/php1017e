
<script src="<?= AppObject::getBaseFile('libs/BootstrapDialog/bootstrap-dialog.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= AppObject::getBaseFile('libs/BootstrapDialog/dilogbootstrap.css') ?>" />

<script>
    function ECC_DIALOG(_callBackFn) {
        this.dialogPoup = null;
        this.callBackFn = _callBackFn;
        this.show = function (b_tencn, url, width, height, id) {
            that.dialogPoup = new BootstrapDialog({
                title: b_tencn,
                closable: true,
                draggable: true,
                closeByBackdrop: false,
                id: id,
                onhide: function (dialogRef) {
                    var element = document.getElementById(id);
                    element.parentNode.removeChild(element);
                    $("div[id*=" + id + "]").remove();
                    // Call callback function
                    if (typeof(that.callBackFn) === 'function') {
                        that.callBackFn();
                    }
                },
                message: '<iframe id="' + id + '" width="100%" height="100%" frameborder="0" src="' + url + '"  marginwidth="0" marginheight="0"  pramater=\"\" scrolling="yes"></iframe>'
            });
            that.dialogPoup.open();
            var s = that.dialogPoup.getModalDialog();
            var body = that.dialogPoup.getModalBody();
            s.css("width", width);
            body.children().children().css("height", height);
            return that.dialogPoup;
        };


        // Tự động điều chỉnh kích thước frame
        this.resizeIframe = function (obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        };

        var that = this;
    }

    
</script>