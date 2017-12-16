
{{--Edit Pass--}}
<div class="modal fade" id="editPassModal" tabindex="-1" role="dialog" aria-labelledby="editPassLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPassLabel">Edit Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{url('admin/change_pass')}}" enctype="multipart/form-data"  id="editPass">
                {{csrf_field()}}
                <div class="modal-body">
                    <input name="id" type="hidden" id="id_">
                    <div class="form-group">
                        <label for="old-pass" class="control-label">Password Lama <star>*</star></label>
                        <input name="old_pass" type="password" class="form-control" id="old-pass" minLength="4" required="true">
                    </div>
                    <div class="form-group">
                        <label for="new-pass" class="control-label">Password Baru <star>*</star></label>
                        <input name="new_pass" type="password" class="form-control" id="new-pass" minLength="4" required="true">
                    </div>
                    <div class="form-group">
                        <label for="new2-pass" class="control-label">Konfirmasi Password<star>*</star></label>
                        <input type="password" class="form-control" id="new2-pass" minLength="4" required="true" equalTo="#new-pass">
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{--Edit Org--}}
<div class="modal fade" id="editOrgModal" tabindex="-1" role="dialog" aria-labelledby="editOrgLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrgLabel">Edit Organisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editOrganisasi">
                <div class="modal-body">
                    <input type="hidden" id="id_">
                    <div class="form-group">
                        <label for="idOrg" class="control-label">ID Organisasi <star>*</star></label>
                        <input type="number" class="form-control" id="idOrg" name="idOrg" required="true">
                    </div>
                    <div class="form-group">
                        <label for="namaOrg" class="control-label">Nama Organisasi <star>*</star></label>
                        <input type="text" class="form-control" id="namaOrg" name="namaOrg" required="true">
                    </div>
                    <div class="form-group">
                        <label for="tipeOrg" class="control-label">Tipe Organisasi <star>*</star></label>
                        <select class="form-control" id="tipeOrg" name="tipeOrg" required="true">
                            <option value="2">Area</option>
                            <option value="3">Rayon</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamatOrg" class="control-label">Alamat Organisasi <star>*</star></label>
                        <input type="text" class="form-control" id="alamatOrg" name="alamatOrg" required="true">
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Edit Organisasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--Hapus Org--}}
<div class="modal fade" id="deleteOrgModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrgLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteOrgLabel">Hapus Organisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Hapus Organisasi</h4>
                <h3 id="toDelete"></h3>
                <form>
                    <input type="hidden" id="id_">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

{{--Add Org--}}
<div class="modal fade" id="addOrgModal" tabindex="-1" role="dialog" aria-labelledby="addOrgLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrgLabel">Tambah Organisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addOrganisasi">
                <div class="modal-body">
                    <input type="hidden" id="id_">
                    <div class="form-group">
                        <label for="tipeOrg" class="control-label">Tipe Organisasi <star>*</star></label>
                        <select class="form-control" id="tipeOrgAdd" name="tipeOrg" required="true">
                            <option value="0" disabled selected>Pilih Tipe</option>
                            <option value="2">Area</option>
                            <option value="3">Rayon</option>
                        </select>
                    </div>
                    <div {{--style="display: none"--}} id="toHide">
                        <div class="form-group">
                            <label for="selArea" class="control-label">Pilih Area <star>*</star></label>
                            <select class="form-control" id="selAreaAdd" name="selArea" required="true">
                                <option value="0" disabled selected>Pilih Area</option>
                                @foreach ($dropdown_area as $areas)

                                    <option value="{{ $areas->id_organisasi }}">{{ $areas->nama_organisasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaOrg" class="control-label">Nama Organisasi <star>*</star></label>
                        <input type="text" class="form-control" id="namaOrg" name="namaOrg" required="true">
                    </div>
                    <div class="form-group">
                        <label for="alamatOrg" class="control-label">Alamat Organisasi <star>*</star></label>
                        <input type="text" class="form-control" id="alamatOrg" name="alamatOrg" required="true">
                    </div>

                    <div class="form-group">
                        <label for="pass" class="control-label">Password <star>*</star></label>
                        <input type="password" class="form-control" id="pass" name="pass" minLength="4" required="true">
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Organisasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

