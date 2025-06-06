<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class StruckOrderController extends Controller
{
    public function print($id)
    {
        try {

            $printerName = Auth::user()->printer_name;

            if (!$printerName) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Set printer name first.'
                ]);
            }

            $order = Order::findOrFail($id);
            $products = json_decode($order->products, true);

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
            $printer->text("Jl. Raya Laladon No.25, Laladon, Kec. Ciomas, Kabupaten Bogor,  Jawa Barat\n");
            $printer->text("Telp: 0838-5718-5413\n\n");
            $printer->setUnderline(1);
            $printer->text("===== STRUK PEMESANAN =====\n\n");


            $printer->setJustification(Printer::JUSTIFY_LEFT);
            // $printer->text("No. Pesanan : " . $order->order_id . "\n");
            $printer->text("Kasir       : " . $order->casier_name . "\n");
            $printer->text("Customer    : " . $order->customer_name . "\n");
            $printer->text("No. Pesanan    : " . $order->order_id . "\n");
            $printer->text("Tanggal     : " . $order->created_at->format('d-m-Y H:i') . "\n");
            $printer->text("--------------------------------\n");

            foreach ($products as $product) {
                $printer->text($product['nama_menu'] . " x" . $product['quantity'] . "\n");
                $printer->text("Rp " . number_format($product['price'], 0) . "\n");
            }

            $printer->text("--------------------------------\n");
            $printer->text("Total    : Rp " . number_format($order->total_price, 0) . "\n");
            $printer->text("Metode   : " . $order->payment_method . "\n");
            $printer->text("Layanan  : " . $order->serve_option . "\n");
            $printer->text("Status   : " . $order->status . "\n");
            $printer->text("Catatan  : " . $order->request . "\n");
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
