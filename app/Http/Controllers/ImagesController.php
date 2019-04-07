<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Auth;
use App\Services\ImagesService;
use App\Services\UserService;
use App\Services\CompanyService;

class ImagesController extends Controller
{
    protected $imagesService;
    protected $userService;
    protected $companyService;

    /**
     * Create a new controller instance.
     * 
     * @param ImagesService  $imagesService
     * @param UserService    $userService
     * @param CompanyService $companyService
     *
     * @return void
     */
    public function __construct(ImagesService $imagesService, UserService $userService, CompanyService $companyService)
    {
        $this->imagesService = $imagesService;
        $this->userService = $userService;
        $this->companyService = $companyService;
    }
    /**
     * Gallery index
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     * 
     * @return type
     */
    public function browse() {
        $auth = Auth::user();
        $user = $this->userService->getUser($auth->id);
        $imagesList = $this->imagesService->getImages($user);
        return view('images_browse', ['images'=>$imagesList, 'user'=>$user]);
    }

    /**
     * Edit image
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $user = $this->userService->getUser($auth->id);
        $companies = $this->companyService->getCompanies();

        $data = [
            'created_by' => $user->id,
            'user_role' => $user->role->code,
            'company_id' => $user->company_id,
            'companies' => $companies,
        ];

        return view('images_edit', ['data'=>$data]);
    }

    public function save(Request $request) {
        $user = Auth::user();
        $file = $request->file('image');
        $company_id = isset($request->company_id)?$request->company_id:$user->company_id;
        $filename = $file->hashName();
        $originalName = $file->getClientOriginalName();
        $isPrimary = isset($request->is_primary);
        $createdBy = $request->created_by;
        $imageData = [
            'company_id' => $company_id,
            'name' => $filename,
            'original_name' => $originalName,
            'is_primary' => $isPrimary,
            'created_by' => $createdBy,
        ];

        $this->imagesService->saveImage($imageData);
        $request->file('image')->store('public');
        return redirect('/images/browse')->with('message', 'File '.$filename.' uploaded successfully')->with('type', 'success');
    }

    /**
     * Delete image
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->route('id');
        if (!empty($id)) {
            $this->imagesService->deleteImage($id);
        }

        $message = 'Image deleted successfully';
        $type = 'success';
        return redirect('/images/browse')->with('message', $message)->with('type', $type);
    }
}