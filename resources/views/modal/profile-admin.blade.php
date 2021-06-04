<div class="modal fade" id="profileAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="profileAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Admin</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Update Profile Admin', auth()->user()->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ auth()->user()->nama }}" placeholder="Masukan nama admin" autocomplete="off" required>
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
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ auth()->user()->username }}" placeholder="Masukan username admin" autocomplete="off" required>
                        <label>Username</label>
                        @error('username')
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
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" name="nomor_telepon" value="{{ auth()->user()->nomor_telepon }}" placeholder="Masukan nomor telepon admin" autocomplete="off" required>
                        <label>Nomor Telepon</label>
                        @error('nomor_telepon')
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
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukan alamat admin" style="height: 100px" required>{{ auth()->user()->alamat }}</textarea>
                        <label>Alamat</label>
                        @error('alamat')
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
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
    @if ($errors->has('nama') || $errors->has('username') || $errors->has('nomor_telepon') || $errors->has('alamat'))
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#profileAdmin').modal('show');
            });
        </script>
    @endif
@endpush