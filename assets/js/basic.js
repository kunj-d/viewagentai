$(function() {
    $.ajaxSetup({
        beforeSend: function() {
            $(".pageloader").show();
        },
        complete: function() {
            $(".pageloader").hide();
        }
    });

    $('.form_ajax').on('submit', function(event) {
        event.preventDefault();
        $that = $(this);
        $.ajax({
            type: "POST",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            url: $(this).attr('action'),
            data: new FormData(this),
            beforeSend: function() {
                $(".form_success").html("");
                $(".form_error").html("");
            },
            success: function(response) {
                showFlash(response, $that);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //alert('Error in Posting Data');
            }
        });
    });

    $('.form_ajax_loader').on('submit', function(event) {
        event.preventDefault();
        $that = $(this);
        jsLoader(true);
        $.ajax({
            type: "POST",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            url: $(this).attr('action'),
            data: new FormData(this),
            beforeSend: function() {
                $(".form_success").html("");
                $(".form_error").html("");
            },
            success: function(response) {
                jsLoader(false);
                showFlash(response, $that);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //alert('Error in Posting Data');
            }
        });
    });



    $(".pageloader").hide();
    callCron();
    callUserUpdate();

    // function jsLoader(add) {
    //     if (add === undefined) {
    //         add = false;
    //     }
    //     $(".temp_js_loader").remove();
    //     if (add) {
    //         $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;">\
	// 	<img src="' + siteUrl + 'assets/default/images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;"></div>');
    //     }
    // }
});

function showFlash(response, $that) { // used to show action message
    if ($that === undefined) {
        $that = '';
    }
    if (response.success) {
        if (response.success.type == "flash") {
            flashNow(response);
        } else {

            $(".form_success_message").html(response.success.message);
            fn_reset_form(response);
        }
    } else if (response.error) {
        if (response.error.type == "flash") {
            flashNow(response);
        } else {
            $.each(response.error, function(index, value) {
                var error_msg = value.replace("is required", "shouldn’t be empty");
                $(".form_error_" + index).html(error_msg.replace("{field}", index));
            });

            var errorDiv = $('.form_error P:visible').first();
            var scrollPos = errorDiv.offset().top;
            scrollPos = parseInt(scrollPos - 100);
            $(window).scrollTop(scrollPos);
        }
    }

    if (response.redirect) {
        if (response.redirect == "reload") {
            location.reload();
        } else {
            if(response.open_new_tab){
                window.open(response.redirect, '_blank');
            }else{
                document.location = response.redirect;
            }
        }
    }


}

function flashNow(response) {
    if (response.error) {
        //$.notify(response.error.message, "error");
        notify("error", response.error.message);
    } else {
        //$.notify(response.success.message, "success");
        notify("success", response.success.message);
        fn_reset_form(response);
    }

    if (response.table && response.table.reload) {
        table.ajax.reload();
    }

    //Add By Gajendra
    if (response.callback_angular) {
        angular.element("#customersCtrl").scope().callback_angular();
    }
}
function fn_reset_form(response) {
    if (response.reset_form) {
        reset_form = $('#' + response.reset_form.form_id);
        reset_form.find("input").val('');
        reset_form.find("textarea").val('');
        reset_form.find("select").val('');

        if (response.reset_form.default_thumbnail) {
            default_thumb = response.reset_form.default_thumbnail;
            reset_form.find("img").attr('src', default_thumb);
        }
        if (response.reset_form.cencel_btn_id) {
            cancel_btn = $('#' + response.reset_form.cencel_btn_id);
            cancel_btn.click();
        }

    }
}
function selectcheckbox(className) { //select all checkboxes
    $(document).on("change", ".select_all_" + className, function() {
        var status = this.checked;
        $("." + className).each(function() {
            $(this).prop("checked", status);
        });
    });

    $(document).on("change", "." + className, function() {
        if (this.checked == false) {
            $(".select_all_" + className)[0].checked = false;
        }
        if ($('.' + className + ':checked').length == $('.' + className).length) {
            $(".select_all_" + className)[0].checked = true;
        }
    });
}

function enableActionBtn(className) {
    $(document).on("change", $(".select_all_" + className, "." + className), function() {
        $(".bulk_action").removeClass('disable');
        if ($('.' + className + ':checked').length == 0) {
            $(".bulk_action").addClass('disable');
        }
    });
}

function deleteConfirm(callback, msg , msgheading) {
    $("#deleteModal").modal("show");
    if (msg === undefined) {
        msg = 'Are you sure to delete?';
    }
    if (msgheading === undefined) {
        msgheading = 'Deleting This';
    }
    $(".delete-confirm-msg").html(msg);
    $(".delete-confirm-msg-heading").html(msgheading);
    $('.delete-yes-btn').off('click');
    $('#deleteModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('.delete-yes-btn').on('click', function(e) {
        $("#deleteModal").modal("hide");
        callback();
    });
}


function notify(type, text) {


    if (type == 'error') {
        PNotify.removeAll();
        new PNotify({
            title: 'Error!',
            text: text,
            type: type
        });
        /*
         var html = $('<div class="alert alert-custom alertDanger alert-dismissable md16">\
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">\
         <i class="icon icon-cross md15 sm14 xs14" aria-hidden="true"></i></button>\
         <i class="icon icon-alert md20"></i>&nbsp;&nbsp; '+text+'\
         </div>');*/
    } else {
        PNotify.removeAll();
        new PNotify({
            title: 'Success!',
            text: text,
            type: type
        });/*
         var html = $('<div class="alert alert-custom alertSuccess alert-dismissable md16 text-ellipsis">\
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">\
         <i class="icon icon-cross md15 sm14 xs14" aria-hidden="true"></i></button>\
         <i class="icon icon-success md20"></i>&nbsp;&nbsp; '+text+'\
         </div>');*/
    }
    setTimeout(function() {
        PNotify.removeAll();
    }, 3000);
}


function callCron() {
    // $.post(siteUrl+'crons/Crons_controller',
    // {},
    // function(data, status){
    // });
}

function callUserUpdate() {
    // $.post(siteUrl+'user/App_controller/session_update',
    // {},
    // function(data, status){
    // });
}

function loginUserLogData() {
    $.ajax({
        type: "POST",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        url: siteUrl + 'user/Login_userlog_controller/index',
        data: '',
        beforeSend: function() {
            $(".form_success").html("");
            $(".form_error").html("");
        },
        success: function(response) {
            showFlash(response, $that);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
    });
}
