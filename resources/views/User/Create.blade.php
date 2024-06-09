@extends('App')
@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="card">
            <div class="card-header bg-primary">
                <div class="cart-title mb-2" style="font-size: 20px; color:#e2e8f0; font-weight:900; margin-top: -8px;"">FORM USER</div>
            </div>
            <div class="card-body">
                   <div class="col-md-12">
                    <div class="m-0 mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control p-2 pb-3 @error('name') is-invalid @enderror" name="name" required value="{{ old('name')}}"/>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                    </div>
                   </div>
                    <div class="m-0 mb-3">
                        <label for="">Email</label>
                        <input type="text" class="form-control p-2 pb-3 @error('email') is-invalid @enderror" name="email" required value="{{ old('email')}}"/>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                     </div>
                     <div class="m-0 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control p-2 @error('password') is-invalid @enderror" name="password" required value="{{ old('password')}}"/>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror
                    </div>
                        <div class="m-0 mb-3">
                        <label for="">Roles</label>
                        <select class="form-control p-3" name="roles_id" required id="roles">
                            <option value=""></option>
                            @foreach ($role as $key )
                            <option value="{{ $key->id}}">{{$key->name}}</option>
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
</script>
@endsection