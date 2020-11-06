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

    aturl = '/admin/attributes';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#detail input[name="_token"]').val()
        }
    });

    $('#dtadd').click(function () {
        $('#detail').trigger('reset');
        $('#detail-title').text('添加款式细节');
        $('#dtsave').val('add');
        $('#detailModal').modal('show');
    });

    $('#detail-list').on('click', 'button.dtdelete', function() {
        var dturl = $(data).val('url');
        var dtid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: dturl,
            success: function (data) {
                console.log(data);
                $('#detail'+dtid).remove();
            },
        });
    });

    $('#detail-list').on('click', 'button.dtedit', function() {
        $('#detail').trigger('reset');
        $('#detail-title').text('编辑款式细节');
        $('#dtsave').val('update');
        var dtid = $(this).val();
        $('#dtid').val(dtid);
        var dturl = $(this).data('url');
        console.log(aturl+dturl+'/'+dtid);
        $.get(aturl+dturl+'/'+dtid, function (data) {
            console.log(data);
            $('#dttitle').val(data[0].title);
            $('#dtprice').val(data[0].price);
            $('#dtposition').val(data[0].position);
            $('#attribute_id').val(data[1]);
        });

        $('#detailModal').modal('show');
    });

    $('#dtsave').click(function () {
        if($('#dtsave').val() == 'add') {
            durl = aturl + $(this).data('url');
            var method = "POST"; // add
        }
        else {
            durl = ataurl + $(this).data('url') +'/'+ $('#dtid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('title',$('#dttitle').val());
        data.append('price',$('#dtprice').val());
        data.append('position',$('#dtposition').val());
        data.append('attribute_id',$('#attribute_id').val());
        data.append('_method', method);
        

        console.log('save url:'+durl);
        console.log(data);

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
                $('#detailModal').modal('hide');
                var detail = '<tr id="detail' + data[0].id + '">' +
                    '<td>'+ escapeHtml(data[0].attribute_id) +'</td>' +
                    '<td>'+ escapeHtml(data[0].title) +'</td>' +
                    '<td>'+ escapeHtml(data[0].price) +'</td>' +
                    '<td><button class="btn btn-info dtedit" value="'+ data[0].id +'" data-url="/'+data[0].attribute_id+'/attribute_details">编辑</button> <button class="btn btn-danger dtdelete"  value="'+ data[0].id +'" data-url="'+aturl+'/'+data[0].attribute_id+'/attribute_details/'+data[0].id+'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(detail);
                if(method == 'POST') {
                    $('#detail-list').append(detail);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#detail'+data.id).replaceWith(detail);
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