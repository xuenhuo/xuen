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

    cgurl = '/admin/categories';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#category input[name="_token"]').val()
        }
    });

    $('#cgadd').click(function () {
        $('#category').trigger('reset');
        $('#category-title').text('添加文章');
        $('#cgsave').val('add');
        $("#viewCgphoto").css("display", "none");
        $('#categoryModal').modal('show');
    });

    $('#category-list').on('click', 'button.cgdelete', function() {
        var cgid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: cgurl+'/'+cgid,
            success: function (data) {
                console.log(data);
                $('#category'+cgid).remove();
            },
        });
    });

    $('#category-list').on('click', 'button.cgedit', function() {
        $('#category').trigger('reset');
        $('#category-title').text('编辑文章');
        $('#cgsave').val('update');
        var cgid = $(this).val();
        $('#cgid').val(cgid);
        $.get(cgurl+'/'+cgid, function (data) {
            $('#cgtitle').val(data.title);
            $('#cgposition').val(data.position);
            $('#cgdisabled').prop("checked", data.disabled);
            $("#viewCgphoto").attr("src", "/storage/categories/"+ data.photo);
            $("#viewCgphoto").css("display", "block");
        });

        $('#categoryModal').modal('show');
    });

    $('#cgsave').click(function () {
        if($('#cgsave').val() == 'add') {
            curl = cgurl;
            var method = "POST"; // add
        }
        else {
            curl = cgurl + '/' + $('#cgid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('photo', $('#cgphoto')[0].files[0]);
        data.append('title',$('#cgtitle').val());
        data.append('position',$('#cgposition').val());
        data.append('disabled',$('#cgdisabled').prop('checked') ? 1 : 0);
        data.append('_method', method);
        

        console.log('save url:'+curl);
        console.log(data);

        $.ajax({
            type: 'POST',
            url: curl,
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#categoryModal').modal('hide');
                var category = '<tr id="category' + data.id + '">' +
                    '<td>'+ escapeHtml(data.title) +'</td>' +
                    '<td><img src="/storage/categories/'+ data.photo + '" style="width:100px;height:100px"/></td>' +
                    '<td>'+ escapeHtml(data.disabled) +'</td>' +
                    '<td><button class="btn btn-info cgedit" value="'+ data.id +'">编辑</button> <button class="btn btn-danger cgdelete" value="'+ data.id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(category);
                if(method == 'POST') {
                    $('#category-list').append(category);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#category'+data.id).replaceWith(category);
                    // toastr.success('编辑成功！');
                }
            },
            // error: function (data, json, errorThrown) {
            //     console.log(data);
            //     $('#debug').html(data.responseText);

            //     var errors = data.responseJSON;
            //     var errorsHtml= '';
            //     $.each( errors, function( key, value ) {
            //         errorsHtml += '<li>' + value[0] + '</li>';
            //     });
            //     // toastr.error( errorsHtml , "Error " + data.status +': '+ errorThrown);
            // }
        });
    });
});