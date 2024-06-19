@extends('App')

@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header mt-2">
                <button class="btn btn-primary p-3">{{ $jBidang->nama_unit }}</button>
                {{-- <a href="{{ route('akun.create')}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Buat
                    User</a> --}}
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
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key )
                            @php
                            // $kegit = DB::table('galeri_kegiatan')
                            // ->selectRaw("GROUP_CONCAT(DISTINCT(users_id)) as users_id")
                            // ->where('users_id', '=', $key->id)->first();

                      
                        
                            @endphp
                            <tr>
                              
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->bulan }}</td>
                                {{-- <td>{{ $key->bulan }}</td> --}}
                                <td>
                                    @if($key->pekan_id == 1)
                                    <a href="{{ route('bidang.pekan',['users_id' => $key->users_id, 'pekan_id' => $key->pekan_id]) }}" class="btn btn-success">Pekan 1</a>
                                    @else
                                    <a href="#" class="btn btn-danger">Pekan 1</a>
                                    @endif
                                    @if($key->pekan_id == 2)
                                    <a href="{{ route('bidang.pekan',['users_id' => $key->users_id, 'pekan_id' => $key->pekan_id]) }}" class="btn btn-success">Pekan 2</a>
                                    @else
                                    <a href="#" class="btn btn-danger">Pekan 2</a>
                                    @endif
                                    @if($key->pekan_id == 3)
                                    <a href="{{ route('bidang.pekan',['users_id' => $key->users_id, 'pekan_id' => $key->pekan_id]) }}" class="btn btn-success">Pekan 3</a>
                                    @else
                                    <a href="#" class="btn btn-danger">Pekan 3</a>
                                    @endif
                                    @if($key->pekan_id == 4)
                                    <a href="{{ route('bidang.pekan',['users_id' => $key->users_id, 'pekan_id' => $key->pekan_id]) }}" class="btn btn-success">Pekan 4</a>
                                    @else
                                    <a href="#" class="btn btn-danger">Pekan 4</a>
                                    @endif                               
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
@endsection