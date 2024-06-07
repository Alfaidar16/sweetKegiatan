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
             
               
                    <div class=" p-4 fw-bold" style="font-size: 30px;">Laporan Kegiatan OPD Pemprov Sulsel</div>
                    <div class="d-flex mx-5">
                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Laporan Harian
                          </button>
                          <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Laporan Mingguan
                          </button>
                          <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Laporan Bulanan
                          </button>

                          {{-- <a href="{{ route('generate.pdf') }}" class="btn btn-primary mx-2">Laporan Harian</a>
                          <a href="" class="btn btn-primary mx-2">Laporan Harian</a>
                          <a href="" class="btn btn-primary mx-2">Laporan Harian</a> --}}
                       
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
                {{-- <a href="{{ route('user.create')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat User</a> --}}
                {{-- <a href="" class="btn btn-success"><i class="bi bi-upload"></i> Cetak</a> --}}
                {{-- <div class="card-title">Highlight Row Column</div> --}}
            </div>
            {{-- <ul class="nav nav-tabs" id="customTab2" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                  aria-controls="oneA" aria-selected="true">Pekan 1</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab"
                  aria-controls="twoA" aria-selected="false">Pekan 2</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA" role="tab"
                  aria-controls="threeA" aria-selected="false">Pekan 3</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA" role="tab"
                  aria-controls="threeA" aria-selected="false">Pekan 4</a>
              </li>
            </ul> --}}
            <div class="card-body mt-5">
             
                <div class="table-responsive">
                    <table id="laporan" class="table custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama OPD</th>
                                <th>Dokumentasi</th>
                                <th>Dasar Kegiatan</th>
                                <th>Narasi Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Harian--}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  </div>
@endsection

@section('js')
<script> 
  

     $(document).ready(function() {
            load_data();

            function load_data(unit = '') {
                $('#laporan').DataTable({
                    "pageLength": 10,
                    "searching": true,
                    "processing": true,
                    "serverside": true,
                    "scrollX": true,
                    "language": {
                        "processing": 'Memuat...'
                    },
                    "serverSide": true,
                    "ajax": {
                        url: "{{ route('laporan.index') }}",
                    },
                    "columns": [{
                            "data": "DT_RowIndex",
                            "orderable": false,
                            "searchable": false
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "image"
                        },
                    
                        {
                            "data": "nama_kegiatan"
                        },
                     
                        {
                            "data": "narasi_kegiatan"
                        },
                       {
                        "data": "tanggal"
                       },
                       
                        {
                            "data": "aksi",
                            "orderable": false,
                            "searchable": false
                        },
                    ],
                    "bAutoWidth": false,
                    "columnDefs": [{
                        targets: [0, 1, 2, 3, 4, 5],
                        className: 'text-left'
                    }],
                    "bDestroy": true,
                });
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
