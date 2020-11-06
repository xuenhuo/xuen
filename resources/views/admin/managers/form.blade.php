<div class="modal fade" id="managerModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="manager-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="manager" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="maname" class="control-label">名称</label>
                        <input type="text" class="form-control" id="maname" name="name">
                    <div class="form-group">
                        <label for="maemail" class="control-label">邮箱</label>
                        <input type="email" class="form-control" id="maemail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="mapassword" class="control-label">密码</label>
                        <input type="password" class="form-control" id="mapassword" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="masave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="maid" name="maid" value="-1">
            </div>
        </div>
    </div>
</div>