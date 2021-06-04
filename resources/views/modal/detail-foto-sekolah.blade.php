<div class="modal fade" id="detailFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailFotoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Sekolah</h5>
                <button class="btn-close" id="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="d-flex justify-content-center" for="inputFoto">Foto Potensi Desa (Sekolah)</label>
                    @if ($sekolah->foto == NULL)
                        <p class="text-center">Foto belum ditambahkan</p>
                        <img class="mb-2" id="img_preview" src="" width="100%" alt="">
                    @else
                        <img class="mb-2" id="img_preview" src="{{ route('Image Sekolah', $sekolah->id) }}" width="100%" alt="">
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" accept="image/*" name="foto" id="inputFoto">
                            <label class="custom-file-label" for="inputFoto" id="labelFoto"></label>
                        </div>
                    </div>
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