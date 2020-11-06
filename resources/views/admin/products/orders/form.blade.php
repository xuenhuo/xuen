<div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="order-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="order" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="odnum" class="control-label">编号</label>
                        <input type="text" class="form-control col-md-4" id="odnum" name="num" disabled>
                    </div>
                    <div class="form-group">
                        <label for="odproduct" class="control-label">产品</label>
                        <input type="text" class="form-control col-md-4" id="odproduct" name="product" disabled>
                    </div>
                    <div class="form-group">
                        <label for="oddetails" class="control-label">产品情况</label>
                        <input type="text" class="form-control col-md-4" id="oddetails" name="details" disabled>
                    </div>
                    <div class="form-group">
                        <label for="odquantity" class="control-label">数量</label>
                        <input type="text" class="form-control col-md-4" id="odquantity" name="quantity" disabled>
                    </div>
                    <div class="form-group">
                        <label for="odtotal" class="control-label">总价</label>
                        <input type="text" class="form-control col-md-4" id="odtotal" name="total" disabled>
                    </div>
                    <div class="form-group">
                        <label for="odstatus" class="control-label">订单状态</label>
                        <input type="text" class="form-control col-md-4" id="odstatus" name="status">
                    </div>
                    <div class="form-group">
                        <label for="odcontact" class="control-label">联系方式</label>
                        <input type="text" class="form-control" id="odcontact" name="contact">
                    </div>
                    <input type="hidden" id="user_id" name="user_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="odsave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="odid" name="odid" value="-1">
            </div>
        </div>
    </div>
</div>