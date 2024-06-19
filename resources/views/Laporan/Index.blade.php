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
                    <div class="d-flex mx-5">
                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Laporan Harian
                          </button>
                          {{-- <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#pekanModal">
                            Laporan Mingguan
                          </button> --}}
                          <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#bulanModal">
                            Laporan Bulanan
                          </button>

                        
                      
                    </div>
                  {{-- <div class="row">
                    <div class="d-flex mx-5 mt-3">
                      @foreach ($pekan as $key )
                      <a href="{{ route('filter.pekan', $key->id) }}" class="btn btn-primary mx-2">{{ $key->pekan }}</a>
                      @endforeach
                      
                    </div>
                  </div> --}}
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
                    <table id="laporan" class="table custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
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
    
@include('Layouts.modalPrint')
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
                            "data": "name"
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
