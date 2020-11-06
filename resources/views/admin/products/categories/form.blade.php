<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="category-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="category" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="cgtitle" class="control-label">标题</label>
                        <input type="text" class="form-control" id="cgtitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="cgposition" class="control-label">排序</label>
                        <input type="text" class="form-control" id="cgposition" name="position">
                    </div>
                    <div class="form-group">
                        <label for="cgphoto" class="control-label">图片</label>
                        <input type="file" class="form-control" id="cgphoto" name="photo">
                        <img id="viewCgphoto" style="display:none; width:100px;height:100px">
                    </div>
                    <div class="form-group">
                        <label for="cgdisabled" class="control-label">是否隐藏</label>
                        <input type="checkbox" id="cgdisabled" name="disabled" value="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="cgsave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="cgid" name="cgid" value="-1">
            </div>
        </div>
    </div>
</div>