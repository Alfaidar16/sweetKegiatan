@extends('App')
@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <form action="#" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        <div class="card">
            <div class="card-header bg-primary">
                <div class="cart-title mb-2" style="font-size: 20px; color:#e2e8f0; font-weight:900; margin-top: -8px;"">FORM UBAH USER</div>
            </div>
            <div class="card-body">
                <div class="m-0 mb-3">
                    <label for="">Bidang</label>
                    <select class="form-control p-3" name="kode_bidang" required id="kodebidang">
                        {{-- <option value="" selected> {{ $bidang->kode_bidang }}</option> --}}
                        @foreach ($bidang as $key )
                        <option value="{{ $key->kode_bidang}}">{{$key->nama_unit}}</option>
                        @endforeach
                      </select>
                 </div>
                   <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i>Simpan</button>
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
$(document).ready(function() {
    $('#kodebidang').select2();
});
</script>
@endsection