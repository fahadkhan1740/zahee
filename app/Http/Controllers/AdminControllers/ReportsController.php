<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Lang;

use DB;

//for password encryption or hash protected
use Hash;

//for authenitcate login data

//for requesting a value
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //statsCustomers
    public function statsCustomers(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.CustomerOrdersTotal"));

        $cusomters = DB::table('users')
            ->join('orders', 'orders.customers_id', '=', 'users.id')
            ->select(
                'users.*',
                'order_price',
                DB::raw('SUM(order_price) as price'),
                DB::raw('count(orders_id) as total_orders'),
                'delivery_phone'
            )
            ->where('role_id', 2)
            ->groupby('users.id')
            ->orderby('total_orders', 'desc')
            ->get();

        $result['cusomters'] = $cusomters;

        $myVar = new SiteSettingController();
        $result['setting'] = $myVar->getSetting();

        return view("admin.reports.statsCustomers", $title)->with('result', $result);
    }

    //statsProductsPurchased
    public function statsProductsPurchased(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.StatsProductsPurchased"));

        $products = DB::table('products')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->join('inventory', 'inventory.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
            ->LeftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->LeftJoin(
                'categories_description',
                'categories_description.categories_id',
                '=',
                'products_to_categories.categories_id'
            )
            ->select(
                'products_description.*',
                'image_categories.path as path',
                'inventory.*',
                'categories_description.categories_name'
            )
            ->where('categories_description.language_id', '=', 1)
            ->where('stock_type', 'in')
            ->orderBy('products_ordered', 'DESC')
            ->where('products_description.language_id', '=', '1')
            ->paginate(20);

        $result['data'] = $products;
        //get function from other controller
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();

        return view("admin.reports.statsProductsPurchased", $title)->with('result', $result);
    }

    //statsProductsLiked
    public function statsProductsLiked(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.StatsProductsLiked"));

        $products = DB::table('products')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
            ->LeftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->LeftJoin(
                'categories_description',
                'categories_description.categories_id',
                '=',
                'products_to_categories.categories_id'
            )
            ->where('categories_description.language_id', '=', 1)
            ->where('products.products_liked', '>', '0')
            ->where('products_description.language_id', '=', '1')
            ->orderBy('products_liked', 'DESC')
            ->paginate(20);

        $result['data'] = $products;

        //get function from other controller
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();

        return view("admin.reports.statsProductsLiked", $title)->with('result', $result);
    }

    //productsStock
    public function outofstock(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.outOfStock"));
        $language_id = 1;

        $products = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->leftJoin('image_categories', 'image_categories.image_id', '=', 'products.products_image')
            ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin(
                'categories_description',
                'categories.categories_id',
                '=',
                'categories_description.categories_id'
            )
            ->where('products_description.language_id', '=', $language_id)
            ->where('image_categories.image_type', '=', 'THUMBNAIL')
            ->orderBy('products.products_id', 'DESC')
            ->get();

        $result = array();
        $products_array = array();
        $index = 0;
        $lowLimit = 0;
        $outOfStock = 0;
        $products_ids = array();
        $data = array();
        // dd($products);
        foreach ($products as $products_data) {
            $currentStocks = DB::table('inventory')->where('products_id', $products_data->products_id)->get();

            if (count($currentStocks) > 0) {
                if ($products_data->products_type != 1) {
                    $c_stock_in = DB::table('inventory')->where(
                        'products_id',
                        $products_data->products_id
                    )->where('stock_type', 'in')->sum('stock');
                    $c_stock_out = DB::table('inventory')->where(
                        'products_id',
                        $products_data->products_id
                    )->where('stock_type', 'out')->sum('stock');

                    if (($c_stock_in - $c_stock_out) == 0) {
                        if (!in_array($products_data->products_id, $products_ids)) {
                            $products_ids[] = $products_data->products_id;
                            array_push($data, $products_data);
                            $outOfStock++;
                        }
                    }
                }
            } else {
                if (!in_array($products_data->products_id, $products_ids)) {
                    $products_ids[] = $products_data->products_id;
                    array_push($data, $products_data);
                    $outOfStock++;
                }
            }
        }
        $result['products'] = $data;
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();
        return view("admin.reports.outofstock", $title)->with('result', $result);
    }

    //lowinstock
    public function lowinstock(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.Low Stock Products"));

        $products = DB::table('products')
            ->leftJoin('products_description', function ($join) {
                $join->on('products_description.products_id', '=', 'products.products_id')
                    ->where(function ($query) {
                        $query->where('products_description.language_id', '=', 1);
                    });
            })
            ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin('categories_description', function ($join) {
                $join->on('categories.categories_id', '=', 'categories_description.categories_id')
                    ->where(function ($query) {
                        $query->where('categories_description.language_id', '=', 1);
                    });
            })
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL');
                    });
            })
            ->where('products.low_limit', '>', 0)
            ->orderBy('products.products_id', 'DESC')
            ->get([
                'products.*', 'products_description.*', 'categories_description.categories_name', 'image_categories.*'
            ]);

        $result2 = array();
        $products_array = array();
        $index = 0;
        $lowLimit = 0;
        $outOfStock = 0;
        foreach ($products as $product) {
            $inventories = DB::table('inventory')->where('products_id', $product->products_id)->where(
                'stock_type',
                'in'
            )->get();

            $stockIn = 0;
            if (count($inventories) > 0) {
                foreach ($inventories as $inventory) {
                    $stockIn += $inventory->stock;
                }
            } else {
                $stockIn = 0;
            }

            $orders_products = DB::table('orders_products')
                ->select(DB::raw('count(orders_products.products_quantity) as stockout'))
                ->where('products_id', $product->products_id)->get();

            $stockOut = 0;
            $inventoryData = DB::table('inventory')->where('products_id', $product->products_id)->where(
                'stock_type',
                'out'
            )->get();
            if (count($inventoryData) > 0) {
                foreach ($inventoryData as $inventory) {
                    $stockOut += $inventory->stock;
                }
            } else {
                $stockOut = 0;
            }

            $stocks = $stockIn - ($orders_products[0]->stockout + $stockOut);

            // $manageLevel = DB::table('manage_min_max')->where('products_id',$product->products_id)->get();

            // $min_level = 0;
            // $max_level = 0;

            // if(count($manageLevel)>0){
            //     $min_level = $manageLevel[0]->min_level;
            //     $max_level = $manageLevel[0]->max_level;
            // }

            if ($stocks <= $product->low_limit && $stocks > 0) {
                array_push($products_array, array(
                    'products_image' => $product->path,
                    'products_name' => $product->products_name,
                    'products_quantity' => $stocks,
                    'products_id' => $product->products_id,
                    'categories_name' => $product->categories_name
                ));
            }
        }

        $result['lowQunatity'] = $products_array;

        //get function from other controller
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();

        return view("admin.reports.lowinstock", $title)->with('result', $result);
    }

    //productsStock
    public function stockin(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductsStocks"));
        $language_id = 1;

        $products = DB::table('products')
            ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->where('products.products_id', '=', $request->products_id)
            ->get();

        $productsArray = array();
        $index = 0;
        foreach ($products as $product) {
            array_push($productsArray, $product);
            $inventories = DB::table('inventory')->where('products_id', $product->products_id)
                ->leftJoin('users', 'users.id', '=', 'inventory.admin_id')
                ->get();

            $productsArray['history'] = $inventories;
        }
        $result['products'] = $productsArray;

        //echo '<pre>'.print_r($result['products'],true).'<pre>';

        //get function from other controller
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();

        return view("admin.reports.stockin", $title)->with('result', $result);
    }

    public function getFormattedDate($reportBase)
    {
        $dateFrom = date('Y-m-01', $date);
        $dateTo = date('Y-m-t', $date);
    }

    public function productSaleReport(Request $request)
    {
        $saleData = array();
        $date = time();
        $reportBase = $request->reportBase;
        //$reportBase = 'last_year';

        if ($reportBase == 'this_month') {
            $dateLimit = date('d', $date);

            //for current month
            for ($j = 1; $j <= $dateLimit; $j++) {
                $dateFrom = date('Y-m-'.$j.' 00:00:00', time());
                $dateTo = date('Y-m-'.$j.' 23:59:59', time());

                //sold products
                $orders = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->get();

                $totalSale = 0;
                foreach ($orders as $orders_data) {
                    $orders_status = DB::table('orders_status_history')
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->orderby('date_added', 'DESC')->limit(1)->get();

                    if ($orders_status[0]->orders_status_id != 3) {
                        $totalSale++;
                    }
                }

                //purchase products
                $products = DB::table('products')
                    ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                    ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                    ->get();

                $saleData[$j - 1]['date'] = date('d M', strtotime($dateFrom));
                $saleData[$j - 1]['totalSale'] = $totalSale;

                if (empty($products[0]->products_quantity)) {
                    $producQuantity = 0;
                } else {
                    $producQuantity = $products[0]->products_quantity;
                }

                $saleData[$j - 1]['productQuantity'] = $producQuantity;
            }
        } else {
            if ($reportBase == 'last_month') {
                $datePrevStart = date("Y-n-j", strtotime("first day of previous month"));
                $datePrevEnd = date("Y-n-j", strtotime("last day of previous month"));

                $dateLimit = date('d', strtotime($datePrevEnd));

                //for last month
                for ($j = 1; $j <= $dateLimit; $j++) {
                    $dateFrom = date('Y-m-'.$j.' 00:00:00', strtotime($datePrevStart));
                    $dateTo = date('Y-m-'.$j.' 23:59:59', strtotime($datePrevEnd));

                    //sold products
                    $orders = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->get();

                    $totalSale = 0;
                    foreach ($orders as $orders_data) {
                        $orders_status = DB::table('orders_status_history')
                            ->where('orders_id', '=', $orders_data->orders_id)
                            ->orderby('date_added', 'DESC')->limit(1)->get();

                        if ($orders_status[0]->orders_status_id != 3) {
                            $totalSale++;
                        }
                    }

                    //purchase products
                    $products = DB::table('products')
                        ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                        ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                        ->get();

                    $saleData[$j - 1]['date'] = date('d M', strtotime($dateFrom));
                    $saleData[$j - 1]['totalSale'] = $totalSale;

                    if (empty($products[0]->products_quantity)) {
                        $producQuantity = 0;
                    } else {
                        $producQuantity = $products[0]->products_quantity;
                    }

                    $saleData[$j - 1]['productQuantity'] = $producQuantity;
                }
            } else {
                if ($reportBase == 'last_year') {
                    $dateLimit = date("Y", strtotime("-1 year"));

                    $datePrevStart = date("Y-n-j", strtotime("first day of previous month"));
                    $datePrevEnd = date("Y-n-j", strtotime("last day of previous month"));

                    //for last year
                    for ($j = 1; $j <= 12; $j++) {
                        $dateFrom = date($dateLimit.'-'.$j.'-1 00:00:00', strtotime($datePrevStart));
                        $dateTo = date($dateLimit.'-'.$j.'-31 23:59:59', strtotime($datePrevEnd));

                        //sold products
                        $orders = DB::table('orders')
                            ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                            ->get();

                        $totalSale = 0;
                        foreach ($orders as $orders_data) {
                            $orders_status = DB::table('orders_status_history')
                                ->where('orders_id', '=', $orders_data->orders_id)
                                ->orderby('date_added', 'DESC')->limit(1)->get();

                            if ($orders_status[0]->orders_status_id != 3) {
                                $totalSale++;
                            }
                        }

                        //purchase products
                        $products = DB::table('products')
                            ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                            ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                            ->get();

                        $saleData[$j - 1]['date'] = date('M Y', strtotime($dateFrom));
                        $saleData[$j - 1]['totalSale'] = $totalSale;

                        if (empty($products[0]->products_quantity)) {
                            $producQuantity = 0;
                        } else {
                            $producQuantity = $products[0]->products_quantity;
                        }

                        $saleData[$j - 1]['productQuantity'] = $producQuantity;
                    }
                } else {
                    $reportBase = str_replace('dateRange', '', $reportBase);
                    $reportBase = str_replace('=', '', $reportBase);
                    $reportBase = str_replace('-', '/', $reportBase);

                    $dateFrom = substr($reportBase, 0, 10);
                    $dateTo = substr($reportBase, 11, 21);

                    $diff = abs(strtotime($dateFrom) - strtotime($dateTo));
                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    $totalDays = floor($diff / (60 * 60 * 24));

                    $totalMonths = floor($diff / 60 / 60 / 24 / 30);

                    if ($diff == 0 && $days == 0 && $years == 0 && $months == 0) {
                        //print 'asdsad';

                        $dateLimitFrom = date('G', strtotime($dateFrom));
                        $dateLimitTo = date('d', strtotime($dateTo));
                        $selecteddate = date('m', strtotime($dateFrom));
                        $selecteddate = date('Y', strtotime($dateFrom));

                        //for current month
                        for ($j = 1; $j <= 24; $j++) {
                            $dateFrom = date('Y-m-d'.' '.$j.':00:00', strtotime($dateFrom));
                            $dateTo = date('Y-m-d'.' '.$j.':59:59', strtotime($dateFrom));

                            //sold products
                            $orders = DB::table('orders')
                                ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                                ->get();

                            $totalSale = 0;
                            foreach ($orders as $orders_data) {
                                $orders_status = DB::table('orders_status_history')
                                    ->where('orders_id', '=', $orders_data->orders_id)
                                    ->orderby('date_added', 'DESC')->limit(1)->get();

                                if ($orders_status[0]->orders_status_id != 3) {
                                    $totalSale++;
                                }
                            }

                            //purchase products
                            $products = DB::table('products')
                                ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                                ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                                ->get();

                            $saleData[$j - 1]['date'] = date('h a', strtotime($dateFrom));
                            $saleData[$j - 1]['totalSale'] = $totalSale;

                            if (empty($products[0]->products_quantity)) {
                                $producQuantity = 0;
                            } else {
                                $producQuantity = $products[0]->products_quantity;
                            }

                            $saleData[$j - 1]['productQuantity'] = $producQuantity;
                            //print $dateLimitFrom.'<br>';
                        }
                    } else {
                        if ($days > 1 && $years == 0 && $months == 0) {
                            //print 'daily';

                            $dateLimitFrom = date('d', strtotime($dateFrom));
                            $dateLimitTo = date('d', strtotime($dateTo));
                            $selectedMonth = date('m', strtotime($dateFrom));
                            $selectedYear = date('Y', strtotime($dateFrom));
                            //print $selectedYear;

                            //for current month
                            for ($j = 1; $j <= $totalDays; $j++) {
                                //print 'dateFrom: '.date('Y-m-'.$j.' 00:00:00', time()).'dateTo: '.date('Y-m-'.$j.' 23:59:59', time());
                                //print '<br>';

                                $dateFrom = date(
                                    $selectedYear.'-'.$selectedMonth.'-'.$dateLimitFrom,
                                    strtotime($dateFrom)
                                );
                                //$dateTo 	= date('Y-m-'.$j.' 23:59:59', time());
                                //print $dateFrom .'<br>';
                                $lastday = date('t', strtotime($dateFrom));
                                //print 'lastday: '.$lastday .' <br>';

                                //sold products
                                $orders = DB::table('orders')
                                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                                    ->get();

                                $totalSale = 0;
                                foreach ($orders as $orders_data) {
                                    $orders_status = DB::table('orders_status_history')
                                        ->where('orders_id', '=', $orders_data->orders_id)
                                        ->orderby('date_added', 'DESC')->limit(1)->get();

                                    if ($orders_status[0]->orders_status_id != 3) {
                                        $totalSale++;
                                    }
                                }

                                //purchase products
                                $products = DB::table('products')
                                    ->select(
                                        'products_quantity',
                                        DB::raw('SUM(products_quantity) as products_quantity')
                                    )
                                    ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                                    ->get();

                                $saleData[$j - 1]['date'] = date('d M', strtotime($dateFrom));
                                $saleData[$j - 1]['totalSale'] = $totalSale;

                                if (empty($products[0]->products_quantity)) {
                                    $producQuantity = 0;
                                } else {
                                    $producQuantity = $products[0]->products_quantity;
                                }

                                $saleData[$j - 1]['productQuantity'] = $producQuantity;
                                //print $dateLimitFrom.'<br>';
                                if ($dateLimitFrom == $lastday) {
                                    $dateLimitFrom = '1';
                                    $selectedMonth++;
                                } else {
                                    $dateLimitFrom++;
                                }

                                if ($selectedMonth > 12) {
                                    $selectedMonth = '1';
                                    $selectedYear++;
                                }
                            }
                        } else {
                            if ($months >= 1 && $years == 0) {
                                //for check if date range enter into another month
                                if ($days > 0) {
                                    $months += 1;
                                }

                                $dateLimitFrom = date('d', strtotime($dateFrom));
                                $dateLimitTo = date('d', strtotime($dateTo));
                                $selectedMonth = date('m', strtotime($dateFrom));
                                $selectedYear = date('Y', strtotime($dateFrom));
                                //print $selectedMonth;

                                $i = 0;
                                //for current month
                                for ($j = 1; $j <= $months; $j++) {
                                    if ($j == $months) {
                                        $lastday = $dateLimitTo;
                                    } else {
                                        $lastday = date(
                                            't',
                                            strtotime($dateLimitFrom.'-'.$selectedMonth.'-'.$selectedYear)
                                        );
                                    }

                                    $dateFrom = date(
                                        $selectedYear.'-'.$selectedMonth.'-'.$dateLimitFrom,
                                        strtotime($dateFrom)
                                    );
                                    $dateTo = date($selectedYear.'-'.$selectedMonth.'-'.$lastday, strtotime($dateTo));
                                    //print $dateFrom.' '.$dateTo.'<br>';

                                    //sold products
                                    $orders = DB::table('orders')
                                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                                        ->get();

                                    $totalSale = 0;
                                    foreach ($orders as $orders_data) {
                                        $orders_status = DB::table('orders_status_history')
                                            ->where('orders_id', '=', $orders_data->orders_id)
                                            ->orderby('date_added', 'DESC')->limit(1)->get();

                                        if ($orders_status[0]->orders_status_id != 3) {
                                            $totalSale++;
                                        }
                                    }

                                    //purchase products
                                    $products = DB::table('products')
                                        ->select(
                                            'products_quantity',
                                            DB::raw('SUM(products_quantity) as products_quantity')
                                        )
                                        ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                                        ->get();

                                    $saleData[$i]['date'] = date('M Y', strtotime($dateFrom));
                                    $saleData[$i]['totalSale'] = $totalSale;

                                    if (empty($products[0]->products_quantity)) {
                                        $producQuantity = 0;
                                    } else {
                                        $producQuantity = $products[0]->products_quantity;
                                    }

                                    $saleData[$i]['productQuantity'] = $producQuantity;

                                    $selectedMonth++;
                                    if ($selectedMonth > 12) {
                                        $selectedMonth = '1';
                                        $selectedYear++;
                                    }
                                    $i++;
                                }
                            } else {
                                if ($years >= 1) {
                                    //print $years.'sadsa';
                                    if ($months > 0) {
                                        $years += 1;
                                    }

                                    //print $years;

                                    $dateLimitFrom = date('d', strtotime($dateFrom));
                                    $dateLimitTo = date('d', strtotime($dateTo));

                                    $selectedMonthFrom = date('m', strtotime($dateFrom));
                                    $selectedMonthTo = date('m', strtotime($dateTo));

                                    $selectedYearFrom = date('Y', strtotime($dateFrom));
                                    $selectedYearTo = date('Y', strtotime($dateTo));
                                    //print $selectedYearFrom.' '.$selectedYearTo;

                                    $i = 0;
                                    //for current month
                                    for ($j = $selectedYearFrom; $j <= $selectedYearTo; $j++) {
                                        if ($j == $selectedYearTo) {
                                            $selectedYearTo = $selectedYearTo;
                                            $dateLimitTo = $dateLimitTo;
                                        } else {
                                            $selectedMonthTo = 12;
                                            $dateLimitTo = 31;
                                        }

                                        if ($selectedYearFrom == $j) {
                                            $selectedMonthFrom = $selectedMonthFrom;
                                        } else {
                                            $selectedMonthFrom = 1;
                                        }

                                        $dateFrom = date(
                                            $j.'-'.$selectedMonthFrom.'-'.$dateLimitFrom,
                                            strtotime($dateFrom)
                                        );
                                        $dateTo = date($j.'-'.$selectedMonthTo.'-'.$dateLimitTo, strtotime($dateTo));

                                        //sold products
                                        $orders = DB::table('orders')
                                            ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                                            ->get();

                                        $totalSale = 0;
                                        foreach ($orders as $orders_data) {
                                            $orders_status = DB::table('orders_status_history')
                                                ->where('orders_id', '=', $orders_data->orders_id)
                                                ->orderby('date_added', 'DESC')->limit(1)->get();

                                            if ($orders_status[0]->orders_status_id != 3) {
                                                $totalSale++;
                                            }
                                        }

                                        //purchase products
                                        $products = DB::table('products')
                                            ->select(
                                                'products_quantity',
                                                DB::raw('SUM(products_quantity) as products_quantity')
                                            )
                                            ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                                            ->get();

                                        $saleData[$i]['date'] = date('Y', strtotime($dateFrom));
                                        $saleData[$i]['totalSale'] = $totalSale;

                                        if (empty($products[0]->products_quantity)) {
                                            $producQuantity = 0;
                                        } else {
                                            $producQuantity = $products[0]->products_quantity;
                                        }

                                        $saleData[$i]['productQuantity'] = $producQuantity;
                                        //$selectedYear++;
                                        //$selectedMonth++;
                                        $i++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        // return $reportBase;
        return $saleData;
    }
}
