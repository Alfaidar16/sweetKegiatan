@extends('App')
@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="card">
            <div class="card-header bg-primary">
                <div class="cart-title mb-2" style="font-size: 20px; color:#e2e8f0; font-weight:900; margin-top: -8px;"">FORM KEGIATAN</div>
            </div>
            <div class="card-body">
            
                   <div class="col-md-12">
                    <div class="m-0 mb-3">
                        <label class="form-label">Dasar Kegiatan</label>
                        <input type="text" class="form-control p-2 pb-3 @error('title') is-invalid @enderror" name="title" required value="{{ old('title')}}"/>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                    </div>
                   </div>
                    <div class="mb-3">
                        <label for="" class="mb-2">Uraian Kegiatan</label>
                        <input id="x"  type="hidden" name="post" class="@error('post') is-invalid  @enderror" required value="{{ old('post')}}">
                        <trix-editor input="x"></trix-editor>
                        @error('post')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="m-0 mb-3">
                                <div class="form-label">Waktu Pelaksanaan</div>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('created_at') is-invalid
                                        
                                    @enderror" name="created_at" />
        
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar4"></i>
                                    </span>
                                  
                                </div>
                                @error('created_at')
                                <strong class="mt-2">{{$message}}</strong>
                            @enderror
                            </div>
                           </div>
                           <div class="col-md-8">
                            <div class="m-0 mb-3">
                                <div class="form-label">Tempat Pelaksanaan</div>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('created_at') is-invalid @enderror" name="created_at" />
                                </div>
                               
                            </div>
                           </div>
        
                    </div>
                    <div class="m-0 mb-3">
                        <label for="">Opd</label>
                        <select class="opd form-control p-2" name="instansi_id" required>
                            <option value=""></option>
                          </select>

                     </div>

                     <div class="mb-3">
                        <label for="form-label">Gambar <span>(jpg,png, ukuran file 1mb)</span></label>
                        <input type="file" class="form-control @error('cover') is-invalid  @enderror" name="cover">
                        @error('cover')
                        <div class="invalid-feedback">
                         <strong>{{ $message}}</strong>
                        </div>
                    @enderror
                     </div>
                     <div class="m-0 mb-3">
                        <label class="form-label">Link/Url</label>
                        <input type="text" class="form-control p-2 @error('title') is-invalid @enderror" name="title" required value="{{ old('title')}}"/>
                        @error('title')
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
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('.opd').select2();
});
</script>
@endsection