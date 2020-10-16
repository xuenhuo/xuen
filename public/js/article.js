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

    tinymce.init({
        selector: '#arcontent',
        language:'zh_CN',
        statusbar: false,
    });

    arurl = '/admin/articles';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#article input[name="_token"]').val()
        }
    });

    $('#aradd').click(function () {
        $('#article').trigger('reset');
        $('#arcontent').val('');
        $('#article-title').text('添加文章');
        $('#arsave').val('add');
        $("#viewArphoto").css("display", "none");
        $('#articleModal').modal('show');
    });

    $('#article-list').on('click', 'button.ardelete', function() {
        var arid = $(this).val();
        $.ajax({
            type: 'DELETE',
            url: arurl+'/'+arid,
            success: function (data) {
                console.log(data);
                $('#article'+arid).remove();
            },
        });
    });

    $('#article-list').on('click', 'button.aredit', function() {
        $('#article').trigger('reset');
        $('#article-title').text('编辑文章');
        $('#arsave').val('update');
        var arid = $(this).val();
        $('#arid').val(arid);
        $.get(arurl+'/'+arid, function (data) {
            var article = data[0];
            var tags = data[1];
            $('#tags').val(tags);
            $('#artitle').val(article.title);
            $('#arauthor').val(article.author);
            $('#arcontent').val(article.content);
            tinyMCE.get('arcontent').setContent(article.content);
            $("#viewArphoto").attr("src", "/storage/articles/"+ article.photo);
            $("#viewArphoto").css("display", "block");
        });

        $('#articleModal').modal('show');
    });

    //获取评论
    $('#article-list').on('click', '.comment_btn', function() {
        var cmurl = $(this).data('url');
        $('#commentView').load(cmurl, function(){
            $('#comment-title').text('评论列表');
            $('#commentModal').modal('show');
        });
    });
    //删除评论
    $('#commentView').on('click', 'button.cmdelete', function() {
        var cmid = $(this).val();
        var cmurl = $(this).data('url');
        $.ajax({
            type: 'DELETE',
            url: cmurl,
            success: function (data) {
                console.log(data);
                $('#comment'+cmid).remove();
            },
        });
    });

    $('#arsave').click(function () {
        if($('#arsave').val() == 'add') {
            aurl = arurl;
            var method = "POST"; // add
        }
        else {
            aurl = arurl + '/' + $('#arid').val();
            var method = "PATCH"; // edit
        }

        var data = new FormData();
        data.append('photo', $('#arphoto')[0].files[0]);
        data.append('title',$('#artitle').val());
        data.append('author',$('#arauthor').val());
        tinyMCE.triggerSave();
        data.append('content',$('#arcontent').val());
        data.append('tags',$('#tags').val());
        data.append('_method', method);
        

        console.log('save url:'+aurl);
        console.log(data);

        $.ajax({
            type: 'POST',
            url: aurl,
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#articleModal').modal('hide');
                var article = '<tr id="article' + data[0].id + '">' +
                    '<td>'+ escapeHtml(data[0].title) +'</td>' +
                    '<td>'+ escapeHtml(data[0].author) +'</td>' +
                    '<td><img src="/storage/articles/'+ data[0].photo + '" style="width:100px;height:100px"/></td>' +
                    '<td>'+ escapeHtml(data[0].content) +'</td>' +
                    '<td><button class="btn btn-info comment_btn" data-url="'+arurl+'/'+data[0].id+'/comments">获取评论</button> <a class="btn btn-info commentlist_btn" href="'+arurl+'/'+data[0].id+'/commentlists">获取评论</a>'+ '</td>' +
                    '<td><button class="btn btn-info aredit" value="'+ data[0].id +'">编辑</button> <button class="btn btn-danger ardelete" value="'+ data[0].id +'">删除</button>'+ '</td>' +
                    '<tr>';
                console.log(article);
                if(method == 'POST') {
                    $('#article-list').append(article);
                    // toastr.success('添加成功！');
                }
                else { // edit
                    $('#article'+data.id).replaceWith(article);
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