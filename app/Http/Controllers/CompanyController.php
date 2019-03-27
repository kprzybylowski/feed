<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $companyService;

    /**
     * Create a new controller instance.
     * 
     * @param CompanyService $companyService
     *
     * @return void
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Browse available companies
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function browse(Request $request)
    {
        $companiesList = $this->companyService->getCompanies();
        return view('company_browse', ['companies'=>$companiesList]);
    }

    /**
     * Edit company
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->route('id');
        $company = null;
        if (!empty($id)) {
            $company = $this->companyService->getCompany($id);
        }

        return view('company_edit', ['company'=>$company]);
    }

    /**
     * Save company
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $companyData = $request->except(['_token']);
        if (!empty($companyData)) {
            $this->companyService->saveCompany($companyData);
        }

        $message = 'ok';
        $type = 'success';
        return redirect('/company/browse')->with($message, $message)->with('type', $type);
    }

    /**
     * Delete company
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->route('id');
        if (!empty($id)) {
            $this->companyService->deleteCompany($id);
        }

        $message = 'ok';
        $type = 'success';
        return redirect('/company/browse')->with($message, $message)->with('type', $type);
    }
}
