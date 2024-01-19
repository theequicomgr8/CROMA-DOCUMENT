<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Documentupload;
use DB;
use Mail;
use Session;
class CandidateController extends Controller
{
    
    public function index(){
            // $dat=["email"=>"cromacampus.suman@gmail.com"]; //send data to view
            // $input['email'] = "cromacampus.suman@gmail.com";
            // $input['name'] = "Document Portal";
            // \Mail::send('sendmail', $dat, function($message) use($input){
            //     $message->to($input['email'], $input['name'])
            //         ->subject("\xE2\x9A\xA0 Alert!! Someone Login to Document Application.");
            // });
            
        $candidatecount=Candidate::count();
        $compines=Company::where('status','1')->get();
        return view('candidate',compact('candidatecount','compines'));
    }

    public function getdata(Request $request){
        $columns=[
            0=>"id",
            1=>"date",
            2=>"name",
            3=>"count",
            4=>"company_name",
            5=>"action",
            6=>"remark"
        ];
        $filter_company_name = $request->get('filter_company_name');
        $from_filter = $request->get('from_filter');
        $to_filter = $request->get('to_filter');
        
        $recordsTotal=Candidate::count();
        $recordsFiltered=$recordsTotal;
        $limit=$request->input('length');
        $start=$request->input('start');
        
        $order=$columns[$request->input('order.0.column')];
        $dir=$request->input('order.0.dir');
        if(!empty($request->input('search.value'))){
           /* $search=$request->input('search.value');
            $results =  Candidate::where('id','LIKE',"%{$search}%")
                        ->orWhere('name', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();*/
                        
            $search=$request->input('search.value');
            $results =  Candidate::where('id','LIKE',"%{$search}%");
            $results=$results->orWhere('name', 'LIKE',"%{$search}%");
            if(!empty($filter_company_name)){
                $results=$results->where('company_id',$filter_company_name);
            }
            $results=$results->offset($start);
            $results=$results->limit($limit);
            $results=$results->orderBy($order,$dir);
            $results=$results->get();
            


        }else{
            //$results=Usermanagment::offset($start);
            $results=DB::table('candidates as candidate');
            $results=$results->select('candidate.*');
            $results=$results->offset($start);
            $results=$results->limit($limit);
            if(!empty($filter_company_name)){
                $results=$results->where('candidate.company_id',$filter_company_name);
            }

            if(!empty($from_filter) && !empty($to_filter)){
                $from_filter=date('Y/m/d',strtotime($from_filter));
                $to_filter=date('Y/m/d',strtotime($to_filter));
                $results=$results->whereDate('candidate.created_at','>=',$from_filter);
                $results=$results->whereDate('candidate.created_at','<=',$to_filter);
            }
            
            
            $results=$results->orderBy($order,$dir);
            // $results=$results->orderBy('id','desc');
            $results=$results->get();
        }

        $data=[];
        if(!empty($results)){
            foreach($results as $key => $result){
                $sr=$key+1;
                $getcompany=Company::where('id',$result->company_id)->first();
                $company_name=$getcompany->company_name ?? '';
                
                $gettotal=Documentupload::where('candidates_id',$result->id)->count();
                
                 $add=basepath("images/document/addicon1.svg");
                $delete=basepath("images/document/deleteicon1.svg");
                $edit=basepath("images/document/editicon1.svg");
                
                $action="<span><a data-bs-toggle='modal' data-bs-target='#cadidatnameeditpopup' class='me-2 nameupdate' data-cname='$result->name' data-cid='$result->id'><img src='$edit' class='img-fluid' alt='editicon' title='Edit'/></a><a href='' class='me-2 deletecompany_' data-cid='$result->id' data-table='candidates'><img src='$delete' class='img-fluid' alt='deleteicon' title='Delete'/></a><a data-bs-toggle='modal' data-bs-target='#documentomodel' class='addcondidate' candidate-id='$result->id'><img src='$add' class='img-fluid' alt='addicon' title='Add'/></a></span>";
                if((Session::get('role')=='user')){
                    $action="<span><a data-bs-toggle='modal' data-bs-target='#cadidatnameeditpopup' class='me-2 nameupdate' data-cname='$result->name' data-cid='$result->id'><img src='$edit' class='img-fluid' alt='editicon' title='Edit'/></a><a data-bs-toggle='modal' data-bs-target='#documentomodel' class='addcondidate' candidate-id='$result->id'><img src='$add' class='img-fluid' alt='addicon' title='Add'/></a></span>";
                }
                $remark_text=$result->remark;
                $fullremark=$result->remark;
                $remark_text=substr($remark_text,0,31);
                $remark="<div class='main'><span class='me-3' title='$fullremark' style='width:190px;'> $remark_text ...</span><a data-bs-toggle='modal' data-bs-target='#remarkeditstudentpopup' class='me-2 candidateremarkedit' data-eid='$result->id' data-remartk='$result->remark'><img src='$edit' class='img-fluid ' alt='editicon'title='Edit' /></a></div>";


                $name="<span class='showdocument' data-id='$result->id' data-name='$result->name'>".$result->name."</span>";

                $record['id']=$sr;
                $record['date']="<span>".date("d-M-Y", strtotime($result->created_at))."</span>";
                $record['name']="<span data-bs-toggle='modal' data-bs-target='#candidatedocumentspopup' data-id='$result->id' class='datacandidate'>".$name."</span>";
                $record['count']="<span>$gettotal</span>";
                $record['company_name']=$company_name;
                $record['action']=$action;
                $record['remark']=$remark;
                $data[]=$record;
                
                
                // $record['id']=$sr;
                // $record['date']="";
                // $record['name']="$result->name";
                // $record['count']="";
                // $record['company_name']="";
                // $record['action']="";
                // $record['remark']="";
                // $data[]=$record;
            }
        }

        $json_data=[
            "draw"=>intval($request->input('draw')),
            "recordsTotal"=>intval($recordsTotal),
            "recordsFiltered"=>intval($recordsFiltered),
            "data"=>$data
        ];
        return json_encode($json_data);

        // return view('candidatedata');
    }



