<form action="{{route('orders.store')}}" method="post">
    <input type="text" name="num" value="qwertyuiopasdfgh">
    <input type="text" name="status" value="未付款">
    <input type="text" name="num-product">
    <input type="text" name="price">
    <input type="text" name="remark">
    <input type="text" name="contact_id">
    <input type="text" name="name">
    <input type="text" name="phone">
    <input type="text" name="address">
    <input type="text" name="product_id">
    <input type="text" name="title">
    <input type="text" name="attribute_id">
    <input type="text" name="attribute_detail_id">
    <input type="text" name="at_title">
    <input type="text" name="at_detail_title">
    <input type="text" name="at_detail_price">
    @csrf
    @method('POST')
    <input type="submit" value="submit">
</form>