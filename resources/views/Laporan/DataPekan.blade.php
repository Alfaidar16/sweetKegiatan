@extends('App')

@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row">

</div>
 <div class="container">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card p-3 pb-3">
                    <div class=" p-4 fw-bold" style="font-size: 30px;">Laporan Kegiatan Pemprov Sulsel</div>
                    {{-- <div class="d-flex mx-5">
                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Laporan Harian
                          </button>
                          <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#pekanModal">
                            Laporan Mingguan
                          </button>
                          <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#bulanModal">
                            Laporan Bulanan
                          </button>
                    </div> --}}
                  <div class="row">
                    <div class="d-flex mx-5 mt-3">
                      @foreach ($pekan as $key )
                      <a href="{{ route('filter.pekan', $key->id) }}" class="btn btn-primary mx-2">{{ $key->pekan }}</a>
                      @endforeach
                    </div>
                  </div>
                 <div class="ms-auto">
                    <img src="{{ asset('/TemplateDashboard/design/assets/images/vector.png')}}" alt="" width="200" style="margin-top: -90px;">
                 </div>   
                </div>
        </div>
    </div>
 </div>
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header mt-2">
            </div>
            <div class="card-body mt-5">
             
                <div class="table-responsive">
                    <table id="laporanPekan" class="table custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Dokumentasi</th>
                                <th>Dasar Kegiatan</th>
                                <th>Narasi Kegiatan</th>
                                <th>Pekan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datapekan as $key )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                 <td>{{ $key->nama_kegiatan }}</td>
                                 <td><img src="{{ asset('upload/kegiatan/', $key->image) }}" alt=""></td>
                                 <td>{{ $key->dasar_pelaksanaan }}</td>
                                 <td>{!! $key->narasi_kegiatan !!}</td>
                                 <td>{{ $key->pekan }}</td>
                                 <td>{{  $key->tanggal }}</td>
                                 <td> 
                                    <a href="">Cetak laporan</a>
                                    <a href="">Cetak laporan</a>
                                 </td>
                            </tr>
                            @endforeach
                        </tbody>
                     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Harian--}}
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="margin-top: 180px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('generate.pdf') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="m-0">
                        <div class="form-label">Dari Tanggal</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_awal" />
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <div class="m-0">
                        <div class="form-label">Sampai Tanggal</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_akhir"/>
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
       
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
    </form>
      </div>
    </div>
  </div> --}}

  {{-- Data Perpekan --}}
  {{-- <div class="modal fade" id="pekanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="margin-top: 180px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Perpekan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('generate.pekan') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="m-0">
                        <div class="form-label">Dari Pekan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_awal" />
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <div class="m-0">
                        <div class="form-label">Sampai Pekan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_akhir"/>
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
       
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
    </form>
      </div>
    </div>
  </div> --}}
  {{-- End Perpekan --}}

  {{-- Data Bulan --}}
  {{-- <div class="modal fade" id="bulanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="margin-top: 180px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Bulanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('generate.month') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="m-0">
                        <div class="form-label">Dari Bulan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_awal" />
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <div class="m-0">
                        <div class="form-label">Sampai Bulan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_akhir"/>
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
       
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
    </form>
      </div>
    </div>
  </div> --}}
  {{-- End Data Bulan --}}
@endsection

@section('js')
<script> 
     $(document).ready(function() {
            load_data();

            function load_data(unit = '') {
                $('#laporanPekan').DataTable({});
            }
        });

</script>

<script>
    $('.datepicker').daterangepicker({
	singleDatePicker: true,
  startDate: moment().startOf('hour'),
  endDate: moment().startOf('hour').add(32, 'hour'),
  locale: {
    format: 'DD-MM-YYYY',
    
  }
});

</script>
@endsection
