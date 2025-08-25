<?php

namespace App\Http\Controllers;

use App\Http\Trait\SiteOption;
use App\Models\Option;
use Illuminate\Http\Request;

class PageController extends Controller
{

    use SiteOption;

    public function __construct(
        protected array $data = []
    ){
        $this->data['siteTitle'] = SiteOption::siteTitle();
    }
    
    public function index()
    {
        $this->data['pageTitle'] = "Home";
        return view('frontend.pages.index', $this->data);
    }
}
