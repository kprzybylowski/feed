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

	/**
	 * Method gets single company
     * 
     * @param integer $id Company identifier
	 * 
	 * @return object
	 */
	public function getCompany($id)
	{
        $company = $this->companyModel->find($id);
		return $company;
	}

	/**
	 * Method saves/creates new company
     * 
     * @param array $data Company data collection
     * 
	 * @return object
	 */
	public function saveCompany($data)
	{
        if (empty($data['id'])) {
            return $this->companyModel->create($data);
        } else {
            return $this->companyModel->where('id', $data['id'])->update($data);
        }
	}

	/**
	 * Method deletes company
     * 
     * @param integer $id Company identifier
     * 
	 * @return object
	 */
	public function deleteCompany($id)
	{
        if (!empty($id)) {
            return $this->companyModel->where('id', $id)->delete();
        }
	}
}