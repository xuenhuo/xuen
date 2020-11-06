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

    maurl = '/admin/managers';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#manager input[name="_token"]').val()
        }
    });

    $('#maadd').click(function () {
        $('#manager').trigger('reset');
        $('#manager-title').text('添加管理员');
        $('#masave').val('add');
        $('#managerModel').modal('show');
    });

    $('#masave').click(function () {
        if($('#masave').val() == 'add') {
            durl = maurl;
            var method = "POST"; // add
        }
        else {
            durl = maurl + '/' + $('#maid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('name',$('#maname').val());
        data.append('email',$('#maemail').val());
        data.append('password',$('#mapassword').val());
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
                $('#managerModel').modal('hide');
                var manager = '<tr id="manager' + data.id + '">' +
                    '<td>'+ data.id +'</td>' +
                    '<td>'+ escapeHtml(data.name) +'</td>' +
                    '<td>'+ escapeHtml(data.email) +'</td>' +
                    '<td><button class="btn btn-info maedit" value="'+ data.id +'">编辑</button> <button class="btn btn-danger madelete" value="'+ data.id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(manager);
                if(method == 'POST') {
                    $('#manager-list').append(manager);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#manager'+data.id).replaceWith(manager);
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