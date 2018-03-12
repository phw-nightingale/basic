/* 通用JS文件 */
/**
 * 基础方法封装
 * 封装依赖于
 * JQuery3.2.1
 * Layui2.2.5
 * @type {{ajax: muzi.ajax}}
 */
window.server = 'http://print.muzi.com/';

var muzi = {

    host : 'http://localhost/',

    /**
     * Base AJAX
     * @param e
     */
    ajax : function (e) {
        $.ajax({
            url: e['url']
            ,type: e['type']
            ,dataType: 'json'
            ,data: e['data']
            ,async: typeof e['async'] === 'undefined' ? false : e['async']
            ,beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            }
            ,success: typeof e['success'] !== 'undefined' ? e['success'] : function (data) {
                layer.msg(data.message);
            }
            ,error: typeof e['error'] !== 'undefined' ? e['error'] : function (xhr, e, thrown) {
                layer.msg(thrown);
            }
        });
    },

    /**
     * HTTP POST
     * @param url
     * @param data
     * @param success
     */
    post : function (url, data, success) {
        var e = {
            url: url
            ,type: 'post'
            ,data: data
            ,success: success
        };
        muzi.ajax(e);
    },

    /**
     * HTTP GET
     * @param url
     * @param data
     * @param success
     */
    get : function (url, data, success) {
        var e = {
            url: url
            ,type: 'get'
            ,data: data
            ,success: success
        };
        muzi.ajax(e);
    },

    /**
     * HTTP PUT
     * @param url
     * @param data
     * @param success
     */
    put : function (url, data, success) {
        var e = {
            url: url
            ,type: 'put'
            ,data: data
            ,success: success
        };
        muzi.ajax(e);
    },

    /**
     * HTTP PATCH
     * @param url
     * @param data
     * @param success
     */
    patch : function (url, data, success) {
        var e = {
            url: url
            ,type: 'patch'
            ,data: data
            ,success: success
        };
        muzi.ajax(e);
    },

    /**
     * HTTP DELETE
     * @param url
     * @param data
     * @param success
     */
    delete : function (url, data, success) {
        var e = {
            url: url
            ,type: 'delete'
            ,data: data
            ,success: success
        };
        muzi.ajax(e);
    },

    /**
     * HTTP HEAD
     * @param url
     * @param data
     * @param success
     */
    head : function (url, data, success) {
        var e = {
            url: url
            ,type: 'head'
            ,data: data
            ,success: success
        };
        muzi.ajax(e);
    },

    getBtnText : function (e) {

    }


};