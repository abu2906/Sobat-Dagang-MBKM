<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\IndexHarga;
use Carbon\Carbon;

class CopyYesterdayPrice extends Command
{
    protected $signature = 'copy:yesterday-price';
    protected $description = 'Copy price data from yesterday to today if not updated';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $today = Carbon::today()->toDateString();

        $yesterdayPrices = IndexHarga::where('tanggal', $yesterday)->get();

        foreach ($yesterdayPrices as $item) {
            $exists = IndexHarga::where('id_barang', $item->id_barang)
                ->where('tanggal', $today)
                ->exists();

            if (!$exists) {
                IndexHarga::create([
                    'id_barang' => $item->id_barang,
                    'id_index_kategori' => $item->id_index_kategori,
                    'harga' => $item->harga,
                    'tanggal' => $today,
                    'lokasi' => $item->lokasi,
                ]);
            }
        }

        $this->info('harga hari ini sudah diperbarui dengan harga kemarin.');
    }
}
