<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;

class CourseController extends Controller
{
    //post
    public function CourseEnrollment(Request $request){
$request->validate([
"title"=>"required",
"description"=>"required",
"total_videos"=>"required"

]);
// craete course
$course=new Course();
$course->user_id=auth()->user()->id;
$course->title=$request->title;
$course->description=$request->description;
$course->total_videos=$request->total_videos;
$course->save();

// response
return response()->json([
'status'=>1,
'message'=>'course enrolled successfully'
],200);

    }
    //get
    public function TotalCourses(){
$id=auth()->user()->id;
$courses=User::find($id)->courses;

return response()->json([
'status'=>1,
'message'=>'total course enrolled',
'data'=>$courses
]);
    }
    //get
    public function DeleteCourse($id){
$user_id=auth()->user()->id;
if(Course::where([
    "id"=>$id,
    "user_id"=>$user_id
])->exists()){
    $course=Course::find($id);
    $course->delete();
    return response()->json([
        'status'=>1,
        'message'=>'course deleted successfully'
    ]);
}
else{
    return response()->json([
'status'=>0,
'message'=>'course did not found'
    ]);

}
    }
}
