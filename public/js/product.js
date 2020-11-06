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

    prurl = '/admin/products';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#product input[name="_token"]').val()
        }
    });

    $('#pradd').click(function () {
        $('#product').trigger('reset');
        $('#product-title').text('添加文章');
        $('#prsave').val('add');
        $("#viewPrphoto").css("display", "none");
        $('#productModal').modal('show');
    });

    $('#product-list').on('click', 'button.prdelete', function() {
        var prid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: prurl+'/'+prid,
            success: function (data) {
                console.log(data);
                $('#product'+prid).remove();
            },
        });
    });

    $('#product-list').on('click', 'button.predit', function() {
        $('#product').trigger('reset');
        $('#product-title').text('编辑产品');
        $('#prsave').val('update');
        var prid = $(this).val();
        $('#prid').val(prid);
        console.log(prurl+'/'+prid);
        $.get(prurl+'/'+prid, function (data) {
            var product = data[0];
            var categories = data[1];
            var attributes = data[2];
            $('#prcategories').val(categories);
            $('#prattributes').val(attributes);
            $('#prtitle').val(product.title);
            $('#prsubtitle').val(product.subtitle);
            $('#prprice').val(product.price);
            $('#prsale').val(product.sale);
            $('#prdescription').val(product.description);
            $('#pradditional_information').val(product.additional_information);
            $('#prfeatured').prop("checked", product.featured);
            $('#prposition').val(product.position);
            $("#viewPrphoto").attr("src", "/storage/products/"+ product.photo);
            $("#viewPrphoto").css("display", "block");
        });

        $('#productModal').modal('show');
    });

    $('#prsave').click(function () {
        if($('#prsave').val() == 'add') {
            purl = prurl;
            var method = "POST"; // add
        }
        else {
            purl = prurl + '/' + $('#prid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('photo', $('#prphoto')[0].files[0]);
        data.append('title',$('#prtitle').val());
        data.append('subtitle',$('#prsubtitle').val());
        data.append('price',$('#prprice').val());
        data.append('sale',$('#prsale').val());
        data.append('description',$('#prdescription').val());
        data.append('additional_information',$('#pradditional_information').val());
        data.append('featured',$('#prfeatured').prop('checked') ? 1 : 0);
        data.append('position',$('#prposition').val());
        data.append('categories',$('#prcategories').val());
        data.append('attributes',$('#prattributes').val());
        data.append('_method', method);
        

        console.log('save url:'+purl);
        console.log(data);

        $.ajax({
            type: 'POST',
            url: purl,
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#productModal').modal('hide');
                var product = '<tr id="product' + data[0].id + '">' +
                    '<td>'+ escapeHtml(data[0].title) +'</td>' +
                    '<td>'+ escapeHtml(data[0].subtitle) +'</td>' +
                    '<td>'+ escapeHtml(data[0].price) +'</td>' +
                    '<td>'+ escapeHtml(data[0].sale) +'</td>' +
                    '<td>'+ escapeHtml(data[0].featured) +'</td>' +
                    '<td><img src="/storage/products/'+ data[0].photo + '" style="width:100px;height:100px"/></td>' +
                    '<td><a class="btn btn-info" href="'+prurl+'/'+data[0].id+'/reviews">获取回复</a> <button class="btn btn-info predit" value="'+ data[0].id +'">编辑</button> <button class="btn btn-danger prdelete" value="'+ data[0].id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(product);
                if(method == 'POST') {
                    $('#product-list').append(product);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#product'+data.id).replaceWith(product);
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