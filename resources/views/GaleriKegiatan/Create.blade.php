@extends('App')
@section('judul')
    {{ $title }}
@endsection

@section('content')
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
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="cart-title mb-2"
                            style="font-size: 20px; color:#e2e8f0; font-weight:900; margin-top: -8px;"">FORM KEGIATAN</div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="m-0 mb-3">
                                <label class="form-label">Kegiatan</label>
                                <input type="text"
                                    class="form-control p-2 pb-3 @error('nama_kegiatan') is-invalid @enderror"
                                    name="nama_kegiatan"  value="{{ old('nama_kegiatan') }}" />
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="m-0 mb-3">
                                <label class="form-label">Dasar Kegiatan</label>
                                <input type="text"
                                    class="form-control p-2 pb-3 @error('dasar_pelaksanaan') is-invalid @enderror"
                                    name="dasar_pelaksanaan" value="{{ old('dasar_pelaksanaan') }}" />
                                @error('dasar_pelaksanaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="m-0 mb-3">
                                    <div class="form-label">Waktu Pelaksanaan</div>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('tanggal') is-invalid @enderror"
                                            name="tanggal" id="tanggal" />
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar4"></i>
                                        </span>

                                    </div>
                                    @error('tanggal')
                                        <strong class="mt-2">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="m-0 mb-3">
                                    <div class="form-label">Tempat Pelaksanaan</div>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                                            name="lokasi_kegiatan" value="{{ old('lokasi_kegiatan') }}" />
                                        @error('lokasi_kegiatan')
                                            <strong class="mt-2">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                        </div>

                        <label for="form-label">Gambar <span>(jpg,png, ukuran file 1mb)</span></label>
                        <div class="mb-3">

                            <img src="{{ asset('/templateDashboard/design/assets/images/no-image.jpg') }}" id="preview"
                                alt="" class="img-fluid mb-2" width="300px">
                            <input type="file" class="form-control @error('image') is-invalid  @enderror" name="image1"
                                id="gambar">
                            @error('image1')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <label for="form-label">Gambar <span>(jpg,png, ukuran file 1mb)</span></label>
                        <div class="mb-3">

                            <img src="{{ asset('/templateDashboard/design/assets/images/no-image.jpg') }}" id="text2"
                                alt="" class="img-fluid mb-2" width="300px">

                            <input type="file" class="form-control @error('image2') is-invalid  @enderror" name="image2"
                                id="gambar2">
                            @error('image2')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <label for="form-label">Gambar <span>(jpg,png, ukuran file 1mb)</span></label>
                        <div class="mb-3">

                            <img src="{{ asset('/TemplateDashboard/design/assets/images/no-image.jpg') }}" id="contoh3"
                                alt="" class="img-fluid mb-2" width="300px">

                            <input type="file" class="form-control @error('image3') is-invalid  @enderror" name="image3"
                                id="gambar3">
                            @error('image3')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Narasi Kegiatan</label>
                            <input id="x" type="hidden" name="narasi_kegiatan"
                                class="@error('narasi_kegiatan') is-invalid  @enderror"
                                value="{{ old('narasi_kegiatan') }}">
                            <trix-editor input="x"></trix-editor>
                            @error('narasi_kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-0 mb-3">
                            <label class="form-label">Bulan</label>
                            <select class="form-select @error('pekan') 'is-invalid'  @enderror"
                                aria-label="Default select example" name="pekan_id">
                                <option selected>--</option>
                                @foreach ($bulan as $key)
                                    <option value="{{ $key }}">{{ $key }}</option>
                                @endforeach
                            </select>
                            @error('pekan')
                                <strong class="text-danger invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="m-0 mb-3">
                            <label class="form-label">Pekan</label>
                            <select class="form-select @error('pekan') 'is-invalid'  @enderror"
                                aria-label="Default select example" name="pekan_id">
                                <option selected>--</option>
                                @foreach ($pekan as $key)
                                    <option value="{{ $key->id }}">{{ $key->pekan }}</option>
                                @endforeach
                            </select>
                            @error('pekan')
                                <strong class="text-danger invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="form-label">Dokumen Hasil Kegiatan</label>
                            <input type="file" class="form-control @error('dokumen') is-invalid  @enderror"
                                name="dokumen">
                            @error('dokumen')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i>Simpan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.opd').select2();
        });
        $('#tanggal').daterangepicker({
            singleDatePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'DD-MM-YYYY',

            }
        });




        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                    $('#preview').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#gambar").change(function() {
            readURL(this);
        });


        function gambar2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#text2').attr('src', e.target.result);
                    $('#text2').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#gambar2").change(function() {
            gambar2(this);
        });


        function gambar3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#contoh3').attr('src', e.target.result);
                    $('#contoh3').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#gambar3").change(function() {
            gambar3(this);
        });
    </script>
@endsection
