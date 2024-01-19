<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Candidate;
use DB;
use Session;
class CompanyController extends Controller
{
    public function index(){
        return view('companylist');
    }

    public function companylistdata(Request $request){
        $columns=[
            0=>"id",
            1=>"logo",
            2=>"company_name",
            3=>"count",
            4=>"action"
        ];
        $filter_keyword = $request->get('filter_keyword');
        $course_filter = $request->get('course_filter');
        $category_filter = $request->get('category_filter');
        $priority_filter = $request->get('priority_filter');
        $location_filter = $request->get('location_filter');

        
        
        
        $recordsTotal=Company::count();
        $recordsFiltered=$recordsTotal;
        $limit=$request->input('length');
        $start=$request->input('start');
        $order=$columns[$request->input('order.0.column')];
        $dir=$request->input('order.0.dir');
        if(!empty($request->input('search.value'))){
            $search=$request->input('search.value');
            $results =  Company::where('id','LIKE',"%{$search}%")
                        ->orWhere('company_name', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
            


        }else{
            //$results=Usermanagment::offset($start);
            $results=DB::table('companies as company');
            $results=$results->select('company.*');
            // $results=$results->join('courses as course','course.id','=','key.course_id');
            // $results=$results->join('priorities as priority','priority.id','=','key.priority');
            // $results=$results->join('categories as category','category.id','=','key.category');
            // $results=$results->join('usermanagments as user','user.id','=','key.executive');
            $results=$results->limit($limit);
            /*if(!empty($filter_keyword)){
                $results=$results->where('key.id',$filter_keyword);
            }*/
            
            
            $results=$results->orderBy($order,$dir);
            $results=$results->get();
        }

        $data=[];
        if(!empty($results)){
            foreach($results as $key => $result){

                $key=$key+1;
                $companycount=Candidate::where('company_id',$result->id)->count();

                $copy=basepath("admin/images/copyicon1.svg");
                $delete=basepath("images/document/deleteicon1.svg");
                $edit=basepath("images/document/editicon1.svg");

                $logo=basepath('company/').$result->logo;
                $logo="<img src='$logo' style='max-width:95px; height:22px'>";
                
                $action="<span><a data-bs-toggle='modal' data-bs-target='#companyeditformpopup' class='me-2 editcompany_' data-id='$result->id' data-name='$result->company_name'><img src='$edit' class='img-fluid ' alt='editicon' title='Edit' /></a><a href='' class='deletecompany' data-cid='$result->id' data-table='companies'><img src='$delete' class='img-fluid' title='Delete' alt='deleteicon'/></a></span>";
                if(Session::get('role')=='user'){
                    //$action="<span><a data-bs-toggle='modal' data-bs-target='#companyeditformpopup' class='me-2 editcompany_' data-id='$result->id' data-name='$result->company_name'><img src='$edit' class='img-fluid ' alt='editicon' title='Edit' /></a></span>";
                    $action='Not Allowed';
                    
                }
                $company_name="<span>".$result->company_name."</span>";

                $record['id']=$key;
                $record['logo']=$logo;
                $record['company_name']=$company_name;
                $record['count']=$companycount;
                $record['action']=$action;
                $data[]=$record;
            }
        }

        $json_data=[
            "draw"=>intval($request->input('draw')),
            "recordsTotal"=>intval($recordsTotal),
            "recordsFiltered"=>intval($recordsFiltered),
            "data"=>$data
        ];
        return json_encode($json_data);
        return view('companylistdata');
    }



    public function add(Request $request){
        if($file=$request->has('logo')){
            $file=$request->file('logo');
            $logo=time().'-'.$file->getClientOriginalName();
            $file->move(public_path('/company'),$logo);
        }
        $data=new Company;
        $data->company_name=$request->input('company_name');
        if(!empty($logo)){
            $data->logo=$logo;
        }
        $data=$data->save();
        if($data){
            return back()->with('msg',"Company Add Successfully");
        }else{
            return back()->with('msg',"Some Error");
        }

    }



    public function update(Request $request){
        $id=$request->input('edit_company_id');
        if($file=$request->has('logo')){
            $file=$request->file('logo');
            $logo=time().'-'.$file->getClientOriginalName();
            $file->move(public_path('/company'),$logo);
        }
        $data=Company::find($id);
        $data->company_name=$request->input('comapny_name');
        if(!empty($logo)){
            $data->logo=$logo;
        }
        $data=$data->save();
        return redirect('all-company')->with('msg',"Update Successfully");
    }


    public function delete(Request $request){
        $id=$request->input('id');
        $table=$request->input('table');
        if($table=='companies'){
            $data=DB::table('candidates')->where('company_id',$id)->first();
            if(!empty($data)){
                return "Please delete student first";
            }
        }
        $data=DB::table($table)->where('id',$id)->delete();
        return "Deleet Successfully";
    }
}
