<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector; // Sesuaikan dengan sistem Anda
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class StruckHistoryController extends Controller
{
    public function print($id)
    {
        $printerName = Auth::user()->printer_name;

        if(!$printerName) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot set printer name'
            ]);
        }

        try {
            $history = History::findOrFail($id);
            $firstDecode = json_decode($history->products, true);
            $products = json_decode($firstDecode, true); // decode kedua

            if (empty($products)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Produk tidak ditemukan atau format tidak valid.'
                ]);
            }
            // $printerName = "\\\\UmaruSyahid\\POS-58"; // Perhatikan double backslash
            $connector = new WindowsPrintConnector($printerName); // Ganti dengan nama printer Anda
            $printer = new Printer($connector);

            // Pusatkan dan tampilkan header
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(2, 2); // Perbesar teks nama restoran
            $printer->setEmphasis(true); // Buat bold
            $printer->text("Bangbara Steak\n");
            $printer->setTextSize(1, 1); // Kembalikan ukuran normal
            $printer->setEmphasis(false); // Matikan bold
            $printer->text("Jl. Raya Laladon No.25, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat\n");
            $printer->text("Telp: (021) 12345678\n\n");           
            $printer->setUnderline(1);
            $printer->text("===== STRUK PEMBAYARAN =====\n\n");

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Kasir   : " . $history->casier_name . "\n");
            $printer->text("Customer: " . $history->customer_name . "\n");
            $printer->text("Tanggal : " . $history->created_at->format('d-m-Y H:i') . "\n");
            $printer->text("--------------------------------\n");

            foreach ($products as $product) {
                $printer->text($product['nama_menu'] . " x" . $product['quantity'] . "\n");
                $printer->text("Rp " . number_format($product['price'], 0) . "\n");
            }

            $printer->text("--------------------------------\n");
            $printer->text("Total    : Rp " . number_format($history->total_price, 0) . "\n");
            $printer->text("Metode   : " . $history->payment_method . "\n");
            // Tampilkan "DIBAYAR" jika status completed
            if (strtolower($history->status) === 'completed') {
                $printer->text("Status   : DIBAYAR\n");
            } else {
                $printer->text("Status   : " . $history->status . "\n");
            }            $printer->text("\nTerima kasih!\n\n");

            $printer->cut();
            $printer->close();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
    }
}
}
