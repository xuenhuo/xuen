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

    cturl = '/contacts';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#contact input[name="_token"]').val()
        }
    });

    $('#ctadd').click(function () {
        $('#contact').trigger('reset');
        $('#contact-title').text('添加联系方式');
        $('#ctsave').val('add');
        $('#contactModal').modal('show');
    });

    $('#contact-list').on('click', 'button.ctdelete', function() {
        var ctid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: cturl+'/'+ctid,
            success: function (data) {
                console.log(data);
                $('#contact'+ctid).remove();
            },
        });
    });

    $('#contact-list').on('click', 'button.ctedit', function() {
        $('#contact').trigger('reset');
        $('#contact-title').text('编辑联系方式');
        $('#ctsave').val('update');
        var ctid = $(this).val();
        $('#ctid').val(ctid);
        $.get(cturl+'/'+ctid, function (data) {
            $('#ctname').val(data.name);
            $('#ctphone_num').val(data.phone_num);
            $('#ctaddress').val(data.address);
            $('#user_id').val(data.user_id);
        });

        $('#contactModal').modal('show');
    });

    $('#ctsave').click(function () {
        if($('#ctsave').val() == 'add') {
            curl = cturl;
            var method = "POST"; // add
        }
        else {
            curl = cturl + '/' + $('#ctid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('name', $('#ctname').val());
        data.append('phone_num',$('#ctphone_num').val());
        data.append('address',$('#ctaddress').val());
        data.append('user_id',$('#user_id').val());
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
                $('#contactModal').modal('hide');
                var contact = '<tr id="contact' + data.id + '">' +
                    '<td>'+ escapeHtml(data.name) +'</td>' +
                    '<td>'+ escapeHtml(data.phone_num) +'</td>' +
                    '<td>'+ escapeHtml(data.address) +'</td>' +
                    '<td><button class="btn btn-info ctedit" value="'+ data.id +'">编辑</button> <button class="btn btn-danger ctdelete" value="'+ data.id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(contact);
                if(method == 'POST') {
                    $('#contact-list').append(contact);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#contact'+data.id).replaceWith(contact);
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