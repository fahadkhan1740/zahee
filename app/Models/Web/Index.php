<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Index extends Model
{
    public function slides($currentDate)
    {
        return DB::table('sliders_images')
            ->leftJoin('image_categories', 'sliders_images.sliders_image', '=', 'image_categories.image_id')
            ->select(
                'sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'type',
                'sliders_title as title',
                'image_categories.path'
            )
            ->where('status', '=', '1')
            ->where('languages_id', '=', session('language_id'))
            ->get();
    }

    public function slidesByCarousel($currentDate, $carousel_id)
    {
        $indicator_count = 0;
        $indicator_output = '';
        return DB::table('sliders_images')
            ->leftJoin('image_categories', 'sliders_images.sliders_image', '=', 'image_categories.image_id')
            ->select(
                'sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'type',
                'sliders_title as title',
                'image_categories.path'
            )
            ->where('status', '=', 1)
            ->where('carousel_id', '=', $carousel_id)
            ->where('languages_id', '=', session('language_id'))
            ->groupBy('sliders_images.sliders_id')
            ->get();
    }

    public function compareCount()
    {
        return DB::table('compare')->where('customer_id', auth()->guard('customer')->user()->id)->count();
    }

    public function finalTheme()
    {
        return DB::table('current_theme')->first();
    }

    public function commonContent()
    {
        $languages = DB::table('languages')
            ->leftJoin('image_categories', 'languages.image', 'image_categories.image_id')
            ->select('languages.*', 'image_categories.path as image_path')
            ->where('languages.is_default', '1')
            ->get();
        $currency = DB::table('currencies')
            ->where('is_default', 1)
            ->where('is_current', 1)
            ->first();
        if (empty(Session::get('currency_id'))) {
            session(['currency_id' => $currency->id]);
        }
        if (empty(Session::get('currency_title'))) {
            session(['currency_title' => $currency->code]);
        }

        if (empty(Session::get('symbol_left'))) {
            session(['symbol_left' => $currency->symbol_left]);
        }

        if (empty(Session::get('symbol_right'))) {
            session(['symbol_right' => $currency->symbol_right]);
        }

        if (empty(Session::get('currency_code'))) {
            session(['currency_code' => $currency->code]);
        }

        if (empty(Session::get('language_id'))) {
            session(['language_id' => $languages[0]->languages_id]);
        }
        if (empty(Session::get('language_image'))) {
            session(['language_image' => $languages[0]->image_path]);
        }
        if (empty(Session::get('language_name'))) {
            session(['language_name' => $languages[0]->name]);
        }

        $result = array();

        $data = array();
        $categories = DB::table('news_categories')
            ->LeftJoin(
                'news_categories_description',
                'news_categories_description.categories_id',
                '=',
                'news_categories.categories_id'
            )
            ->select(
                'news_categories.categories_id as id',
                'news_categories.categories_image as image',
                'news_categories.news_categories_slug as slug',
                'news_categories_description.categories_name as name'
            )
            ->where('news_categories_description.language_id', '=', Session::get('language_id'))->get();

        if (count($categories) > 0) {
            foreach ($categories as $categories_data) {
                $categories_id = $categories_data->id;
                $news = DB::table('news_categories')
                    ->LeftJoin(
                        'news_to_news_categories',
                        'news_to_news_categories.categories_id',
                        '=',
                        'news_categories.categories_id'
                    )
                    ->LeftJoin('news', 'news.news_id', '=', 'news_to_news_categories.news_id')
                    ->select('news_categories.categories_id', DB::raw('COUNT(DISTINCT news.news_id) as total_news'))
                    ->where('news_categories.categories_id', '=', $categories_id)
                    ->get();

                $categories_data->total_news = $news[0]->total_news;
                $data[] = $categories_data;
            }
        }
        $result['newsCategories'] = $data;

        $myVar = new News();
        $data = array(
            'page_number' => 0, 'type' => '', 'is_feature' => '1', 'limit' => 5, 'categories_id' => '', 'load_news' => 0
        );
        $featuredNews = $myVar->getAllNews($data);
        $result['featuredNews'] = $featuredNews;
        $data = array('type' => 'header');
        // cart data
        $cart = $this->cart($data);
        $result['cart'] = $cart;
        // whishlist Data
        $wishlist = $this->wishlistCount($data);
        $result['wishlist_count'] = $wishlist;

        // Trend Data

        $trendImage = DB::table('trend_images')
            ->leftJoin('image_categories', 'trend_images.trend_image', '=', 'image_categories.image_id')
            ->select('trend_images.*', 'image_categories.path')
            ->where('trend_images.status', '1')
            ->where('trend_images.language_id', Session::get('language_id'))
            ->get();

        $result['trend_image'] = $trendImage;

        if (count($result['cart']) == 0) {
            session(['step' => '0']);
            session(['coupon' => array()]);
            session(['coupon_discount' => array()]);
            session(['billing_address' => array()]);
            session(['shipping_detail' => array()]);
            session(['payment_method' => array()]);
            session(['braintree_token' => array()]);
            session(['order_comments' => '']);
        }

        $result['setting'] = DB::table('settings')->get();

        //home banners

        $homeBanners = DB::table('constant_banners')
            ->leftJoin('image_categories', 'constant_banners.banners_image', '=', 'image_categories.image_id')
            ->select('constant_banners.*', 'image_categories.path')
            ->where('languages_id', 1)
            ->groupBy('constant_banners.banners_id')
            ->orderby('type', 'ASC')
            ->get();
        $result['homeBanners'] = $homeBanners;
        // dd(Session::get('language_id'));
        $result['pages'] = DB::table('pages')
            ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
            ->where([['type', '2'], ['status', '1'], ['pages_description.language_id', session('language_id')]])
            ->orwhere([
                ['type', '2'], ['status', '1'], ['pages_description.language_id', Session::get('language_id')]
            ])->orderBy('pages_description.name', 'ASC')->get();

        //produt categories
        $result['categories'] = $this->categories();
        return ($result);
    }

    private function getPages()
    {
        $result['pages'] = DB::table('pages')
            ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
            ->where([['type', '2'], ['status', '1'], ['pages_description.language_id', session('language_id')]])
            ->orwhere([
                ['type', '2'], ['status', '1'], ['pages_description.language_id', 1]
            ])->orderBy('pages_description.name', 'ASC')->get();
        return ($result);
    }

    private function categories()
    {
        $result = array();

        $categories = DB::table('categories')
            ->LeftJoin(
                'categories_description',
                'categories_description.categories_id',
                '=',
                'categories.categories_id'
            )
            ->leftJoin('image_categories', 'categories.categories_image', '=', 'image_categories.image_id')
            ->select(
                'categories.categories_id as id',
                'categories.categories_image as image',
                'categories.categories_icon as icon',
                'categories.sort_order as order',
                'categories.categories_slug as slug',
                'categories.parent_id',
                'categories_description.categories_name as name',
                'image_categories.path as path'
            )
            ->where('categories.categories_status', '=', 1)
            ->where('categories_description.language_id', '=', Session::get('language_id'))
            ->where('parent_id', '0')
            ->groupBy('categories.categories_id')
            ->get();

        $index = 0;
        foreach ($categories as $categories_data) {
            $categories_id = $categories_data->id;

            $products = DB::table('categories')
                ->LeftJoin('categories as sub_categories', 'sub_categories.parent_id', '=', 'categories.categories_id')
                ->LeftJoin(
                    'products_to_categories',
                    'products_to_categories.categories_id',
                    '=',
                    'sub_categories.categories_id'
                )
                ->LeftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
                ->select('categories.categories_id', DB::raw('COUNT(DISTINCT products.products_id) as total_products'))
                ->where('categories.categories_id', '=', $categories_id)
                ->get();

            $categories_data->total_products = $products[0]->total_products;
            $result[] = $categories_data;

            $sub_categories = DB::table('categories')
                ->LeftJoin(
                    'categories_description',
                    'categories_description.categories_id',
                    '=',
                    'categories.categories_id'
                )
                ->select(
                    'categories.categories_id as sub_id',
                    'categories.categories_image as sub_image',
                    'categories.categories_icon as sub_icon',
                    'categories.sort_order as sub_order',
                    'categories.categories_slug as sub_slug',
                    'categories.parent_id',
                    'categories_description.categories_name as sub_name'
                )
                ->where('categories_description.language_id', '=', Session::get('language_id'))
                ->where('parent_id', $categories_id)
                ->get();

            $data = array();
            $index2 = 0;
            foreach ($sub_categories as $sub_categories_data) {
                $sub_categories_id = $sub_categories_data->sub_id;

                $individual_products = DB::table('products_to_categories')
                    ->LeftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
                    ->select(
                        'products_to_categories.categories_id',
                        DB::raw('COUNT(DISTINCT products.products_id) as total_products')
                    )
                    ->where('products_to_categories.categories_id', '=', $sub_categories_id)
                    ->get();

                $sub_categories_data->total_products = $individual_products[0]->total_products;
                $data[$index2++] = $sub_categories_data;
            }

            $result[$index++]->sub_categories = $data;
        }
        return ($result);
    }

    public function cart($request)
    {
        $cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select(
                'customers_basket.*',
                'products.products_model as model',
                'image_categories.path as image',
                'products_description.products_name as products_name',
                'products.products_quantity as quantity',
                'products.products_price as price',
                'products.products_weight as weight',
                'products.products_weight_unit as unit'
            )->where(
                    'customers_basket.is_order',
                    '=',
                    '0'
                )->where('products_description.language_id', '=', Session::get('language_id'));

        if (empty(session('customers_id'))) {
            $cart->where('customers_basket.session_id', '=', Session::getId());
        } else {
            $cart->where('customers_basket.customers_id', '=', session('customers_id'));
        }

        $baskit = $cart->get();
        return ($baskit);
    }

    public function wishlistCount($request)
    {
        if (auth()->guard('customer')->check()) {
            $count = DB::table('liked_products')->where(
                'liked_customers_id',
                auth()->guard('customer')->user()->id
            )->count();
        } else {
            $count = 0;
        }
        return $count;
    }
}
