<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Image;
use OrionMedical\Models\AttachDocuments;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Response;
use Carbon\carbon;
use Auth;


class ImageController extends Controller
{
    public function postUpload(Request $request)
    {

         try
        {
        

        $image = new Image();
        $this->validate($request, [
            'image' => 'required',
            'filename' => 'required'
        ]);

       // dd(Input::get('selectedid'));
    
        $image->accountnumber=Input::get('selectedid');
        $image->filename = Input::get('filename');

        if($request->hasFile('image')) {
            $file = Input::file('image');

            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
           
            $name = $timestamp. '-' .$file->getClientOriginalName();
           
            $image->filePath = $name;
            $image->created_by=Auth::user()->getNameOrUsername();
           $file = $file->move(public_path().'/uploads/images', $name);
            //Image::make($image->getRealPath())->resize(200, 200)->save($name); 
        }

        $image->save();
        return redirect()
            ->route('claims')
            ->with('info','Document has successfully been uploaded!');
        }

    catch (\Exception $e) {
           
           echo $e->getMessage();
            // return redirect()
            // ->route('account.manage')
            // ->with('info','No document was added!',$e->getMessage());
        }
    }


    public function postUploadDocuments(Request $request)
    {

         try
        {
        

        $image = new AttachDocuments();
        $this->validate($request, [
            'image' => 'required',
            'filename' => 'required'
        ]);

       // dd(Input::get('selectedid'));
    
        $image->owner_id=Input::get('selectedid');
        $image->filename = Input::get('filename');

        if($request->hasFile('image')) {
            $file = Input::file('image');

            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
           
            $name = $timestamp. '-' .$file->getClientOriginalName();
           
            $image->filePath = $name;
            $image->created_by=Auth::user()->getNameOrUsername();
           $file = $file->move(public_path().'/uploads/images', $name);
            //Image::make($image->getRealPath())->resize(200, 200)->save($name); 
        }

        $image->save();
        return redirect()
            ->route('active-customer')
            ->with('info','Document has successfully been uploaded!');
        }

    catch (\Exception $e) {
           
           echo $e->getMessage();
            // return redirect()
            // ->route('account.manage')
            // ->with('info','No document was added!',$e->getMessage());
        }
    }

   
}
