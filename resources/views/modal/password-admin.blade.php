<div class="modal fade" id="passwordAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="passwordAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Ubah Password Admin', auth()->user()->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukan password lama" autocomplete="off" required>
                        <label>Password Lama</label>
                        @error('password')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Password lama wajib diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Masukan password baru" autocomplete="off" required>
                        <label>Password Baru</label>
                        @error('new_password')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Password baru wajib diisi
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" placeholder="Masukan konfirmasi password baru" autocomplete="off" required>
                        <label>Konfirmasi Password Baru</label>
                        @error('new_password_confirmation')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @else
                            <div class="invalid-feedback">
                                Konfirmasi password wajib diisi
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    @if ($errors->has('password') || $errors->has('new_password'))
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#passwordAdmin').modal('show');
            });
        </script>
    @endif
@endpush