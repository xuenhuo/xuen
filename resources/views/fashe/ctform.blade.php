<div class="modal fade" id="contactModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="contact-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="contact" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="ctname" class="control-label">名字</label>
                        <input type="text" class="form-control col-md-4" id="ctname" name="name">
                    </div>
                    <div class="form-group">
                        <label for="ctphone" class="control-label">联系号码</label>
                        <input type="text" class="form-control col-md-4" id="ctphone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="ctaddress" class="control-label">联系地址</label>
                        <input type="text" class="form-control col-md-8" id="ctaddress" name="address">
                    </div>
                    <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="ctsave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="ctid" name="ctid" value="-1">
            </div>
        </div>
    </div>
</div>