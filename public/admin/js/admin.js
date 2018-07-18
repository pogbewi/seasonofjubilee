/**
 * Created by Esther on 1/20/2018.
 */


function confirmExport(form_id, title, message, button_cancel, button_delete) {
    $('#confirm-modal').remove();

    var html  = '';

    html += '<div class="modal modal-info fade in" id="export-modal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">';
    html += '  <div class="modal-dialog">';
    html += '      <div class="modal-content">';
    html += '          <div class="modal-header">';
    html += '              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    html += '              <h4 class="modal-title" id="confirmModalLabel"><i class="fa fa-forward"></i> ' + title + '</h4>';
    html += '          </div>';
    html += '          <div class="modal-body">';
    html += '              <p>' + message + '</p>';
    html += '              <p></p>';
    html += '          </div>';
    html += '          <div class="modal-footer">';
    html += '              <button type="button" class="btn btn-default" data-dismiss="modal">' + button_cancel + '</button>';
    html += '              <button type="button" class="btn btn-info submit-dialog">' + button_delete + '</button>';
    html += '          </div>';
    html += '      </div>';
    html += '  </div>';
    html += '</div>';

    $('body').append(html);

    $('#export-modal').modal('show');
}

function confirmDelete(form_id, title, message, button_cancel, button_delete) {
    $('#confirm-modal').remove();

    var html  = '';

    html += '<div class="modal modal-danger fade in" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">';
    html += '  <div class="modal-dialog">';
    html += '      <div class="modal-content">';
    html += '          <div class="modal-header">';
    html += '              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    html += '              <h4 class="modal-title" id="confirmModalLabel"><i class="fa fa-trash"></i> ' + title + '</h4>';
    html += '          </div>';
    html += '          <div class="modal-body">';
    html += '              <p>' + message + '</p>';
    html += '              <p></p>';
    html += '          </div>';
    html += '          <div class="modal-footer">';
    html += '              <button type="button" class="btn btn-default" data-dismiss="modal">' + button_cancel + '</button>';
    html += '              <button type="button" class="btn btn-danger submit-dialog">' + button_delete + '</button>';
    html += '          </div>';
    html += '      </div>';
    html += '  </div>';
    html += '</div>';

    $('body').append(html);

    $('#delete-modal').modal('show');
}

$(document).on('click', '.popup', function(e) {
    e.preventDefault();

    $('#modal-popup').remove();

    var element = this;

    $.ajax({
        url: $(element).attr('href'),
        type: 'get',
        dataType: 'html',
        success: function(data) {
            html  = '<div class="modal" id="modal-popup">';
            html += '  <div class="modal-dialog">';
            html += '    <div class="modal-content">';
            html += '      <div class="modal-header">';
            html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            html += '        <h4 class="modal-title">' + $(element).text() + '</h4>';
            html += '      </div>';
            html += '      <div class="modal-body">' + data + '</div>';
            html += '    </div';
            html += '  </div>';
            html += '</div>';

            $('body').append(html);

            $('#modal-popup').modal('show');
        }
    });
});

$(document).ready(function () {
    $('.delete').on('click', function(e) {
        var context = $(this);
        var id = $(this).attr('data-id');
        var url = $(this).data('url');
        confirmDelete("' . '#' . str_singular($page) . '-' . id . '", "Delete", "Are You sure You want To Delete ?", "Cancel", "Delete");
        $('.submit-dialog').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                cache:false,
                type: 'DELETE',
                url: url,
                data: 'ids=' + id,
                async:true,
                dataType:'json',
                success: function (data) {
                    $('#delete-modal').modal('hide');
                    if (data['success']) {
                        $('table').find(context).parents("tr").remove();
                        context.parent("tr").slideUp("slow");
                        swal('success',data['success']);
                    } else if (data['error']) {
                        swal('error',data['error']);
                    } else {
                        swal('error','Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    $('#delete-modal').modal('hide');
                    swal('error','Oops something went wrong');
                }
            });
            $('table tr').filter("[data-row-id='" + id + "']").remove();
        });
    });
});

