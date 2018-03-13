/**
 * Created by Administrator on 2018/3/13.
 */
var Utils = {
    successLayer: function () {
        layer.msg('成功', {time: 5000, icon: 6});
    },
    errorLayer: function () {
        layer.msg('失败', {time: 5000, icon: 5});
    },
    refresh: function () {
        window.location.reload();
    }
};
