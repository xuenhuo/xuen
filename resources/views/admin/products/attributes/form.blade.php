<div class="modal fade" id="attributeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="attribute-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="attribute" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="attitle" class="control-label">标题</label>
                        <input type="text" class="form-control" id="attitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="atis_multi" class="control-label">是否多选</label>
                        <input type="checkbox" id="atis_multi" name="is_multi" value="1">
                    </div>
                    <div class="form-group">
                        <label for="dtposition" class="control-label">排序</label>
                        <input type="text" class="form-control" id="atposition" name="position">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="atsave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="atid" name="atid" value="-1">
            </div>
        </div>
    </div>
</div>