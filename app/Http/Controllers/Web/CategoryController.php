<?php


namespace App\Http\Controllers\Web;

use App\Models\AppModels\Category;
use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency,
        Category $category
    )
    {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->category = $category;
        $this->theme = new ThemeController();
    }

    public function getAllCategories(Request $request) {
        $title = array('pageTitle' => Lang::get("website.All Categories"));
        $final_theme = $this->theme->theme();

        $language_id = $request->session()->get('language_id');
        $result['categoryArray'] = $this->category->getMainCategories($language_id);

        $result['commonContent'] = $this->index->commonContent();

        return view("web.category",['title' => $title,'final_theme' => $final_theme])->with(['result' => $result]);
    }

}
