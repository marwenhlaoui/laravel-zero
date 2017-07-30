<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $services = Service::orderBy('id','desc')->paginate(2);
        return view('admin.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "title"=>"required|unique:service|max:100",
            "description"=>"max:255",
            "access"=>"required"
        ]);

        $description = (!empty($request->input('description'))) ? $request->input('description'): "" ;

        $service = new Service;
        $service->title = $request->input('title');
        $service->description = $description;
        $service->access = json_encode($request->access);
        $service->save();  
        $alert['class'] = "success";
        $alert['title'] = "Done";
        $alert['msg'] = "Service $service->title successfully created !";
        \Session::flash('alert',(object)$alert);
        return redirect()->route('admin.service.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('admin.service.show',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit',compact('service'));
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
        $this->validate($request,[
            "title"=>["required","max:100",Rule::unique('service')->ignore($id)],
            "description"=>"max:255",
            "access"=>"required"
        ]);

        $description = (!empty($request->input('description'))) ? $request->input('description'): "" ;

        $service = Service::find($id);
        $service->title = $request->input('title');
        $service->description = $description;
        $service->access = json_encode($request->access);
        $service->save(); 

        \DB::table('service_user')->where('service',$service->id)->delete();
 
        if (!empty($request->users)) {
            foreach ($request->users as $key => $userId) {
                \DB::table('service_user')->insert([
                    "user"=>$userId,
                    "service"=>$service->id
                ]);
            }
        }


        $alert['class'] = "success";
        $alert['title'] = "Done";
        $alert['msg'] = "Service $service->title successfully created !";

        \Session::flash('alert',(object)$alert);
        return redirect()->route('admin.service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $service = Service::find($id);
        if(!empty($service->id)){ 
            \DB::table('service_user')->where('service',$id)->delete();
            $service->delete();
            $alert['class'] = "success";
            $alert['title'] = "Done";
            $alert['msg'] = "Service <b>$service->title</b> successfully deleted! "; 
        }else{ 
            $alert['class'] = "danger";
            $alert['title'] = "Sorry";
            $alert['msg'] = "Service not found !";
        }
        \Session::flash('alert',(object)$alert);
        return redirect()->route('admin.service.index');
    }
}
