<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="detail-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="detail" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="dttitle" class="control-label">标题</label>
                        <input type="text" class="form-control" id="dttitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="dtprice" class="control-label">价格</label>
                        <input type="text" class="form-control" id="dtprice" name="price">
                    </div>
                    <div class="form-group">
                        <label for="dtposition" class="control-label">排序</label>
                        <input type="text" class="form-control" id="dtposition" name="position">
                    </div>
                    <input type="hidden" id="attribute_id" name="attribute_id" value="{{$atid}}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="dtsave" value="update" class="btn btn-primary" data-url="/{{$atid}}/attribute_details">提交</button>
                <input type="hidden" id="dtid" name="dtid" value="-1">
            </div>
        </div>
    </div>
</div>