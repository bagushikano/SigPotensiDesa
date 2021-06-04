<div class="modal fade" id="tambahAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Admin</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Tambah Admin') }}" method="POST" class="needs-validation" novalidate id="formRegisterAdmin">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" name="nama_admin" id="nama_admin" value="{{ old('nama_admin') }}" placeholder="Masukan nama admin" autocomplete="off" required>
                        <label>Nama Admin</label>
                        @error('nama')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Nama admin wajib diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('username_admin') is-invalid @enderror" name="username_admin" id="username_admin" value="{{ old('username_admin') }}" placeholder="Masukan username admin" autocomplete="off" required>
                        <label>Username</label>
                        @error('username_admin')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Username wajib diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('no_telp_admin') is-invalid @enderror" name="no_telp_admin" id="nomor_telepon_admin" value="{{ old('no_telp_admin') }}" placeholder="Masukan nomor telepon admin" autocomplete="off" required>
                        <label>Nomor Telepon</label>
                        @error('no_telp_admin')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Nomor telepon wajib diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control @error('alamat_admin') is-invalid @enderror" name="alamat_admin" id="alamat_admin" placeholder="Masukan alamat admin" style="height: 100px" required>{{ old('alamat_admin') }}</textarea>
                        <label>Alamat</label>
                        @error('alamat_admin')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Alamat wajib diisi
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" type="reset" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        <span class="border-end mx-2"></span>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        <span class="border-end mx-2"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    @if ($errors->has('nama_admin') || $errors->has('username_admin') || $errors->has('nomor_telepon_admin') || $errors->has('alamat_admin'))
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#tambahAdmin').modal('show');
            });
        </script>
    @endif
@endpush