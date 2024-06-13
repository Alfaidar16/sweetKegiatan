@extends('App')
@section('judul')
{{ $title}}
@endsection

@section('content')
 <div class="container">
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="col-lg-12">
            <form action="{{ route('bidang.update', $bidang->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="cart-title mb-2" style="font-size: 20px; color:#e2e8f0; font-weight:900; margin-top: -8px;"">FORM BIDANG</div>
                </div>
                <div class="card-body">
                       <div class="col-md-12">
                        <div class="m-0 mb-3">
                            <label class="form-label">Nama Bidang</label>
                            <input type="text" class="form-control p-2 pb-3 @error('nama_unit') is-invalid @enderror" name="nama_unit" required value="{{ old('nama_unit', $bidang->nama_unit)}}"/>
                            @error('nama_unit')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                        @enderror
                        </div>
                       </div>
                        <div class="m-0 mb-3">
                            <label for="">Kode Bidang</label>
                            <br>
                            <span class="text-danger">contoh 102241XX00</span>
                            <input type="text" class="form-control p-2 pb-3 @error('kode_bidang') is-invalid @enderror" name="kode_bidang" required value="{{ old('kode_bidang', $bidang->kode_bidang)}}" placeholder="contoh: 102241XX00 "/>
                            @error('kode_bidang')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                        @enderror
                         </div>
                       <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i>Simpan</button>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('#roles').select2();
});
</script>
@endsection