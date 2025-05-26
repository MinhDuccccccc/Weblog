<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
      $categories = Category::all();
       return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
          'name'=>'required'
        ]
        );

          $slug = Str::slug($request->name);

          $checkSlug = Category::where('slug', $slug)-> first();

          while($checkSlug){
              $slug = Str::slug($request->name) . '-' . Str::random(3); // thêm hậu tố
              $checkSlug = Category::where('slug', $slug)->first(); // kiểm tra lại
          }

        Category::create([
          'name' => $request->name,
          'slug' => $slug
        ]);

        return redirect()->route('admin.category.index')->with('success', 'create successfully');

    }

    public function edit($id) // được gọi khi ấn button edit
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,
      [
        'name' => 'required'
      ]);

      // Tạo slug từ tên
      $slug = Str::slug($request->name);

      // Kiểm tra xem slug có bị trùng với bản ghi khác không
      $checkSlug = Category::where('slug', $slug)
                          ->where('id', '!=', $id) // trừ chính nó ra
                          ->first();

      if ($checkSlug) {
          // Nếu slug đã tồn tại, trả về với lỗi
          return redirect()->back()
                          ->withInput()
                          ->withErrors(['name' => 'Tên này đã tồn tại, vui lòng nhập tên khác.']);
      }

      // Nếu không trùng, thì update
      Category::where('id', $id)->update([
          'name' => $request->name,
          'slug' => $slug
      ]);

      return redirect()->route('admin.category.edit', $id)->with('success', 'Cập nhật thành công');
    }

    public function delete($id)
    {
      Category::where('id',$id)->delete();
      return redirect()-> route('admin.category.index', $id)->with('success', 'delete successfully');
    }
}