$(document).ready(function () {
    $('.delete_all').on('click', function(e) {
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).attr('data-id'));
        });
        if(allVals.length <=0)
        {
            swal('error',"Please select at least a row.");
        }  else {
            confirmDelete("' . '#' . str_singular($page) . '-' . allVals . '", "Delete", "Are You sure You want To Delete Seleted Item ?", "Cancel", "Delete");

            var join_selected_values = allVals.join(",");
            var url = $(this).data('url')+ '/'+join_selected_values;

            $('.submit-dialog').on('click', function(e) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        'ids': join_selected_values,
                        'id' : "hmm!"
                    },
                    dataType:"json",
                    success: function (data) {
                        $('#delete-modal').modal('hide');
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {
                                $(this).parents("tr").remove();
                            });
                            swal('success',data['success']);
                        } else if (data['error']) {
                            swal('error',data['error']);
                        } else {
                            swal('error','Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        $('#delete-modal').modal('hide');
                        swal('error','Oops something went wrong');
                    }
                });
                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
            });
        }
    });


    $(document).on('confirm', function (e) {
        var ele = e.target;
        e.preventDefault();
        $.ajax({
            cache:false,
            type: 'DELETE',
            url: ele.href,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            async:true,
            dataType:"json",
            success: function (data) {
                if (data['success']) {
                    $("#" + data['tr']).slideUp("slow");
                    swal('success',data['success']);
                } else if (data['error']) {
                    swal('error','Whoops Something went wrong!!');
                } else {
                    swal('error','Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                swal('error','Whoops Something went wrong!!');
            }
        });
        return false;
    });
});

$(document).on('click', '.panel-heading a.panel-action[data-toggle="panel-collapse"]', function(e){
    e.preventDefault();
    var $this = $(this);

    // Toggle Collapse
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('savysoft-angle-down').addClass('savysoft-angle-up');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('savysoft-angle-up').addClass('savysoft-angle-down');
    }
});

//Toggle fullscreen
$(document).on('click', '.panel-heading a.panel-action[data-toggle="panel-fullscreen"]', function (e) {
    e.preventDefault();
    var $this = $(this);
    if (!$this.hasClass('savysoft-resize-full')) {
        $this.removeClass('savysoft-resize-small').addClass('savysoft-resize-full');
    } else {
        $this.removeClass('savysoft-resize-full').addClass('savysoft-resize-small');
    }
    $this.closest('.panel').toggleClass('is-fullscreen');
});

$('.submit-url').click(function() {
    var url = $('#url').val();
    var image_url = getVideoThumbnail(url);
    var notice = $('.notify');
    var urlSrc;
    notice.show();
    if(url != undefined || url != ''){
        var videoObj = parseUrl(url);
        if(videoObj.type == 'youtube'){
            urlSrc = "https://www.youtube.com/embed/" + videoObj.id + "?rel=0&wmode=transparent&showinfo=0";
            $("#video").attr('src',urlSrc);
        }else if(videoObj.type == 'vimeo'){
            urlSrc = "https://player.vimeo.com/video/" +  videoObj.id + "?rel=0&wmode=transparent&showinfo=0";
            $("#video").attr('src',urlSrc );
        }else{
            notice.html('<div class="alert alert-warning alert-dismissible">No Match, Probably url doeanot exists</div>');
            notice.slideUp(8000);
        }
    }else {
        notice.html('<div class="alert alert-warning alert-dismissible">Url empty or not valid</div>');
        notice.slideUp(8000);
    }
    $(document).on('click','button#save-media', function(e) {
        e.preventDefault();
        var url_route = $(this).data('url');
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            type: "POST",
            url: url_route,
            data: {
                'image_url': image_url,
                'url':url,
                'id':id
            },
            success: function(data, status){
                   swal(status,data.success);
                $('#modal-embed-media').modal('hide');
            },
            error:function(data, status){
                swal(status, data.error);
            }
        });
    });

});

function parseUrl(url){
    var type;
    var pattern = url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

    if (RegExp.$3.indexOf('youtu') > -1) {
         type = 'youtube';
        return {
            type: type,
            id: RegExp.$6
        };
    } else if (RegExp.$3.indexOf('vimeo') > -1) {
        var v = url.match(/https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/);
         type = 'vimeo';
        return {
            type: type,
            id: RegExp.$3
        };
    }
    return {
        type: type,
        id: RegExp.$6
    };
}

