<div class="form-group row">
    <div class="col-6">
        <label for="">Item Name *</label>
        <input type="text" required class="form-control" name="name" placeholder="Enter item name" value="{{ old('name',$item->name??'') }}">
    </div>
    <div class="col-6">
        <label for="">Available Amount *</label>
        <input type="number" required class="form-control" name="available_amount" placeholder="Enter available amount" value="{{ old('available_amount',$item->available_amount??'') }}">
    </div>
    <div class="col-6">
        <label for="">Price Per *</label>
        <input type="number" required class="form-control" name="price_per" name="price_per" placeholder="Enter price per" value="{{ old('price_per',$item->price_per??'') }}">
    </div>
    <div class="col-6">
        <label for="">Add Photo </label> <br>
        <input type="file" name="image" class="form-control">
    </div>
</div>