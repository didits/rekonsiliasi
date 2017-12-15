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
            <div class="modal-body">
                <form id="valPass">
                    <input type="hidden" id="id_">
                    <div class="form-group">
                        <label for="old-pass" class="control-label">Password Lama <star>*</star></label>
                        <input type="password" class="form-control" id="old-pass" required="true">
                    </div>
                    <div class="form-group">
                        <label for="new-pass" class="control-label">Password Baru <star>*</star></label>
                        <input type="password" class="form-control" id="new-pass" required="true" equalTo="#old-pass">
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Ganti Password</button>
            </div>
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
            <div class="modal-body">
                <form>
                    <input type="hidden" id="id_">
                    <div class="form-group">
                        <div class="idOrg">
                            <label for="idOrg" class="control-label">ID Organisasi <star>*</star></label>
                            <input type="number" class="form-control" id="idOrg" name="idOrg" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="namaOrg">
                            <label for="namaOrg" class="control-label">Nama Organisasi <star>*</star></label>
                            <input type="text" class="form-control" id="namaOrg" name="namaOrg" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="tipeOrg">
                            <label for="tipeOrg" class="control-label">Tipe Organisasi <star>*</star></label>
                            <select class="form-control" id="tipeOrg" name="tipeOrg" required="true">
                                <option value="2">Area</option>
                                <option value="3">Rayon</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="alamatOrg">
                            <label for="alamatOrg" class="control-label">Alamat Organisasi <star>*</star></label>
                            <input type="text" class="form-control" id="alamatOrg" name="alamatOrg" required="true">
                        </div>
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Edit Organisasi</button>
            </div>
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