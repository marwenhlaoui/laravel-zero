<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 

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
    	dd($msg->all());
 

    	$contact 			= new Contact;
    	$contact->email 	= $msg->input('email');
    	$contact->name 		= $msg->input('name');
    	$contact->service 	= $msg->input('service');
    	$contact->message 	= $msg->input('message'); 
    	$contact->save();
    }
}
