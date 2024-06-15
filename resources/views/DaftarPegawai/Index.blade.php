@extends('App')

@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header mt-2">
                 <button class="btn btn-primary p-2">{{ $jBidang->nama_unit }}</button>
                {{-- <a href="{{ route('akun.create')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat User</a> --}}
                {{-- <a href="" class="btn btn-success"><i class="bi bi-upload"></i> Cetak</a> --}}
                {{-- <div class="card-title">Highlight Row Column</div> --}}
            </div>
            <div class="card-body mt-5">
                <div class="table-responsive">
                    <table id="dataPegawai" class="table custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bulan</th>          
                                <th>Informasi</th>
                                {{-- <th>Aksi</th>                              --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key )
                               @php
                                   $kegit = DB::table('galeri_kegiatan')
                                   ->selectRaw("GROUP_CONCAT(DISTINCT(bulan)) as bulan")
                                   ->where('users_id', '=', $key->id)->first();
                                   $kepekan = DB::table('galeri_kegiatan')
                                   ->selectRaw("GROUP_CONCAT(DISTINCT(pekan_id)) as pekan_id")
                                   ->where('users_id', '=', $key->id)->first();
                               @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key->name }}</td>
                                    <td>{{ $kegit->bulan }}</td>
                                    {{-- <td>{{ $key->bulan }}</td> --}}
                                    <td> 
                                        @if($kepekan->pekan_id == null)

                                        <a href="#" class="btn btn-danger">Pekan 1</a>
                                        @else
                                        <a href="#" class="btn btn-success">Pekan 1</a>
                                        @endif
                                        <a href="#" class="btn btn-success">Pekan 2</a>
                                        <a href="#" class="btn btn-success">Pekan 3</a>
                                        <a href="#" class="btn btn-success">Pekan 4</a>
                                    </td>
                                    {{-- <td>
                                        <a href="#" class="btn btn-warning">Detail</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
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
                $('#dataPegawai').DataTable({
                    "pageLength": 10,
                    "searching": true,
                    "processing": true,
                   
                });
            }

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