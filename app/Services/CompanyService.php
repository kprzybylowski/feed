<?php namespace App\Services;

use App\Models\Companies;

class CompanyService
{
    protected $companyModel;

    /**
     * Constructor
     * 
     * @param Company $company
     * 
     * @return void
     */
    public function __construct(Companies $company)
    {
        $this->companyModel = $company;
    }

	/**
	 * Method gets companies list
	 * 
	 * @return object
	 */
	public function getCompanies()
	{
        $companiesList = $this->companyModel->get();
		return $companiesList;
	}
}