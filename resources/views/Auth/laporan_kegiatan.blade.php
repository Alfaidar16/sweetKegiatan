<!DOCTYPE html>
<html>
<head>
    {{-- <title>{{ $title }}</title> --}}
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .header {
            background-color: #d3e8d3;
        }
        .document-title {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 16px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .mb-2 {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div> Tempat : {{$data->lokasi_kegiatan }} </div>
    <div>Hari/Tanggal: {{ $data->hari }} /  {{$data->tanggal }}</div>
    <div>Pukul: {{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }} WITA - Selesai</div>

    <table>
        <thead>
            <tr class="header">
                <th>NO</th>
                <th>KEGIATAN</th>
                <th>DASAR PELAKSANAAN KEGIATAN</th>
                <th>URAIAN</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($data as $key) --}}
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{!! nl2br(e($data->nama_kegiatan)) !!}</td>
                    <td>{!! ($data->dasar_pelaksanaan) !!}</td>
                    <td>{!! ($data->narasi_kegiatan) !!}</td>
                </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>

    <div class="section-title">DOKUMENTASI KEGIATAN</div>
    {{-- @foreach($data as $item) --}}
  
            <img src="{{ asset('/upload/kegiatan/', $data->image) }}" class="img-fluid mb-2" alt="Dokumentasi Kegiatan">
    
    {{-- @endforeach --}}
</body>
</html>