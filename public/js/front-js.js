const locale = document.getElementsByTagName('html')[0].getAttribute('lang');

function sendAjaxRequest(url, data, method = "post", callback = null) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        method: method,
        url: url,
        data: data,
        // processData: false,
        // contentType: false,
        success: function(response) {
            callback && typeof callback == "function" && callback(response);
        },
        fail: function(response) {
            callback && typeof callback == "function" && callback(response);
        }
    });
}

function add_to_cart(productId, startDate, endDate) {

  $('.loader').show();
  sendAjaxRequest('/cart/create', {productId, startDate, endDate}, 'post', function(res) {
    $('.message-status').html(res.message);
    $('.loader').hide();
  });

}


$(function() {
  $('.loader').hide();
});