function getVideoThumbnail (url) {
    var cb;
    // Obtains the video's thumbnail and passed it back to a callback function.
    var videoObj = parseUrl(url);
    if (videoObj.type == 'youtube') {
        cb= 'http://img.youtube.com/vi/' + videoObj.id + '/maxresdefault.jpg';
    } else if (videoObj.type == 'vimeo') {
        // Requires jQuery
      /*  $.getJSON('https://vimeo.com/api/v2/video/' + videoObj.id + '.json', function (data, status) {
            cb = data[0]['thumbnail_large'];
        });*/

        var x = new XMLHttpRequest();
        x.open("GET","https://vimeo.com/api/v2/video/" + videoObj.id + ".xml",true);
        x.onreadystatechange = function(){
            if(x.readyState == 4 && x.status == 200){
                var doc = x.responseXML;
                cb = doc.getElementsByTagName("thumbnail_large")[0].innerHTML;
            }
        };
        x.send(null);
    }
    return cb;
}

$('.close').click(function() {
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-url');
    var $this = $(this);
    $this.html('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.post({
        type: "POST",
        url: url,
        data: {
            'url':url,
            'id':id
        },
        success: function(data, status){
            swal(status, data.success);
            $this.closest('.img-wrap').parents(".media").remove();
            $this.closest(".media").slideUp("slow");
        },
        error:function(data, status){
            swal(status, data.error);
        }
    });
});

jQuery(function($) {
    $(document).on('change', '#image', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var file_data = $(this).prop("files")[0];
        var formData = new FormData();
        formData.append('file',file_data);
        var panel_body = $('.panel-body');
        panel_body.find('.inform').empty();
        var url = $(this).attr('data-url');
        $.ajax({
            cache:false,
            type: "POST",
            url: url,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            data: formData,
            async:true,
            dataType:"json",
            beforeSend: function(xhr){
                panel_body.find('.inform').html('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
            },
            success: function(data, status){
                panel_body.find('.inform').html('<img src=/storage/'+data['path']+' class="image-responsive image-thumbnail" width="100%">');
                $('#photo').attr('value', data['file']);
            },
            error:function(data, status){
                panel_body.find('.inform').html('<p>'+ data['msg']+'</p>');
            },
            complete: function(){

            }
        });
    });
});

$('.submit-embeded-url').click(function() {
    var url = $('#embed_url').val();
    var image_url = getVideoThumbnail(url);
    var notice = $('.notify');
    var urlSrc;
    notice.show();
    if(url != undefined || url != ''){
        var videoObj = parseUrl(url);
        if(videoObj.type == 'youtube'){
            urlSrc = "https://www.youtube.com/embed/" + videoObj.id + "?rel=0&wmode=transparent&showinfo=0";
            $('#video').prop('src',urlSrc);
            $("input[id=url]").val(urlSrc);
            $("input[id=embed_id]").val(videoObj.id);
            $("input[id=type]").val(videoObj.type);
            $("input[id=video_thumb]").val(image_url);
            $(".embed-responsive").removeAttr('style');
        }else if(videoObj.type == 'vimeo'){
            urlSrc = "https://player.vimeo.com/video/" +  videoObj.id + "?rel=0&wmode=transparent&showinfo=0";
            $("#video").attr('src',urlSrc );
            $("input[id=url]").val(urlSrc);
            $("input[id=embed_id]").val(videoObj.id);
            $("input[id=type]").val(videoObj.type);
            $("input[id=video_thumb]").val(image_url);
            $(".embed-responsive").removeAttr('style');
        }else{
            notice.html('<div class="alert alert-warning alert-dismissible">No Match, Probably url doeanot exists</div>');
            notice.slideUp(8000);
        }
    }else {
        notice.html('<div class="alert alert-warning alert-dismissible">Url empty or not valid</div>');
        notice.slideUp(8000);
    }
});

