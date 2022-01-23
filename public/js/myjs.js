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
        processData: false,
        contentType: false,
        success: function(response) {
            callback && typeof callback == "function" && callback(response);
        },
        fail: function(response) {
            callback && typeof callback == "function" && callback(response);
        }
    });
}

function convert_to_json(inputs) {
    let obj = {};
    inputs.each(function() {
        // till length of 3 splits
        let splitted_key = $(this)
            .attr("name")
            .split("_");

        for (let i = 1; i < splitted_key.length; i++) {
            let key = splitted_key[i];

            if (i == splitted_key.length - 1) {
                let value = $(this).val();
                obj[key] = value;
            } else {
                let key2 = splitted_key[i + 1];
                let value = $(this).val();
                if (!obj.hasOwnProperty(key)) obj[key] = {};
                obj[key][key2] = value;
                break;
            }
        }
    });
    return obj;
}

function get_params(div_class) {
    let inputs = $(div_class + " input , " + div_class + " select , " + div_class + " textarea");
    let data = {};
    
    inputs.each(function() {
        let name = $(this).attr("name");
        if(name) {
            const splitting = name.split("_");
            if (splitting.length > 1) {
                let name_key = splitting[0];
                if (name_key.length > 0) {
                    let json_inputs = $(
                        div_class + " [data-json*=" + name_key + "]"
                    );
                    if (json_inputs.length > 0)
                        data[name_key] = convert_to_json(json_inputs);
                }
            } else {
                data[name] = $(this).val();

                if ($(this).attr("type") == "checkbox")
                    data[name] = $(this).is(":checked");
                if ($(this).attr("type") == "file") {
                    data[name] = [];
                    for (let i = 0; i < $(this).prop('files').length; i++) {
                        data[name].push($(this).prop('files')[i]);
                    }
                }
            }
        }
    });
    return data;
}

function get_form_data(params) {
    let form_data = new FormData();
    for (let p in params) {
        if (params[p] != undefined) {
            if (Array.isArray(params[p]) && (p == 'images[]' || p == 'image')) { //file/s
                for(let i in params[p]) {
                    form_data.append(p, params[p][i]);
                }
            } else {
                let inserted_data = typeof params[p] == 'object' && p != 'image' ? JSON.stringify(params[p]) : params[p];
                form_data.append(p, inserted_data);
            }
        }
    }
    return form_data;
}

////// brands section

function submit_add_brand(e) {
    e.preventDefault();

    const params = get_params(".brand-form");
    const form_data = get_form_data(params);

    $(".modal-loader").show();

    sendAjaxRequest("/brands/create", form_data, "post", function(res) {
        $(".modal-loader").hide();
        if (res.status) {
            location.reload();
        } else {
            console.log(res.message);
        }
    });
}

function submit_update_brand(e, id) {
    e.preventDefault();

    const params = get_params(".brand-update-form");
    const form_data = get_form_data(params);

    $(".sidebar-loader").show();

    sendAjaxRequest(`/brands/${id}/update`, form_data, "post", function(res) {
        $(".sidebar-loader").hide();
        if (res.status) {
            $(`[data-title-${id}]`).html(res.data.title[locale]);
            $(`[data-active-${id}]`).html(
                `<i class="zmdi ${res.data.active ? 'zmdi-check-square success' : 'zmdi-minus-square danger'}"></i>`
            );    
            if(res.data.image) { // todo update img
                $(`[data-image-${res.data.id}]`).attr('src', res.data.image['file_path']);
            }

        } else {
            console.log(res.message);
        }
    });
}

function delete_brand(id) {
    let conf = window.confirm("are you sure ?");
    if (!conf) return;

    sendAjaxRequest(`/brands/${id}/delete`, {}, "post", function(res) {
        if (res.status) {
            $(`[data-id="${id}"]`).remove();
            $(".tooltip").remove();
        } else {
            console.log(res.message);
        }
    });
}

function edit_brand(id) {
    sendAjaxRequest(`/brands/${id}/edit`, {}, "get", function(res) {
        $(".brand-edit").html(res);
    });
}

////// end brands section


////// categories section

function submit_add_category(e) {
    e.preventDefault();

    const params = get_params(".category-form");
    const form_data = get_form_data(params);

    $(".modal-loader").show();

    sendAjaxRequest("/categories/create", form_data, "post", function (res) {
        $(".modal-loader").hide();
        if (res.status) {
            location.reload();
        } else {
            console.log(res.message);
        }
    });
}

