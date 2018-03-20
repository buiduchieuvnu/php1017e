function CORE_LOG(pDebug) {
    this.Debug = false;

    this.init = function(){
        if (typeof (pDebug) !== 'undefined') {
            that.Debug = pDebug;
        } else {
            that.Debug = false;
        }
    };

    this.show = function (pTitle, pMesseage) {
        if (that.Debug) {
            var currentdate = new Date();
            var datetime = "" + currentdate.getDate() + "/"
                            + (currentdate.getMonth() + 1) + "/"
                            + currentdate.getFullYear() + " @ "
                            + currentdate.getHours() + ":"
                            + currentdate.getMinutes() + ":"
                            + currentdate.getSeconds();

            console.log("[" + datetime + "] log>> " + pTitle + ":", pMesseage)
        }
    };

    var that = this;
    that.init();
}