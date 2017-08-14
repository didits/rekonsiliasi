<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group bootstrap-select">
                <div class="btn-group bootstrap-select">
                    <select name="selectareasingle" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                        <option class="bs-title-option" value="">Area</option>
@foreach ($dropdown_area as $areas)
                        <option value="{{ $areas->id_organisasi }}">{{ $areas->nama_organisasi }}</option>
@endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="btn-group bootstrap-select">
                <div class="btn-group bootstrap-select">
                    <select name="selectrayonsingle" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                        <option class="bs-title-option" value="">Rayon</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>