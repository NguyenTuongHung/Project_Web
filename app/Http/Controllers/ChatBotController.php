<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ChatBotController extends Controller
{
    public function ask(Request $request)
    {
        $question = strtolower($request->input('message'));

        // Lấy tất cả sản phẩm
        $products = Product::all();

        $bestMatch = null;
        foreach ($products as $product) {
            if (str_contains(strtolower($product->name), $question)) {
                $bestMatch = $product;
                break;
            }
        }

        if ($bestMatch) {
            $reply = "Sản phẩm bạn hỏi: {$bestMatch->name}. 
Mô tả: {$bestMatch->desc}. 
Giá: " . number_format($bestMatch->display_price) . " VND.";
        } else {
            $reply = "Xin lỗi, mình chưa tìm thấy sản phẩm phù hợp với câu hỏi của bạn.";
        }

        return response()->json(['reply' => $reply]);
    }
}