jQuery(function($) {
    $(document).on('change', '#file_upload', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var file_data = $(this).prop("files")[0];
        var formData = new FormData();
        formData.append('file',file_data);
        var panel_body = $('.panel-body');
        panel_body.find('.inform').empty();
        var url = $(this).attr('data-url');
        $.ajax({
            cache:false,
            type: "POST",
            url: url,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            data: formData,
            async:true,
            dataType:"json",
            beforeSend: function(xhr){
                panel_body.find('.inform').html('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
            },
            success: function(data, status){
                panel_body.find('.inform').html('<img src=/'+data['path']+' class="image-responsive image-thumbnail" width="100%">');
                $("input[id=filename]").val(data['file']);
                $("input[id=video_thumb]").val(data['path']);
                $("input[id=size]").val(data['size']);
                $("input[id=type]").val(data['type']);
            },
            error:function(data, status){
                panel_body.find('.inform').html('<p>'+ data['msg']+'</p>');
            },
            complete: function(){

            }
        });
    });
});

jQuery(function($) {
    $(document).on('change', '#audio_upload', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var file_data = $(this).prop("files")[0];
        var formData = new FormData();
        formData.append('file',file_data);
        var panel_body = $('.panel-body');
        panel_body.find('.inform').empty();
        var url = $(this).attr('data-url');
        $.ajax({
            cache:false,
            type: "POST",
            url: url,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            data: formData,
            async:true,
            dataType:"json",
            beforeSend: function(xhr){
                panel_body.find('.inform').html('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
            },
            success: function(data, status){
                panel_body.find('.inform').html('<img src=/'+data['path']+' class="image-responsive image-thumbnail" width="100%">');
                $("input[id=filename]").val(data['file']);
                $("input[id=audio_thumb]").val(data['path']);
                $("input[id=size]").val(data['size']);
                $("input[id=type]").val(data['type']);
            },
            error:function(data, status){
                panel_body.find('.inform').html('<p>'+ data['msg']+'</p>');
            },
            complete: function(){

            }
        });
    });
});

jQuery(function($) {
    $(document).on('change', '#gallery_image', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var file_data = $(this).prop("files")[0];
        var formData = new FormData();
        formData.append('file',file_data);
        var panel_body = $('.panel-body');
        panel_body.find('.inform').empty();
        var url = $(this).attr('data-url');
        $.ajax({
            cache:false,
            type: "POST",
            url: url,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            data: formData,
            async:true,
            dataType:"json",
            beforeSend: function(xhr){
                panel_body.find('.inform').html('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
            },
            success: function(data, status){
                panel_body.find('.inform').html('<img src=/storage'+data['path']+' class="image-responsive image-thumbnail" width="100%">');
                $("input[id=filename]").val(data['file']);
                $("input[id=size]").val(data['size']);
                $("input[id=type]").val(data['type']);
            },
            error:function(data, status){
                panel_body.find('.inform').html('<p>'+ data['msg']+'</p>');
            },
            complete: function(){

            }
        });
    });
});

$(document).ready(function () {
    $('.approve').on('click',function(e) {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var $this = $(this);
        $(this).append('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            cache:false,
            url: url,
            data: {
                'id':id
            },
            dataType:"json",
            success: function(data, status){
                swal(status, data.success);
                $this.html('Approved');
                $this.attr('disabled', 'disabled');
            },
            error:function(data, status){
                swal(status, data.error);
            }
        });
    });
});

$('.comment').click(function() {
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-url');
    var ischecked = $(this).is(':checked');
    var $this = $(this);
    $this.html('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "PUT",
        cache:false,
        url: url,
        data: {
            'id':id,
            'isChecked':ischecked
        },
        dataType:"json",
        success: function(data, status){
            swal(status, data.success);
        },
        error:function(data, status){
            swal(status, data.error);
        }
    });
});

$(document).ready(function () {
    $('.export_excel').on('click', function(e) {
        e.preventDefault();
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).attr('data-id'));
        });
        if(allVals.length <=0)
        {
            swal('error',"Please select at least a row.");
        }  else {
            confirmExport("' . '#' . str_singular($page) . '-' . allVals . '", "Export", "The selected row will be download in excel format?", "Cancel", "Export");

            $('.submit-dialog').on('click', function(e) {
                $('#ids').val(allVals.join(","));
                $('#export-modal').modal('hide');
                $('#check_lists').submit();
            });
        }
    });
});