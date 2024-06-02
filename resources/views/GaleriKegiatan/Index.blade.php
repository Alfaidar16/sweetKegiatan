@extends('App')

@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header mt-2">
                <a href="{{ route('kegiatan.create')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat laporan</a>
                <a href="" class="btn btn-success"><i class="bi bi-upload"></i> Cetak</a>
                {{-- <div class="card-title">Highlight Row Column</div> --}}
            </div>
            <div class="card-body mt-5">
                <div class="table-responsive">
                    <table id="Kegiatan" class="table custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dokumentasi</th>
                                <th>Dasar Kegiatan</th>
                                <th>Uraian Kegiatan</th>
                                <th>Opd</th>
                                <th>Url</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
     $(document).ready(function() {
            load_data();

            function load_data(unit = '') {
                $('#Kegiatan').DataTable({
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
                        url: "{{ route('kegiatan') }}",
                    },
                    "columns": [{
                            "data": "DT_RowIndex",
                            "orderable": false,
                            "searchable": false
                        },
                        {
                            "data": "image"
                        },
                        {
                            "data": "nama_kegiatan"
                        },
                        {
                            "data": "nama_opd"
                        },
                        {
                            "data": "uraian_kegiatan"
                        },
                        {
                            "data": "url"
                        },
                      
                        {
                            "data": "aksi",
                            "orderable": false,
                            "searchable": false
                        },
                    ],
                    "bAutoWidth": false,
                    "columnDefs": [{
                        targets: [0, 1, 2, 3, 4, 5, 6],
                        className: 'text-left'
                    }],
                    "bDestroy": true,
                });
            }

        });

</script>
@endsection