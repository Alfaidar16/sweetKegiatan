@extends('App')

@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            {{-- <div class="card-header mt-2">
                <a href="{{ route('bidang.create')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Bidang</a>
              
            </div> --}}
            <div class="card-body mt-5">
                <div class="table-responsive">
                    <table id="dataBidang" class="table custom-table">
                        <thead>
                            <tr style="font-size: 10px;">
                                <th>No</th>
                                <th>Unit Kerja</th>
                                <th>Nip</th>
                                <th>Kepala Bidang</th>
                                <th>Nama</th>
                                                         
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bidang as $key )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key->kode_bidang }}</td>
                                    <td>{{ $key->nip }}</td>
                                    <td>{{ $key->kepala_bidang }}</td>
                                    <td> {{ $key->nama_unit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      
                    </table>
                </div>
            </div>
        </div>
    </div>
       {{-- @include('Bidang.Edit') --}}
  
</div>
  
@endsection
@section('js')
<script> 
      $(document).ready(function() {
            load_data();

            function load_data(unit = '') {
                $('#dataBidang').DataTable({
                    "pageLength": 10,
                    "searching": true,
                    "processing": true,
                   
                 
                });
            }

        });

    //    function editBidang($id, $nama_unit, $kode_bidang) {
    //             $('#exampleModal').modal('show');
    //             $('#id').val($id);
    //             $('#namaUnit').val($nama_unit);
    //             $('#kodeBidang').val($kode_bidang);
            
    //    } 
</script>
{{-- <script>
    

       function hapusBidang(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghapus Data Bidang",
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
                url: "{{ route('bidang.destroy') }}",
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