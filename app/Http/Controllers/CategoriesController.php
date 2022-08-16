<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\GeneralTraits;
class CategoriesController extends Controller
{
    use GeneralTraits;
    //

    public function getall(){
        $cat=Category::get();
        return response()->json($cat);
    }
    public function index(){
        $cat=Category::select('id','name_'.app()->getLocale() .' as name')->get();
        return response()->json($cat);
    }
    public function getCategoryById(Request $req){
        $category = Category::all()->find($req -> id);
        if (!$category)
            return $this->returnError('001', 'هذا القسم غير موجد');

        return $this->returnData('categroy', $category);
    }
    public function changeStatus(Request $request){
        Category::where('id',$request -> id) -> update(['active' =>$request ->  active]);

        return $this -> returnSuccessMessage('تم تغيير الحاله بنجاح');
    }
}
