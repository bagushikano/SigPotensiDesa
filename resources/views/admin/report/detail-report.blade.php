@extends('layouts/admin/admin-layout')

@push('css')
  <link rel="stylesheet" href="{{ asset('admin-template/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Laporan Potensi Desa</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard Admin') }}">Laporan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Potensi Desa</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
      <div class="row">
          <div class="col-12 p-0">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-6 my-auto">
                    <p class="my-auto">Grafik Jumlah Potensi Desa {{ $potensiDesa->desa->nama }}</p>
                  </div>
                  <div class="col-6 text-end my-auto">
                    <button class="btn btn-success my-auto" data-bs-toggle="modal" data-bs-target="#grafik-kunjungan">
                      <i class="far fa-chart-bar"></i>
                      <span class="border-end mx-2"></span>
                      Kunjungan
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-body">
                  <canvas id="myChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('modal/grafik-kunjungan')
@endsection

@push('js')
    <script src="{{ asset('admin-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#admin-report').addClass('menu-open');
            $('#report').addClass('active');

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
              theme: 'bootstrap4'
            })

            const labels = [
              'Pasar',
              'Pusat Pemeritahan',
              'Sekolah',
              'Tempat Ibadah',
            ];
            const data = {
              labels: labels,
              datasets: [{
                label: 'Jumlah Potensi Desa',
                data: {!!json_encode($jumlahPotensiDesa)!!},
                // data: [87, 5, 110,125],
                backgroundColor: [
                  'rgba(54, 162, 235)'
                ],
              }]
            };

            const config = {
              type: 'bar',
              data: data,
              options: {
                scales: {
                    yAxes: [{
                      ticks: {
                        stepSize: 1
                      }
                    }]
                }
              }
            };

            var myChart = new Chart(
              document.getElementById('myChart'),
              config
            );
        });
    </script>
@endpush