function submit_update_category(e, id) {
    e.preventDefault();

    const params = get_params(".category-update-form");
    const form_data = get_form_data(params);

    $(".sidebar-loader").show();

    sendAjaxRequest(`/categories/${id}/update`, form_data, "post", function (res) {
        $(".sidebar-loader").hide();
        if (res.status) {
            $(`[data-title-${id}]`).html(res.data.title[locale]);
            $(`[data-active-${id}]`).html(
                `<i class="zmdi ${res.data.active ? 'zmdi-check-square success' : 'zmdi-minus-square danger'}"></i>`
            );
            if (res.data.image) { // todo update img
                console.log($(`[data-image-${res.data.id}]`))
                $(`[data-image-${res.data.id}]`).attr('src', res.data.image.file_path);
            }

        } else {
            console.log(res.message);
        }
    });
}

function delete_category(id) {
    let conf = window.confirm("are you sure ?");
    if (!conf) return;

    sendAjaxRequest(`/categories/${id}/delete`, {}, "post", function (res) {
        if (res.status) {
            $(`[data-id="${id}"]`).remove();
            $(".tooltip").remove();
        } else {
            console.log(res.message);
        }
    });
}

function edit_category(id) {
    sendAjaxRequest(`/categories/${id}/edit`, {}, "get", function (res) {
        $(".category-edit").html(res);
    });
}

////// end categories section

////// blogs section

function submit_add_blog(e) {
    e.preventDefault();

    const params = get_params(".blog-form");
    const form_data = get_form_data(params);

    $(".modal-loader").show();

    sendAjaxRequest("/blogs/create", form_data, "post", function (res) {
        $(".modal-loader").hide();
        if (res.status) {
            location.reload();
        } else {
            console.log(res.message);
        }
    });
}

function submit_update_blog(e, id) {
    e.preventDefault();

    const params = get_params(".blog-update-form");
    const form_data = get_form_data(params);

    $(".sidebar-loader").show();

    sendAjaxRequest(`/blogs/${id}/update`, form_data, "post", function (res) {
        $(".sidebar-loader").hide();
        if (res.status) {
            $(`[data-title-${id}]`).html(res.data.title[locale]);
            $(`[data-active-${id}]`).html(
                `<i class="zmdi ${res.data.active ? 'zmdi-check-square success' : 'zmdi-minus-square danger'}"></i>`
            );
            if (res.data.image) { // todo update img
                $(`[data-image-${res.data.id}]`).attr('src', res.data.image['file_path']);
            }

        } else {
            console.log(res.message);
        }
    });
}

function delete_blog(id) {
    let conf = window.confirm("are you sure ?");
    if (!conf) return;

    sendAjaxRequest(`/blogs/${id}/delete`, {}, "post", function (res) {
        if (res.status) {
            $(`[data-id="${id}"]`).remove();
            $(".tooltip").remove();
        } else {
            console.log(res.message);
        }
    });
}

function edit_blog(id) {
    sendAjaxRequest(`/blogs/${id}/edit`, {}, "get", function (res) {
        $(".blog-edit").html(res);
        init_summernotes();
    });
}

////// end blogs section



////// products section

function submit_add_product(e) {
    e.preventDefault();

    const params = get_params(".product-form");
    const form_data = get_form_data(params);

    $(".modal-loader").show();

    sendAjaxRequest("/products/create", form_data, "post", function (res) {
        $(".modal-loader").hide();
        if (res.status) {
            location.reload();
        } else {
            console.log(res.message);
        }
    });
}

function submit_update_product(e, id) {
    e.preventDefault();

    const params = get_params(".product-update-form");
    const form_data = get_form_data(params);

    $(".sidebar-loader").show();

    sendAjaxRequest(`/products/${id}/update`, form_data, "post", function (res) {
        $(".sidebar-loader").hide();
        if (res.status) {
            $(`[data-title-${id}]`).html(res.data.brand.title[locale] + ' ' + res.data.title[locale]);
            $(`[data-active-${id}]`).html(
                `<i class="zmdi ${res.data.active ? 'zmdi-check-square success' : 'zmdi-minus-square danger'}"></i>`
            );
            if (res.data.image) { // todo update img
                $(`[data-image-${res.data.id}]`).attr('src', res.data.image.file_path);
            }
            
            $(`[data-category-${id}]`).html(res.data.category.title[locale]);
            $(`[data-price-${id}]`).html(parseFloat(res.data.price).toFixed(2));

        } else {
            console.log(res.message);
        }
    });
}

function delete_product(id) {
    let conf = window.confirm("are you sure ?");
    if (!conf) return;

    sendAjaxRequest(`/products/${id}/delete`, {}, "post", function (res) {
        if (res.status) {
            $(`[data-id="${id}"]`).remove();
            $(".tooltip").remove();
        } else {
            console.log(res.message);
        }
    });
}

