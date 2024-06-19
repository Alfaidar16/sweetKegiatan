
{{-- Modal Harian--}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="margin-top: 180px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('generate.pdf') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="m-0">
                        <div class="form-label">Dari Tanggal</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_awal" />
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <div class="m-0">
                        <div class="form-label">Sampai Tanggal</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_akhir"/>
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
       
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  {{-- Data Perpekan --}}
  <div class="modal fade" id="pekanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="margin-top: 180px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Perpekan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('generate.pekan') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="m-0">
                        <div class="form-label">Dari Pekan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_awal" />
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <div class="m-0">
                        <div class="form-label">Sampai Pekan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_akhir"/>
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
       
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  {{-- End Perpekan --}}

  {{-- Data Bulan --}}
  <div class="modal fade" id="bulanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="margin-top: 180px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Bulanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('generate.month') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="m-0">
                        <div class="form-label">Dari Bulan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_awal" />
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <div class="m-0">
                        <div class="form-label">Sampai Bulan</div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_akhir"/>
                            <span class="input-group-text">
                                <i class="bi bi-calendar4"></i>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
       
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  {{-- End Data Bulan --}}