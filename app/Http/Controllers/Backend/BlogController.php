<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryList()
    {
        $data['categories'] = BlogCategory::latest()->get();
        return view('admin.blog.category.list',compact('data'));
    }
    
    public function categoryCreate()
    {
        return view('admin.blog.category.create');
    }

    public function categoryStore(Request $request)
    {
        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ','-',$request->blog_category_name)),
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Category Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.category.list')->with($notification);
    }

    public function categoryEdit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit',compact('category'));
    }
    
    public function categoryUpdate(Request $request, $id)
    {
        BlogCategory::findOrFail($id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ','-',$request->blog_category_name)),
            'status' => isset($request->status)?"1":"0",
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Category Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.category.list')->with($notification);
    }

    public function categoryDelete($id)
    {
        $blog = Blog::where('category_id',$id)->get();
        if (empty($blog)) {
            BlogCategory::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Category Deleted',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification = [
                'message' => 'Cannot Delete Parent Category',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function index()
    {
        $data['post'] = Blog::latest()->get();
        return view('admin.blog.post.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = BlogCategory::where('status',1)->latest()->get();
        return view('admin.blog.post.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1103,906)->save('upload/blog_images/'.$name_gen);
        $save_url = 'upload/blog_images/'.$name_gen;
        Blog::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
            'post_image' => $save_url,
            'post_short_desc' => $request->post_short_desc,
            'post_long_desc' => $request->post_long_desc,
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.post.list')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = BlogCategory::where('status',1)->latest()->get();
        $data['blog'] = Blog::findOrFail($id);
        return view('admin.blog.post.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $old_image = $request->old_image;
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1103,906)->save('upload/blog_images/'.$name_gen);
            $save_url = 'upload/blog_images/'.$name_gen;
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            Blog::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
                'post_image' => $save_url,
                'post_short_desc' => $request->post_short_desc,
                'post_long_desc' => $request->post_long_desc,
                'status' => isset($request->status)?"1":"0",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Updated',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.post.list')->with($notification);
        }else{
            Blog::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
                'post_short_desc' => $request->post_short_desc,
                'post_long_desc' => $request->post_long_desc,
                'status' => isset($request->status)?"1":"0",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Updated',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.post.list')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $img = $blog->post_image;
        unlink($img);

        Blog::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function Blog()
    {
        $data['category'] = BlogCategory::where('status',1)->latest()->get();
        $data['post'] = Blog::where('status',1)->latest()->get();
        return view('user.blog.home_blog',compact('data'));
    }

    public function BlogGrid()
    {
        $data['category'] = BlogCategory::where('status',1)->latest()->get();
        $data['post'] = Blog::where('status',1)->latest()->get();
        return view('user.blog.home_blog_grid',compact('data'));
    }

    public function BlogCategoryGrid(Request $reques, $slug, $id)
    {
        $data['blog'] = Blog::where('category_id',$id)->where('status',1)->get();
        $data['category'] = BlogCategory::where('id',$id)->first();
        return view('user.blog.category_blog',compact('data'));
    }

    public function blogRead(Request $request, $slug, $id)
    {
        $data['category'] = BlogCategory::where('status',1)->latest()->get();
        $data['blog'] = Blog::findOrFail($id);
        return view('user.blog.detail',compact('data'));
    }
}
