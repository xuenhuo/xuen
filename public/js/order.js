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

    odurl = '/admin/orders';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#order input[name="_token"]').val()
        }
    });

    $('#order-list').on('click', 'button.oddelete', function() {
        var odid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: odurl+'/'+odid,
            success: function (data) {
                console.log(data);
                $('#order'+odid).remove();
            },
        });
    });

    $('#order-list').on('click', 'button.odedit', function() {
        $('#order').trigger('reset');
        $('#order-title').text('编辑产品');
        $('#odsave').val('update');
        var odid = $(this).val();
        $('#odid').val(odid);
        console.log(odurl+'/'+odid);
        $.get(odurl+'/'+odid, function (data) {
            var order = data[0];
            var product = data[1];
            var details = data[2];
            var contact = data[3];
            $('#odnum').val(order.num);
            $('#odproduct').val(product.title);
            $('#oddetails').val(details.title);
            $('#odquantity').val(order.quantity);
            $('#odtotal').val(order.total);
            $('#odstatus').val(order.status);
            $('#odcontact').val(contact.address);
            // $('#user_id').val(order.user_id);
        });

        $('#orderModal').modal('show');
    });

    $('#odsave').click(function () {
        if($('#odsave').val() == 'add') {
            ourl = odurl;
            var method = "POST"; // add
        }
        else {
            durl = odurl + '/' + $('#odid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('num',$('#odnum').val());
        data.append('quantity',$('#odquantity').val());
        data.append('total',$('#odtotal').val());
        data.append('status',$('#odstatus').val());
        data.append('product',$('#odproduct').val());
        data.append('details',$('#oddetails').val());
        data.append('contact',$('#odcontact').val());
        // data.append('user_id',$('#user_id').val());
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
                $('#orderModal').modal('hide');
                var order = '<tr id="order' + data[0].id + '">' +
                    '<td>'+ escapeHtml(data[0].num) +'</td>' +
                    '<td><td>'+ escapeHtml(data[3].name) +'</td> <td>'+ escapeHtml(data[3].phone_num) +'</td><td>'+ escapeHtml(data[3].address) +'</td></td>' +
                    '<td>'+ escapeHtml(data[1].title) +'</td>' +
                    '<td>'+ escapeHtml(data[2].title) + '|' + escapeHtml(data[2].price) +'</td>' +
                    '<td>'+ escapeHtml(data[0].quantity) +'</td>' +
                    '<td>'+ escapeHtml(data[0].total) +'</td>' +
                    '<td>'+ escapeHtml(data[0].status) +'</td>' +
                    '<td><button class="btn btn-info odedit" value="'+ data[0].id +'">编辑</button> <button class="btn btn-danger oddelete" value="'+ data[0].id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(order);
                if(method == 'POST') {
                    $('#order-list').append(order);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#order'+data.id).replaceWith(order);
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