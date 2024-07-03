@extends('App')

@section('judul')
{{ $title}}
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card p-3 pb-3">
                <div class=" p-4 fw-bold" style="font-size: 30px;">Laporan Kegiatan Pemprov Sulsel</div>
                <div class="d-flex mx-5">
                    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Laporan Harian
                      </button>
                      {{-- <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#pekanModal">
                        Laporan Mingguan
                      </button> --}}
                      <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#bulanModal">
                        Laporan Bulanan
                      </button>

                    
                  
                </div>
              {{-- <div class="row">
                <div class="d-flex mx-5 mt-3">
                  @foreach ($pekan as $key )
                  <a href="{{ route('filter.pekan', $key->id) }}" class="btn btn-primary mx-2">{{ $key->pekan }}</a>
                  @endforeach
                  
                </div>
              </div> --}}
             <div class="ms-auto">
                <img src="{{ asset('/TemplateDashboard/design/assets/images/vector.png')}}" alt="" width="200" style="margin-top: -90px;">
                    
            
             </div>
               
            </div>
          
        
    </div>
</div>
<div class="row mt-5">
   <div class="col-lg-12">
     @foreach ($dataPerpekan as $key )
     @php
    
     $images = explode(',', $key->image);
        @endphp
     <div class="card">
        <div class="card-header">
            <h5>{{ $key->nama_kegiatan }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    @foreach ($images as $image )
                    <img src="{{ asset('upload/kegiatan/' . trim($image)) }}" alt="" width="500">
                    @endforeach
                   
                </div>
                <div class="col-sm-6">
                    <table>
                        <tbody>
                            <tr class="fs-5">
                                <td >Dasar Pelaksanaan</td>
                                <td>&nbsp; : &nbsp;</td>
                                <td>{{ $key->dasar_pelaksanaan }}</td>
                            </tr>
                            <tr class="fs-5">
                                <td >Lokasi Kegiatan</td>
                                <td>&nbsp; : &nbsp;</td>
                                <td>{{ $key->lokasi_kegiatan }}</td>
                            </tr>
                            <tr class="fs-5">
                                <td>Tanggal</td>
                                <td>&nbsp; : &nbsp;</td>
                                <td>{{ date('d-m-Y', strtotime( $key->tanggal )) }}</td>
                            </tr>

                            <tr class="fs-5">
                                <td>Pekan</td>
                                <td>&nbsp; : &nbsp;</td>
                                <td>{{ $key->pekan_id }}</td>
                            </tr>
                            <tr class="fs-5">
                                <td>Narasi Kegiatan</td>
                                <td>&nbsp; : &nbsp;</td>
                                <td>{!! $key->narasi_kegiatan !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     @endforeach
   </div>
</div>

@include('Layouts.modalPrint')
@endsection

@section('js')
<script>
    $('.datepicker').daterangepicker({
	singleDatePicker: true,
  startDate: moment().startOf('hour'),
  endDate: moment().startOf('hour').add(32, 'hour'),
  locale: {
    format: 'DD-MM-YYYY',
    
  }
});

</script>
@endsection
