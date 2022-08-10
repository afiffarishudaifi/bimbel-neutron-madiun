<div class="col-12">
    <div class="form-group">
        <label>{{ config('fileuploader.label') }}</label>
        <div id="fileuploader"></div>
        <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $var['image'] }}">
        <input type="hidden" name="rm_image" id="rm_image">
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <label>{{ config('fileuploader.label') }} saat ini</label>
        <br>
        @if (isset($var['image']))
            @php
                $file = explode(',', $var['image']);
            @endphp
            <div class="row">
                @foreach ($file as $k => $f)
                    <div class="col-4" id="col{{ $k }}">
                        <button type="button" class="close bg-danger" onclick="del_img(this)" id="{{ $k }}"
                            name="{{ $f }}" style="padding: 5px;"> x
                        </button>
                        <img class="img-fluid img-thumbnail" src="{{ url('storage/' . config('fileuploader.path')) }}">
                    </div>
                @endforeach
            </div>
        @else
            <small class="text-danger text-center">Belum Ada Gambar yang di
                upload</small>
        @endif

    </div>
</div>