function edit_product(id) {
    sendAjaxRequest(`/products/${id}/edit`, {}, "get", function (res) {
        $(".product-edit").html(res);
        init_summernotes();
    });
}

////// end products section



////// orders section

function submit_add_order(e) {
    e.preventDefault();

    const params = get_params(".order-form");
    const form_data = get_form_data(params);

    $(".modal-loader").show();

    sendAjaxRequest("/orders/create", form_data, "post", function (res) {
        $(".modal-loader").hide();
        if (res.status) {
            location.reload();
        } else {
            console.log(res.message);
        }
    });
}

function submit_update_order(e, id) {
    e.preventDefault();

    const params = get_params(".order-update-form");
    const form_data = get_form_data(params);

    $(".sidebar-loader").show();

    sendAjaxRequest(`/orders/${id}/update`, form_data, "post", function (res) {
        $(".sidebar-loader").hide();
        if (res.status) {
            $(`[data-title-${id}]`).html(res.data.title[locale]);
            $(`[data-active-${id}]`).html(
                `<i class="zmdi ${res.data.active ? 'zmdi-check-square success' : 'zmdi-minus-square danger'}"></i>`
            );
            if (res.data.image) { // todo update img
                console.log($(`[data-image-${res.data.id}]`))
                $(`[data-image-${res.data.id}]`).attr('src', res.data.image.file_path);
            }

        } else {
            console.log(res.message);
        }
    });
}

function delete_order(id) {
    let conf = window.confirm("are you sure ?");
    if (!conf) return;

    sendAjaxRequest(`/orders/${id}/delete`, {}, "post", function (res) {
        if (res.status) {
            $(`[data-id="${id}"]`).remove();
            $(".tooltip").remove();
        } else {
            console.log(res.message);
        }
    });
}

function edit_order(id) {
    sendAjaxRequest(`/orders/${id}/edit`, {}, "get", function (res) {
        $(".order-edit").html(res);
    });
}

////// end orders section

////// search section

function delay(e, callback, ms) {
    var $this = $(e.target);

    clearTimeout($.data(e.target, 'timer'));
    var wait = setTimeout(function () {
        callback && typeof callback == 'function' && callback();
    }, ms);
    $this.data('timer', wait);  
}

function search_in_table(e, modal) {
    let keyword = e.target.value;

    delay(e, function() {
        sendAjaxRequest(`/search/${modal}?keyword=${keyword}`, null, "get", function (res) {
            $('#table-result').html(res);
        });
    }, 500);

}


function search_by_keyword(e) {

    let keyword = e.target.value;
    if (keyword.length < 1) {
        $("#search_result").html("");
        return;
    }

    delay(e, function() {    
        sendAjaxRequest(`/search?keyword=${keyword}`, null, "get", function(res) {
            $("#search_result").html(res);
        });
    }, 500);
}

////// end search section


///// files section

function on_file_upload(e) {
    let file = e.target.files[0];
    let file_preview = $('.file_preview');
    if(!file) {
    //  file_preview.attr('src', '');   
     return;
    }

    var reader = new FileReader();

    reader.onload = function (e) {
        file_preview.attr('src', e.target.result);
    }

    reader.readAsDataURL(file); // convert to base64 string
}

function on_files_upload(e) {
    let files = e.target.files;
    let file_preview_wrap = $('.file_preview_wrap');
    if (!files.length) {
        file_preview_wrap.empty();
        return;
    }
    
    for(let i=0; i<files.length; i++) {
        let file = files[i];
        let str = '';
        var reader = new FileReader();

        reader.onload = function (e) {
            str+= `
                <div class="file_preview_inner_wrap">
                    <img src="${e.target.result}" alt="" class="file_preview">
                </div>
            `;
            file_preview_wrap.append(str);
        }
        reader.readAsDataURL(file); // convert to base64 string

    }
}

function delete_image(image_id, parent_id = null) {

    let conf = window.confirm("are you sure ?");
    if (!conf) return;

    sendAjaxRequest(`/files/${image_id}/delete`, {}, "post", function (res) {
        if (res.status) {
            $("[data-image=" + image_id + "]").remove();
            parent_id != null && $("[data-image-" + parent_id + "]").attr('src', '');
        } else {
            console.log(res.message);
        }
    });
}

///// end files section



function toggle_collapse_sidebar(e) {
    $('.main_table').toggleClass('col-md-7');
    $('.main_table').toggleClass('col-md-12');
    $(e.target).toggleClass('zmdi-arrow-right');
    $(e.target).toggleClass('zmdi-arrow-left');
}


function init_summernotes() {
    let summernotes = $('.summernote');
    if (summernotes.length > 0) {
        summernotes.summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture']],
            ],
            height: 300,
        });
    }
}

$(function() {
    init_summernotes();
})