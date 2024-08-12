<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\BlogCategory; 
use Carbon\Carbon;
use App\Models\BlogPost; 
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class BlogController extends Controller
{
    public function AllBlogCategory()
    {
        $category = BlogCategory::latest()->get();
        return view('backend.category.blog_category', compact('category'));
    } // End Method 

    public function StoreBlogCategory(Request $request)
    { 
        BlogCategory::create([ 
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),  
        ]);

        $notification = array(
            'message' => 'BlogCategory Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);
    }// End Method 

    public function EditBlogCategory($id)
    {
        $categories = BlogCategory::findOrFail($id);
        return response()->json($categories);
    }// End Method 

    public function AllPost()
    {
        $post = BlogPost::latest()->get();
        return view('backend.post.all_post', compact('post'));
    }// End Method 

    public function AddPost()
    {
        $blogcat = BlogCategory::latest()->get();
        return view('backend.post.add_post', compact('blogcat'));
    }// End Method

    public function StorePost(Request $request)
    {
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('upload/post/'.$name_gen);

        // Resize image using native PHP functions
        $this->resizeImage($image->getRealPath(), $destinationPath, 370, 250);

        BlogPost::create([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)), 
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'post_image' => 'upload/post/'.$name_gen, 
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'BlogPost Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.post')->with($notification);
    }// End Method 

    public function EditPost($id)
    {
        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::findOrFail($id);
        return view('backend.post.edit_post', compact('post', 'blogcat'));
    }// End Method

    public function UpdatePost(Request $request)
    {
        $post_id = $request->id;

        $updateData = [
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)), 
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags, 
            'created_at' => Carbon::now(),
        ];

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('upload/post/'.$name_gen);

            // Resize image using native PHP functions
            $this->resizeImage($image->getRealPath(), $destinationPath, 370, 250);

            $updateData['post_image'] = 'upload/post/'.$name_gen;
        }

        BlogPost::findOrFail($post_id)->update($updateData);

        $notification = array(
            'message' => 'BlogPost Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.post')->with($notification);
    }// End Method 

    public function DeletePost($id)
    {
        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;

        if (file_exists(public_path($img))) {
            unlink(public_path($img));
        }

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BlogPost Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method

    private function resizeImage($sourcePath, $destinationPath, $width, $height)
    {
        list($originalWidth, $originalHeight) = getimagesize($sourcePath);
    
        // Create the directory if it doesn't exist
        $directory = dirname($destinationPath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    
        $image = imagecreatefromstring(file_get_contents($sourcePath));
        $resizedImage = imagecreatetruecolor($width, $height);
    
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
    
        // Save the resized image to the destination path
        imagejpeg($resizedImage, $destinationPath, 90);
    
        imagedestroy($image);
        imagedestroy($resizedImage);
    }
    public function BlogDetails($slug)
    {
        $blog = BlogPost::where('post_slug', $slug)->first();
    
        if (!$blog) {
            // Handle the case where the blog post is not found
            abort(404, 'Blog post not found');
        }
    
        $tags = $blog->post_tags;
        $tags_all = explode(',', $tags);
    
        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();
    
        return view('frontend.blog.blog_details', compact('blog', 'tags_all', 'bcategory', 'dpost'));
    }
    





    public function BlogCatList($id){

        $blog = BlogPost::where('blogcat_id',$id)->get();
        $breadcat = BlogCategory::where('id',$id)->first();
        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_cat_list', compact('blog','breadcat','bcategory','dpost'));

    }// End Method
    public function BlogList(){

        $blog = BlogPost::latest()->get(); 
        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_list', compact('blog','bcategory','dpost'));


    }// End Method
    public function StoreComment(Request $request){

        $pid = $request->post_id;

        Comment::insert([
            'user_id' => Auth::user()->id,
            'post_id' => $pid,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

          $notification = array(
            'message' => 'Comment Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method
    public function AdminBlogComment(){

        $comment = Comment::where('parent_id',null)->latest()->get();
        return view('backend.comment.comment_all',compact('comment'));

    }// End Method
    public function AdminCommentReply($id){

        $comment = Comment::where('id',$id)->first();
        return view('backend.comment.reply_comment',compact('comment'));

    }// End Method

    public function ReplyMessage(Request $request){

        $id = $request->id;
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        Comment::insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

          $notification = array(
            'message' => 'Reply Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method
}