<div class="modal fade" id="tambahFoto" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahFotoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Potensi Desa</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputFoto">Foto Potensi Desa</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" accept="image/*" name="foto" id="inputFoto">
                            <label class="custom-file-label" for="inputFoto">Pilih foto</label>
                        </div>
                    </div>
                    <img class="mt-2" id="img_preview" src="" width="100%" alt="">
                    @if ($errors->has('foto'))
                        <p class="text-start text-danger">{{ $errors->first('foto') }}</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-check"></i></button>
            </div>
        </div>
    </div>
</div>