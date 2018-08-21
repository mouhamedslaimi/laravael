<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cv;
use App\Experience;
use App\Http\Requests\cvRequest;
use Auth;
use Illuminate\Http\UploadedFile;
class CvController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //lister les cvs
    public function index()
    {
        // $listcv =Cv::where('user_id',Auth::user()->id)->get();
        if(Auth::user()->is_admin)
        $listcv = Cv::all();
        else
        $listcv = Auth::user()->cvs;
        return view('cv.index',['cvs'=> $listcv]);
    }
    //afficher le formulaire de creation d'un cv
    public function create()
    {
        return view('cv.create');
    }
    //enregistrer un cv 
    public function store(cvRequest $request)
    {
        $cv = new Cv();
        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        $cv->user_id = Auth::user()->id;
        //if($request>hasFile('photo')){
            $cv->photo  =   $request->photo->store('image');
       // }
        $cv->save();
        session()->flash('success','la cv à été bien enregistré !!');
        return redirect('cvs');
    }
    //permet de récuiperer un cv puis le mettre dans un formulaire
    public function edit($id)
    {
        $cv = Cv::find($id);
        $this->authorize('update',$cv);
        return view('cv.edit',['cv'=>$cv]);
    }
    public function update(cvRequest $request,$id)
    {
        $cv = Cv::find($id);
        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        $cv->photo  =   $request->photo->store('image');
        $cv->save();
        return redirect('cvs');
    }
    public function destroy(Request $request,$id)
    {
        $cv = Cv::find($id);
        $this->authorize('delete',$cv);
        $cv->delete();
        return redirect('cvs');
    }
    public function show($id)
    {
        return view('cv.show',['id => $id']);
    }
     public function getExperiences ($id){
    $cv = Cv::find($id);
    return $cv->experiences;
    }
    public function addExperience(Request $request)
    {

    $experience = new Experience();
    $experience->body = $request->titre;
    $experience->body = $request->body;
    $experience->debut = $request->debut;
    $experience->fin = $request->fin;
    $experience->cv_id = $request->cv_id;
    $experience->save();
    return Response()->json(['etat'=>true,'id' => $experience->id]);


    }


}
