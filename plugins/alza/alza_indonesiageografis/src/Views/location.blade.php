<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="provinces">Provinsi</label>
                <select id="provinces" class="form-control" name="prov_id">
                    <option value="">-- select --</option>
                    @foreach ($provinces as $prov)
                        @if (!empty($var))
                            <option value="{{ $prov->prov_id }}" {!! $var['prov_id'] == $prov->prov_id ? 'selected' : '' !!}> {{ $prov->prov_name }}
                            </option>
                        @else
                            <option value="{{ $prov->prov_id }}"> {{ $prov->prov_name }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="cities">Kabupaten / Kota</label>
                <select id="cities" class="form-control" name="city_id">
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="district">Kecamatan</label>
                <select id="district" class="form-control" name="dis_id">
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="subdistrict">Desa</label>
                <select id="subdistrict" class="form-control" name="subdis_id">
                </select>
            </div>
        </div>
    </div>
</div>
