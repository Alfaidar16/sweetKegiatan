<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB; 

class LaporanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $laporan = DB::table('galeri_kegiatan')->get();

        $data = [ 
            $laporan->where('pekan_id', 1)->count(),
            $laporan->where('pekan_id', 2)->count(),
            $laporan->where('pekan_id', 3)->count(),
            $laporan->where('pekan_id', 4)->count()
        ];

        $label = [
            'Pekan 1',
            'Pekan 2', 
            'Pekan 3', 
            'Pekan 4'
        ];
        return $this->chart->pieChart()
            ->setTitle('Data Laporan Perpekan')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setLabels($label);
    }
}
