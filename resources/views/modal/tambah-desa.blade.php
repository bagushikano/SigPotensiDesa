<div class="modal fade" id="tambahDesa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahDesaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Desa Baru</h5>
                <button onclick="resetForm()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Tambah Desa') }}" id="formTambahDesa" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama_desa') is-invalid @enderror" id="nama_desa" name="nama_desa" placeholder="Masukan nama desa" value="{{ old('nama_desa') }}" autocomplete="off" required>
                        <label for="nama_desa">Nama Desa</label>
                        @error('nama_desa')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Nama desa wajib diisi
                            </div>
                        @enderror
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="reset" onclick="resetForm()" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>