<div class="modal fade" id="grafik-kunjungan" tabindex="-1" aria-labelledby="grafik-kunjungan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="grafik-kunjungan">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('Jumlah Kunjungan', $potensiDesa->id_desa) }}" method="GET">
          <div class="row">
            <div class="col-7 d-flex justify-content-start">
              <select class="form-select" name="rentang_waktu" aria-label="Default select example">
                <option selected value="Hari Ini">Hari Ini</option>
                <option value="Kemarin">Kemarin</option>
                <option value="Bulan Ini">Bulan Ini</option>
                <option value="Bulan Lalu">Bulan Lalu</option>
                <option value="Tahun Ini">Tahun Ini</option>
                <option value="Tahun Lalu">Tahun Lalu</option>
              </select>
              @error('rentang_waktu')
                <div class="invalid-feedback text-start">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-5 text-end">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-eye"></i>
                <span class="border-end mx-2"></span>
                Tampilkan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>