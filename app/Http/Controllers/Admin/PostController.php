<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::paginate(20);
    return view('admin.post.list', compact('posts'));
  }

  public function create()
  {
    $categories = Category::all();
    return view('admin.post.create', compact('categories'));
  }

  public function store(Request $request)
  {
    $this->validate($request,
      [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
        'image' => 'required',
        'category_id' => 'required',
      ]);

    $slug = Str::slug($request->title); //slug của title
    $originalSlug = $slug; //lưu lại biến ban đầu, dùng nếu cần thêm hậu tố

    $checkSlug = Post::where('slug', $slug)->first();

    while ($checkSlug) {
      $slug = $originalSlug . '-' . Str::random(3);
      $checkSlug = Post::where('slug', $slug)->first();
    }

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $name_file = $file->getClientOriginalName();// là phương thức có sẵn của file
      $extension = $file->getClientOriginalExtension();

      if (strcasecmp($extension, 'jpg') === 0 || //so sánh chuỗi extension với jpg
          strcasecmp($extension, 'png') === 0 ||
          strcasecmp($extension, 'jepg') === 0) {
        $image = Str::random(5) . '_' . $name_file;
        while (file_exists('image/post/' . $image)) {
          $image = Str::random(5) . '_' . $name_file;
        }
        $file->move('image/post', $image);
      }
    }
    Post::create([
      'title' => $request->title,
      'description' => $request->description,
      'content' => $request->content,
      'image' => $image,
      'view_counts' => 0,
      'user_id' => 1,  // Auth::id()
      'new_post' => $request->new_post ? 1 : 0,
      'slug' => $slug,
      'category_id' => $request->category_id,
      'highlight_post' => $request->highlight_post ? 1 : 0,
    ]);
    return redirect()->route('admin.post.index')->with('success', 'create successfully');
  }

  public function edit($id)
  {
    $post = Post::find($id);
    $categories = Category::all();

    return view('admin.post.edit', compact('post', 'categories'));
  }

  public function update(Request $request, $id)
  {
    $this->validate($request,
      [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
        'category_id' => 'required',
      ]);

    $slug = Str::slug($request->title);
    $originalSlug = $slug;

    $checkSlug = Post::where('slug', $slug)
      ->where('id', '!=', $id)
      ->first();

    while ($checkSlug) {
      $slug = $originalSlug . '-' . Str::random(3);
      $checkSlug = Post::where('slug', $slug)
        ->where('id', '!=', $id)
        ->first();
    }

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $name_file = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();

      if (strcasecmp($extension, 'jpg') === 0 ||
          strcasecmp($extension, 'png') === 0 ||
          strcasecmp($extension, 'jpeg') === 0) {
        $image = Str::random(5) . '_' . $name_file;
        while (file_exists('image/post/' . $image)) {
          $image = Str::random(5) . '_' . $name_file;
        }
        $file->move('image/post', $image);
      }
    }
    $post = Post::find($id);
    $post->update([
      'title' => $request->title,
      'description' => $request->description,
      'content' => $request->content,
      'image' => isset($image) ? $image : $post->image,
      'new_post' => $request->new_post ? 1 : 0,
      'slug' => $slug,
      'category_id' => $request->category_id,
      'highlight_post' => $request->highlight_post ? 1 : 0,
    ]);

    return redirect()->route('admin.post.edit', $id)->with('success', 'update successfully');
  }

  public function delete($id)
  {
    Post::find($id)->delete();
    return redirect()->route('admin.post.index', $id)->with('success', 'delete successfully');
  }
}
