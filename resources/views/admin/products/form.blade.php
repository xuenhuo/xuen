<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="product-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="product" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="prcategories" class="control-label">分类</label>
                        <input type="text" class="form-control" id="prcategories" name="categories">
                    </div>
                    <div class="form-group">
                        <label for="prtitle" class="control-label">标题</label>
                        <input type="text" class="form-control col-md-4" id="prtitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="prsubtitle" class="control-label">副标题</label>
                        <input type="text" class="form-control col-md-4" id="prsubtitle" name="subtitle">
                    </div>
                    <div class="form-group">
                        <label for="prprice" class="control-label">价格</label>
                        <input type="text" class="form-control col-md-4" id="prprice" name="price">
                    </div>
                    <div class="form-group">
                        <label for="prsale" class="control-label">折扣价格</label>
                        <input type="text" class="form-control col-md-4" id="prsale" name="sale">
                    </div>
                    <div class="form-group">
                        <label for="prdescription" class="control-label">描述</label>
                        <input type="text" class="form-control" id="prdescription" name="description">
                    </div>
                    <div class="form-group">
                        <label for="pradditional_information" class="control-label">附加信息</label>
                        <input type="text" class="form-control" id="pradditional_information" name="additional_information">
                    </div>
                    <div class="form-group">
                        <label for="prfeatured" class="control-label">是否精选</label>
                        <input type="checkbox" id="prfeatured" name="featured" value="1">
                    </div>
                    <div class="form-group">
                        <label for="prposition" class="control-label">排序</label>
                        <input type="text" class="form-control col-md-4" id="prposition" name="position">
                    </div>
                    <div class="form-group">
                        <label for="prphoto" class="control-label">图片</label>
                        <input type="file" class="form-control col-md-4" id="prphoto" name="photo">
                        <img id="viewPrphoto" style="display:none; width:100px;height:100px">
                    </div>
                    <div class="form-group">
                        <label for="prattributes" class="control-label">款式</label>
                        <input type="text" class="form-control" id="prattributes" name="attributes">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="prsave" value="update" class="btn btn-primary">提交</button>
                <input type="hidden" id="prid" name="prid" value="-1">
            </div>
        </div>
    </div>
</div>