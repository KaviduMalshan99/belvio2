<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use App\Models\CustomerOrder;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function customerReport(){
        $customers = User::all();
        return view('AdminDashboard.Reports.customer_report',compact('customers'));
    }

    public function affiliateCustomerReport(){
        $affiliates = AffiliateUser::all();
        return view('AdminDashboard.Reports.affiliate_customer_report',compact('affiliates'));
    }

    public function affiliateCusBankData(){
        $affiliates = AffiliateUser::all();
        return view('AdminDashboard.Reports.affiliate_cus_bank_data',compact('affiliates'));
    }

    public function vendorReport(){
        $vendors = Vendor::all();
        return view('AdminDashboard.Reports.vendor_report',compact('vendors'));
    }

    public function orderReport(){
        $orders = CustomerOrder::all();
        return view('AdminDashboard.Reports.order_report',compact('orders'));
    }

    public function productReport(){
        $products = Product::all();
        return view('AdminDashboard.Reports.product_report',compact('products'));
    }


}
