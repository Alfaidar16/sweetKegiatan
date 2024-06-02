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
                <div class="cart-title mb-2" style="font-size: 20px; color:#e2e8f0; font-weight:900; margin-top: -8px;"">FORM USER</div>
            </div>
            <div class="card-body">
            
                   <div class="col-md-12">
                    <div class="m-0 mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control p-2 pb-3 @error('title') is-invalid @enderror" name="title" required value="{{ old('title')}}"/>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                    </div>
                   </div>
                
                    {{-- <div class="row">
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
        
                    </div> --}}
                    <div class="m-0 mb-3">
                        <label for="">Email</label>
                        <select class="opd form-control p-2" name="instansi_id" required>
                            <option value=""></option>
                          </select>

                     </div>

                     <div class="m-0 mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control p-2 @error('title') is-invalid @enderror" name="title" required value="{{ old('title')}}"/>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                    </div>

                        <div class="m-0 mb-3">
                        <label for="">Roles</label>
                        <select class="roles form-control p-2" name="instansi_id" required>
                            <option value=""></option>
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
    $('.roles').select2();
});
</script>
@endsection