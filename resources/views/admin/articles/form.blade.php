<div class="modal fade" id="articleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="article-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="article" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="tags" class="control-label">标签</label>
                        <input type="text" class="form-control" id="tags" name="tags">
                    </div>
                    <div class="form-group">
                        <label for="artitle" class="control-label">标题</label>
                        <input type="text" class="form-control col-md-4" id="artitle" name="title">
                    <div class="form-group">
                        <label for="arauthor" class="control-label">作者</label>
                        <input type="text" class="form-control col-md-4" id="arauthor" name="author">
                    </div>
                    <div class="form-group">
                        <label for="arphoto" class="control-label">图片</label>
                        <input type="file" class="form-control col-md-4" id="arphoto" name="photo">
                        <img id="viewArphoto" style="display:none; width:100px;height:100px">
                    </div>
                    <div class="form-group">
                        <div class="textcont">
                            <label for="arcontent" class="control-label">内容</label>
                            <textarea class="form-control" id="arcontent" rows="3" name="content"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="arsave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="arid" name="arid" value="-1">
            </div>
        </div>
    </div>
</div>