<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector; // Sesuaikan dengan sistem Anda
use App\Models\History;

class StruckController extends Controller
{
    public function print($id)
    {
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
            $connector = new WindowsPrintConnector("POS-58"); // Ganti dengan nama printer Anda
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("===== STRUK PEMBAYARAN =====\n\n");
            $printer->text("~~~~~   BangbaraPOS ~~~~~\n\n");


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
            $printer->text("Status   : " . $history->status . "\n");
            $printer->text("\nTerima kasih!\n\n");

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