    public function candidatesave(Request $request){
        $data=new Candidate;
        $data->company_id=$request->input('company');
        $data->name=$request->input('name');
        $data->remark='';
        $data=$data->save();
        if($data){
            return redirect('all-condidate')->with('msg','User Add Successfully');
        }

    }



    public function documentupload(Request $request){
        /*if($file=$request->has('docfile')){
            $file=$request->file('docfile');
            $docfile=time().'-'.$file->getClientOriginalName();
            $file->move(public_path('/document'),$docfile);
        }
        $data=new Documentupload;
        $data->candidates_id=$request->input('candidate_id');
        if(!empty($docfile)){
            $data->docfile=$docfile;
        }
        $data=$data->save();*/
        if($files=$request->file('docfile')){
            foreach($files as $key => $file){
                $name=time() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/document/', $name);
                $images['docfile']=$name;
                $images['candidates_id']=$request->input('candidate_id');
                $data=DB::table('documentuploads')->insert($images);
            }
        }
        
        if($data){
            return redirect('all-condidate')->with('msg','Upload Successfully');
        }
    }



    public function showdocument(Request $request){
        $id=$request->input('id');
        $data=Documentupload::where('candidates_id',$id)->get();
        $output='';
        foreach($data as $value){
            $path=basepath('document/').$value->docfile;
            
            $output.='<div class="student-document">';
            $output.='<img src="https://document.cromacampus.com/public/images/document/pdficon.svg" alt="pdficon">';
            $output.='<h3>'.$value->docfile.'</h3>';
            $output.='<div class="list-document ms-auto">';
            $output.='<ul>';
            $output.='<li><a href=""><img src="https://document.cromacampus.com/public/images/document/docu-st-calandericon.svg" alt="calandericon" title="'.$value->created_at.'"></a></li>';
            $output.='<li><a href="'.$path.'" target="_blank"><img src="https://document.cromacampus.com/public/images/document/docu-st-viewicon.svg" alt="viewicon"></a></li>';
            $output.='<li><a href="" class="deletecompany" data-cid="'.$value->id.'" data-table="documentuploads"><img src="https://document.cromacampus.com/public/images/document/docu-st-closeicon.svg" alt="closeicon"></a></li>';
            $output.='</ul>';
            $output.='</div>';
            $output.='</div>';
        }
        echo $output;
    }

    public function remarkupdate(Request $request){
        $id=$request->input('getid');
        $remark=$request->input('remark');
        $data=Candidate::find($id);
        $data->remark=$request->input('remark') ?? '';
        $data=$data->save();
        if($data){
            return redirect('all-condidate')->with('msg','Remark Update Successfully');
        }
    }


    public function nameupdate(Request $request){
        $id=$request->input('getid');
        $name=$request->input('name');
        $data=Candidate::find($id);
        $data->name=$request->input('name') ?? '';
        $data=$data->save();
        if($data){
            return redirect('all-condidate')->with('msg','Name Update Successfully');
        }
    }
    
    public function totalcount(Request $request){
        if($request->input('company')!='' || $request->input('form')!='' || $request->input('to')!=''){
            $candidatecount=Candidate::where('status','1');
            if($request->input('company')!=''){
                $candidatecount=$candidatecount->where('company_id',$request->input('company'));
            }
            if($request->input('from')!='' && $request->input('to')!=''){
                //dd($request->input('to'));
                //$from_filter=date('Y-m-d',strtotime($request->input('from')));
                //$to_filter=date('Y-m-d',strtotime($request->input('to')));
                $candidatecount=$candidatecount->whereDate('created_at','>=',$request->input('from'));
                $candidatecount=$candidatecount->whereDate('created_at','<=',$request->input('to'));
            }
            $candidatecount=$candidatecount->count();
        }
        else{
            $candidatecount=Candidate::count();
        }
        
        
        
        
        /*if($request->input('company')!=''){
           $candidatecount=Candidate::where('company_id',$request->input('company'))->count(); 
        }else{
            $candidatecount=Candidate::count();
        }*/
        
        
        return $candidatecount;
    }
}
