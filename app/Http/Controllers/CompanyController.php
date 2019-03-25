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
        return view('company_browse');
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
        return view('company_edit');
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
        return redirect('/company/browse')->with($message, $message)->with('type', $type);
    }
}
