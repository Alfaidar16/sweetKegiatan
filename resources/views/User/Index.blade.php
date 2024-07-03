@extends('App')

@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header  mx-2 mt-2 d-flex">
                <a href="{{ route('akun.create')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat User</a>
                {{-- <a href="" class="btn btn-success"><i class="bi bi-upload"></i> Cetak</a> --}}
                {{-- <div class="card-title">Highlight Row Column</div> --}}
               <div class="col-lg-4 ms-auto">
                <select class="form-select" aria-label="Default select example" id="tampil">
                    <option value=""><a href="{{ route('akun.index') }}"></a>Semua</option>
                    @foreach ($bidang as $key )
                    <option value="{{ $key->kode_bidang }}" >{{ $key->nama_unit }}</option>
                    @endforeach
                  </select>
               </div>
             
            </div>
            
            <div class="card-body mt-5">
                <div class="table-responsive">
                    <table id="dataUser" class="table custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bidang</th>
                                <th>Nip</th>          
                                <th>Email</th>
                                <th>Nama</th>
                                {{-- <th>Roles</th> --}}
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

  
</script>
<script> 
      $(document).ready(function() {
            load_data();

            function load_data(unit = '') {
                $('#dataUser').DataTable({
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
                        url: "{{ route('akun.index') }}?unit="+unit,
                    },
                    "columns": [{
                            "data": "DT_RowIndex",
                            "orderable": false,
                            "searchable": false
                        },
                        {
                            "data": "nama_unit"
                        },
                        {
                            "data": "nip"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "name"
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
            $('#tampil').change( function () {
            var id = $(this).val();
            load_data(id)
            console.log(id)
        })
        });
</script>
{{-- <script>
    

       function hapusUser(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghapus Data User",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya'
            }).then((result) => {
                if (result.isConfirmed) {
                    hapus(id);
                }
            })
        }

        function hapus(id) {
            var _token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('user.destroy') }}",
                method: "POST",
                data: {
                    _token: _token,
                    id: id
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Mohon Tunggu',
                        icon: 'warning',
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                },
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        title: 'Success',
                        text: data.message,
                        icon: 'success',
                    });
                    setTimeout(() => {
                        location.reload()
                    }, 1000);
                },
                error: function() {}
            })
        }


</script> --}}
@endsection