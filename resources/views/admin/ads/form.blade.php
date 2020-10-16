<div class="modal fade" id="adModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ad-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="ad" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="adtitle" class="control-label">标题</label>
                        <input type="text" class="form-control" id="adtitle" name="title">
                    <div class="form-group">
                        <label for="adsubtitle" class="control-label">副标题</label>
                        <input type="text" class="form-control" id="adsubtitle" name="subtitle">
                    </div>
                    <div class="form-group">
                        <label for="adphoto" class="control-label">图片</label>
                        <input type="file" class="form-control" id="adphoto" name="photo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="adsave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="adid" name="adid" value="-1">
            </div>
        </div>
    </div>
</div>