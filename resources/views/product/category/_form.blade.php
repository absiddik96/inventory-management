<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter a category name" value="{{ $category->name??old('name') }}">
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span> 
    @endif
</div>
<div class="form-group float-right">
    <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ $buttonValue }}">
</div>