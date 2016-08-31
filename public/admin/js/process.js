(function () {

    // AJAX Setup for processing
    var baseUrl = '/zakaa';
    var csrf = new FormData($('#csrf')[0]);


    /*
     * Orders
     */

    $(document).on('click', '.btn-action', function () {
        var $this = $(this);
        var url = $this.data('url');
        var action = $this.data('action');
        request(baseUrl + '/'+url+'/action/' + action, new FormData($('#'+url+'-form')[0]), function (data) {
            if (data.status === 'success') {
                swal({title: "Success", text: data.msg, type: "success"}, function () {
                    location.reload(true);
                });
            } else
            if (data.status === 'error') {
                swal("Error", data.msg, "error");
            } else
            if (data.status === 'warning') {
                swal("Waring", data.msg, "warning");
            }
        }, function () {
            alert('Error');
        });
    });

    var orderTemplate = $('#order-modal-template').html();
    var orderModal = $('#order-modal-body');

    $(document).on('click', '.btn-order-view', function () {
        var $this = $(this);
        var id = $this.data('orderId');
        request(baseUrl + '/orders/view/' + id, csrf, function (data) {
            if (data) {
                var txt = orderTemplate;
                for (var key in data) {
                    txt = txt.replace(new RegExp('{' + key + '}', 'g'), data[key]);
                }
                orderModal.html(txt);
                $this.closest('tr').removeAttr('class').addClass('seen');
            }
        }, function () {
            alert('Error');
        });
    });

    var orderRowTemplate = $('#order-row-template').html();
    var orderTableBody = $('#order-table-body');
    var planFilter = 'all';
    var statusFilter = 'all';
    $(document).on('change', '.btn-plan-filter,.btn-status-filter', function () {
        var $this = $(this);
        var filter = $this.data('filter');
        if ($this.hasClass('btn-plan-filter')) {
            planFilter = filter;
        } else if ($this.hasClass('btn-status-filter')) {
            statusFilter = filter;
        }
        var lastFilter = planFilter + "|" + statusFilter;
        request(baseUrl + '/orders/filter/' + lastFilter, csrf, function (data) {
            if (data) {
                var tbody = '';
                for (var row in data) {
                    var txt = orderRowTemplate;
                    for (var key in data[row]) {
                        txt = txt.replace(new RegExp('{' + key + '}', 'g'), data[row][key]);
                    }
                    tbody += txt;
                }
                orderTableBody.html(tbody);
            }
        }, function () {
            alert('Error');
        });
    });

    var msgRowTemplate = $('#msg-row-template').html();
    var msgTableBody = $('#msg-table-body');
    $(document).on('click', '.btn-search', function () {
        var search = $(this).data('search');
        var rowTemplate;
        var tableBody;
        if (search === 'messages') {
            rowTemplate = msgRowTemplate;
            tableBody = msgTableBody;
        } else {
            rowTemplate = orderRowTemplate;
            tableBody = orderTableBody;
        }

        request(baseUrl + '/' + search + '/search', new FormData($('#form-search')[0]), function (data) {
            if (data) {
                var tbody = '';
                for (var row in data) {
                    var txt = rowTemplate;
                    for (var key in data[row]) {
                        txt = txt.replace(new RegExp('{' + key + '}', 'g'), data[row][key]);
                    }
                    tbody += txt;
                }
                tableBody.html(tbody);
            }
        }, function () {
            alert('Error');
        });
    });

    /*
     * Messages
     */
    var msgTemplate = $('#msg-modal-template').html();
    var msgModal = $('#msg-modal-body');

    $(document).on('click', '.btn-msg-view', function () {
        var $this = $(this);
        var id = $this.data('msgId');
        request(baseUrl + '/messages/view/' + id, csrf, function (data) {
            if (data) {
                var txt = msgTemplate;
                for (var key in data) {
                    txt = txt.replace(new RegExp('{' + key + '}', 'g'), data[key]);
                }
                msgModal.html(txt);
                $this.closest('tr').removeAttr('class').addClass('seen');
            }
        }, function () {
            alert('Error');
        });
    });

    $(document).on('change', '.msg-filter', function () {
        var $this = $(this);
        var filter = $this.data('filter');
        request(baseUrl + '/messages/filter/' + filter, csrf, function (data) {
            if (data) {
                var tbody = '';
                for (var row in data) {
                    var txt = msgRowTemplate;
                    for (var key in data[row]) {
                        txt = txt.replace(new RegExp('{' + key + '}', 'g'), data[row][key]);
                    }
                    tbody += txt;
                }
                msgTableBody.html(tbody);
            }
        }, function () {
            alert('Error');
        });
    });
    /**
     * Custom logging function
     * @param mixed data
     * @returns void
     */
    function _(data) {
        console.log(data);
    }

    /**
     * Custom Ajax request function
     * @param string url
     * @param mixed|FormData data
     * @param callable(data) completeHandler
     * @param callable errorHandler
     * @param callable progressHandler
     * @returns void
     */
    function request(url, data, completeHandler, errorHandler, progressHandler) {
        $.ajax({
            url: url, //server script to process data
            type: 'POST',
            xhr: function () {  // custom xhr
                myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // if upload property exists
                    myXhr.upload.addEventListener('progress', progressHandler, false); // progressbar
                }
                return myXhr;
            },
            // Ajax events
            success: completeHandler,
            error: errorHandler,
            // Form data
            data: data,
            // Options to tell jQuery not to process data or worry about the content-type
            cache: false,
            contentType: false,
            processData: false
        }, 'json');

    }
})();