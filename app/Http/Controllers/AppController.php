<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 
use App\Models\Media; 

class AppController extends Controller
{
    /* Blog home page */
    public function index(){
    	return view('welcome');
    } 

    /* contact page */
    /** view contact **/
    public function contact(){
    	return view('contact');
    }
    /** send contact **/
    public function sendContact(Request $msg){ 

        $this->validate($msg,[
            "email"     => "email|required|max:100",
            "name"      => "string|required|max:100",
            "service"   => "required",
            "message"   => "required|min:10",
            "cv"        => "mimes:pdf"
        ]);
        
        /* upload file cv (pdf) */

        if (!empty($msg->file('cv'))) {
            $pdf = $msg->file('cv');
            $dir = 'upload/'.date('Y/m/d/');
            $filename = md5($pdf->getClientOriginalName()).time();  
            $urlFilename = $filename.'.pdf';  
            \File::isDirectory($dir) or \File::makeDirectory($dir,0777,true,true); 
            $pdf->move($dir,$urlFilename);

            $media          = new Media;
            $media->title   = $msg->input('name');
            $media->by      = null;
            $media->size    = $pdf->getClientSize();//oct 
            $media->url     = $dir.$urlFilename; 
            $media->type    = 'pdf'; 
            $media->save(); 
        }

        /*end upload cv*/

    	$contact 			= new Contact;
    	$contact->email 	= $msg->input('email');
    	$contact->name 		= $msg->input('name');
    	$contact->service 	= $msg->input('service');
        $contact->message   = $msg->input('message'); 
        if(!empty($media->id)){
        $contact->file      = $media->id; 
        }
    	$contact->save();


        $alert['class'] = "success";
        $alert['title'] = "Done";
        $alert['msg'] = "your message successfully sended !";
        \Session::flash('alert',(object)$alert);
        return redirect()->back();
    }
}
