<div class="form-group row">
    <label class="col-form-label col-3 text-lg-right text-left">
        Tiêu đề
    </label>
    <div class="col-9">
        <input class="form-control form-control-lg form-control-solid"
               type="text" name="title" value="{{ old('title',$property->title) }}">
        @error('title')
        <div class="fv-plugins-message-container">
            <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                {{ $message }}
            </div>
        </div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-3 text-lg-right text-left">
        Keyword
    </label>
    <div class="col-9">
        <input class="form-control form-control-lg form-control-solid"
               type="text" name="keyword"
               value="{{ old('keyword',$property->keyword) }}">
        @error('keyword')
        <div class="fv-plugins-message-container">
            <div data-field="keyword" data-validator="notEmpty"
                 class="fv-help-block">
                {{ $message }}
            </div>
        </div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-3 text-lg-right text-left">
        Description
    </label>
    <div class="col-9">
                                            <textarea class="form-control form-control-lg form-control-solid"
                                                      cols="30" rows="3"
                                                      name="description"
                                            >{{ old('description',$property->description) }}</textarea>
        @error('description')
        <div class="fv-plugins-message-container">
            <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                {{ $message }}
            </div>
        </div>
        @enderror
    </div>
</div>
