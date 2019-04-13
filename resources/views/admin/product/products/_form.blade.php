<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Category</label>
            <select name="category" id="" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}">
                <option value="">Choose Category</option>
                @if ($categories->count())
                    @foreach ($categories as $category)
                        <option {{ $product->product_category_id == $category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
            @if ($errors->has('category'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('category') }}</strong></span> 
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter a product name" value="{{ $product->name??old('name') }}">
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span> 
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30" rows="10">
                {{ $product->description??old('description') }}
            </textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('description') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            <label for="">Status:
                <input value="1" type="checkbox" name="status" id=""  {{ (isset($product) && $product->status) ? 'checked': '' }}> Active
            </label>
        </div>
    </div>
</div>
<div class="form-group float-right">
    <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ $buttonValue }}">
</div>