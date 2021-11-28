<div class="row">
    <div class="col-xl-2"></div>
    <div class="col-xl-7 my-2">
        <div class="form-group row">
            <label class="col-form-label col-3 text-lg-right text-left">
                Tên
            </label>
            <div class="col-9">
                <input class="form-control form-control-lg form-control-solid"
                       type="text" name="name"
                       value="{{ old('name',$province->name) }}">
                @error('name')
                <div class="fv-plugins-message-container">
                    <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>
        </div>
    </div>
</div>
