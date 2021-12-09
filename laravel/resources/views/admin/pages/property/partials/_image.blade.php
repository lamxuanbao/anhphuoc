<div class="form-group row">
    <label class="col-form-label col-3 text-lg-right text-left">
        Hình ảnh
    </label>
    <div class="col-9">
        <div>
            <ul class="list-images w-100">
                @foreach($property->images as $key => $image)
                    <li data-id="{{$key}}">
                        <img src="{{$image->url}}"><label
                            class="remove btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"> <i
                                class="fa fa-trash icon-sm text-muted"></i></label>
                    </li>
                @endforeach
                <li>
                    <div
                        style="cursor:pointer; position: relative; width: 100px; height: 100px; line-height: 30px; text-align: center;">
                        <div class="images-preview preview-favicon">
                            <img src="{{asset('images/default.png')}}">
                        </div>
                        <input id="images_property" type="file" multiple
                               style="opacity: 0.0; position: absolute; top:0; left: 0; bottom: 0; right:0; width: 100%; height:100%;"/>
                    </div>
                </li>
            </ul>
        </div>
        @error('images_data')
        <div class="fv-plugins-message-container">
            <div data-field="title" data-validator="notEmpty" class="fv-help-block">
                Vui lòng chọn hình ảnh
            </div>
        </div>
        @enderror
    </div>
</div>
<div id="messsage_image" class="fv-plugins-message-container">
    <div data-field="title" data-validator="notEmpty" class="fv-help-block">
    </div>
</div>
<div id="images_data" style="display: none">
    @foreach($property->images as $key => $image)
        <div data-id="{{$key}}"><textarea name="images_data[]">{{json_encode($image)}}</textarea></div>
    @endforeach
</div>
@push('styles')
    <style>
        .list-images {
            list-style: none;
            padding-left: 0px;
        }

        .list-images li {
            margin: 10px;
            float: left;
            position: relative;
        }

        .list-images li img {
            width: 100px;
            height: 100px;
        }

        .list-images li label {
            position: absolute;
            right: 5px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(function () {
            var i = {{count($property->images)}};
            var data = {!! json_encode(old('images_data',[])) !!};
            for (const element of data) {
                i++;
                $("#images_data").append('<div data-id="' + i + '"><textarea name="images_data[]">' + element + '</textarea></div>')
                var image = JSON.parse(element);
                $('.list-images').find(' > li:nth-last-child(1)').before('<li data-id="' + i + '"><img src="' + image.url + '" /><label class="remove btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"> <i class="fa fa-trash icon-sm text-muted"></i></label></li>');
            }
            $(document).on('click', '.list-images .remove', function (e) {
                var id = $(this).parent().attr('data-id');
                $(this).parent().remove();
                $('div[data-id="' + id + '"]').remove();
            });
            $('#images_property').on('change', function (e) {
                $('#messsage_image .fv-help-block').html('');
                var formData = new FormData();
                $.each($('#images_property')[0].files, function (i, file) {
                    formData.append('images[]', file);
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: `{{route('images.store')}}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        for (const element of response) {
                            i++;
                            $("#images_data").append('<div data-id="' + i + '"><textarea name="images_data[]">' + JSON.stringify(element) + '</textarea></div>')
                            $('.list-images').find(' > li:nth-last-child(1)').before('<li data-id="' + i + '"><img src="' + element.url + '" /><label class="remove btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"> <i class="fa fa-trash icon-sm text-muted"></i></label></li>');
                        }
                        $('#images_property').val('');
                    },
                    error: function (response) {
                        $('#messsage_image .fv-help-block').html(response.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endpush
