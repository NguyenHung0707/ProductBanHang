<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    private $orderService;
    private $orderDetailService;
    public function __construct(OrderServiceInterface $orderService, OrderDetailServiceInterface $orderDetailService){


    }
    //
    public function index() {

        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request) {
        //1. Thêm đơn hàng

        $data = $request->all();
        $data['status'] = Constant::order_status_ReceiveOrders;
        $order = Order::create($data);

        //2. Thêm chi tiết đơn hàng
        $carts = Cart::content();

        if( $request->payment_type == 'pay_later') {

            foreach ($carts as $cart) {
                $data = [
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'qty' => $cart->qty,
                    'amount' => $cart->price,
                    'total' => $cart->price * $cart->qty,

                ];
                OrderDetail::create($data);
            }


            //3. Gửi email
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order, $total, $subtotal);

            //4. Xóa giỏ hàng
            Cart::destroy();

            //5. Trả về kết quả
            return redirect('checkout/result')->with('notification', 'Success! You will pay on delivery. Please check your email');
        }
        if( $request->payment_type == 'online_payment') {
            //1. Lấy URL thanh toán VNPay
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TnxRef' => $order->id, //ID đơn hàng
                'vnp_OrderInfo' => 'Mô tả về đơn hàng ở đây...',
                'vnp_Amount' => Cart::total(0,'', '') * 23075,
            ]);


            //2. Chuyển hướng tới URL lấy được

            return redirect()->to($data_url);

        }


    }

    public function vnPayCheck(Request $request) {
        //1. Lấy data từ URL (do VNPAY gửi về qua $vnp_Returnurl

        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); // Mã phản hồi thanh toán . 00 = Thành công
        $vnp_TnxRef = $request->get('vnp_TnxRef'); //ticket_id
        $vnp_Amount = $request->get('vnp_Amount');


        //2. Kiểm tra ết quả giao dịch trả về từ VMPay
        if($vnp_ResponseCode != null) {
          //  Nếu thành công
            if ($vnp_ResponseCode == 00) {

                //Cập nhật trạng thái order
                $this->orderService->update(['status' => Constant::order_status_Paid], $vnp_TnxRef);

                //Gửi: Email
                $order = Order::find($vnp_TnxRef);
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order, $total, $subtotal);

                //Xóa giỏ hàng
                Cart::destroy($order);

                // Thông báo kết quả.

                return redirect('checkout/result')->with('notification', 'Success! Has paid online. Please check your email');
            }
            else {
                // Nếu không thành công
                // xóa đơn hàng đã thêm vào Database
                Order::find($vnp_TnxRef)->delete();
                // trả về thông báo lỗi.
                return redirect('checkout/result')->with('notification', 'ERROR: Payment failed or canceled');

        }
        }

    }

    public function  result() {

        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }

    private function sendEmail($order, $total, $subtotal) {
        $email_to = $order->email;

        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'), function ($message) use ($email_to) {
            $message->from('hung111@gmail.com', 'Hung Online');
            $message->to($email_to, $email_to);
            $message->subject('Order Notification');
        });
    }



}
