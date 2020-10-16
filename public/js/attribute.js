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

    ataurl = '/admin/attributes';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#attribute input[name="_token"]').val()
        }
    });

    $('#atadd').click(function () {
        $('#attribute').trigger('reset');
        $('#attribute-title').text('添加款式');
        $('#atsave').val('add');
        $('#attributeModal').modal('show');
    });

    $('#attribute-list').on('click', 'button.atdelete', function() {
        var atid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: aturl+'/'+atid,
            success: function (data) {
                console.log(data);
                $('#attribute'+atid).remove();
            },
        });
    });

    $('#attribute-list').on('click', 'button.atedit', function() {
        $('#attribute').trigger('reset');
        $('#attribute-title').text('编辑款式');
        $('#atsave').val('update');
        var atid = $(this).val();
        $('#atid').val(atid);
        console.log(aturl+'/'+atid);
        $.get(aturl+'/'+atid, function (data) {
            console.log(data);
            $('#attitle').val(data.title);
            $('#atis_multi').prop("checked", data.is_multi);
            $('#atposition').val(data.position);
        });

        $('#attributeModal').modal('show');
    });

    $('#atsave').click(function () {
        if($('#atsave').val() == 'add') {
            turl = aturl;
            var method = "POST"; // add
        }
        else {
            turl = aturl + '/' + $('#atid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('title',$('#attitle').val());
        data.append('is_multi',$('#atis_multi').prop('checked') ? 1 : 0);
        data.append('position',$('#atposition').val());
        data.append('_method', method);

        console.log('save url:'+turl);
        console.log(data);

        $.ajax({
            type: 'POST',
            url: turl,
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#attributeModal').modal('hide');
                var attribute = '<tr id="attribute' + data.id + '">' +
                    '<td>'+ escapeHtml(data.title) +'</td>' +
                    '<td>'+ escapeHtml(data.position) +'</td>' +
                    '<td><a class="btn btn-info" href="'+aturl+'/'+data.id+'/attribute_details">详细</a> <button class="btn btn-info atedit" value="'+ data.id +'">编辑</button> <button class="btn btn-danger atdelete"  value="'+ data.id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(attribute);
                if(method == 'POST') {
                    $('#attribute-list').append(attribute);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#attribute'+data.id).replaceWith(attribute);
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