$(document).ready(function () {
    function escapeHtml(string) {
        var entityMap = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': '&quot;',
            "'": '&#39;',
            "/": '&#x2F;'
        };
        return String(string).replace(/[&<>"'\/]/g, function (s) {
            return entityMap[s];
        });
    }

    adurl = '/admin/ads';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#ad input[name="_token"]').val()
        }
    });

    $('#adadd').click(function () {
        $('#ad').trigger('reset');
        $('#ad-title').text('添加广告');
        $('#adsave').val('add');
        $('#adModel').modal('show');
    });

    $('#ad-list').on('click', 'button.addelete', function() {
        var adid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: url+'/'+adid,
            success: function (data) {
                console.log(data);
                $('#ad'+adid).remove();
            },
        });
    });

    $('#ad-list').on('click', 'button.adedit', function() {
        $('#ad-title').text('编辑广告');
        $('#adsave').val('update');
        var adid = $(this).val();
        $('#adid').val(adid);
        $.get(adurl+'/'+adid, function (data) {
            console.log(arurl+adid);
            console.log(data);
            $('#adtitle').val(data.title);
            $('#adsubtitle').val(data.subtitle);
            $("#viewAdphoto").attr("src", "/storage/ads/"+ data.photo);
            $("#viewAdphoto").css("display", "block");
        });

        $('#adModel').modal('show');
    });

    $('#adsave').click(function () {
        if($('#adsave').val() == 'add') {
            durl = adurl;
            var method = "POST"; // add
        }
        else {
            durl = adurl + '/' + $('#adid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('photo', $('#adphoto')[0].files[0]);
        data.append('title',$('#adtitle').val());
        data.append('subtitle',$('#adsubtitle').val());
        data.append('_method', method);

        $.ajax({
            type: 'POST',
            url: durl,
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#adModel').modal('hide');
                var ad = '<tr id="ad' + data.id + '">' +
                    '<td>'+ data.id +'</td>' +
                    '<td>'+ escapeHtml(data.title) +'</td>' +
                    '<td>'+ escapeHtml(data.subtitle) +'</td>' +
                    '<td><img src="/storage/ads/'+ data.photo + '" style="width:100px;height:100px"/></td>' +
                    '<td><button class="btn btn-info adedit" value="'+ data.id +'">编辑</button> <button class="btn btn-danger addelete" value="'+ data.id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(ad);
                if(method == 'POST') {
                    $('#ad-list').append(ad);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#ad'+data.id).replaceWith(ad);
                    // toastr.success('编辑成功！');
                }
            },
            error: function (data, json, errorThrown) {
                console.log(data);
                $('#debug').html(data.responseText);

                var errors = data.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                // toastr.error( errorsHtml , "Error " + data.status +': '+ errorThrown);
            }
        });
    });
});