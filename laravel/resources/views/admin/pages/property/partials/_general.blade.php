<div class="form-group row">
    <label class="col-form-label col-3 text-lg-right text-left">
        Địa chỉ
    </label>
    <div class="col-9">
        <input class="form-control form-control-lg form-control-solid"
               type="text" name="address"
               value="{{ old('address',$property->address) }}">
        @error('address')
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
        Tỉnh/Thành phố
    </label>
    <div class="col-9">
        <select class="form-control" name="province_id" value="{{ old('province_id',$property->province_id) }}">
            @php
                $province = \App\Models\Province::all();
            @endphp
            @foreach($province as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        @error('province_id')
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
        Diện tích
    </label>
    <div class="col-9">
        <input class="form-control form-control-lg form-control-solid"
               type="text" name="area"
               value="{{ old('area',($property->area) ? floatval($property->area) : null) }}">
        @error('area')
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
        Giá
    </label>
    <div class="col-9">
        <input class="form-control form-control-lg form-control-solid"
               type="text" name="price"
               value="{{ old('price', ($property->price) ? floatval($property->price) : null) }}">
        @error('price')
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
        Loại
    </label>
    <div class="col-9">
        <select class="form-control" name="type" value="{{ old('type',$property->type) }}">
            <option value="buy">Bán</option>
            <option value="rent">Cho thuê</option>
        </select>
        @error('type')
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
        Nội dung
    </label>
    <div class="col-9">
        <textarea class="wysiwyg" name="content">{{ old('content',$property->content) }}</textarea>
        @error('content')
        <div class="fv-plugins-message-container">
            <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                {{ $message }}
            </div>
        </div>
        @enderror
    </div>
</div>
@isset($property->id)
    <div class="form-group row">
        <label class="col-form-label col-3 text-lg-right text-left">
            Trạng thái
        </label>
        <div class="col-9">
            @if($property->is_active)
                <input class="form-control form-control-lg form-control-solid"
                       type="text" disabled
                       value="Đã duyệt">
            @else
                <input class="form-control form-control-lg form-control-solid"
                       type="text" disabled
                       value="Đang chờ">
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-3 text-lg-right text-left">
            Ngày hết hạn
        </label>
        <div class="col-9">
            <input class="form-control form-control-lg form-control-solid"
                   type="text" disabled
                   value="{{($property->end_date != null) ? $property->end_date->format('d/m/Y') : ''}}">
        </div>
    </div>
@endisset
