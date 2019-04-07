<?php namespace App\Services;

use App\Models\Images;
use Illuminate\Support\Facades\Hash;

class ImagesService
{
    protected $ImagesModel;

    /**
     * Constructor
     * 
     * @param Images $images
	 * 
	 * @return void
     */
    public function __construct(Images $images)
    {
        $this->imagesModel = $images;
    }

	/**
	 * Method gets images list
	 * 
     * @param integer $companyId Company identifier
     * 
	 * @return object
	 */
	public function getImages($companyId)
	{
        $images = $this->imagesModel->with('Company')->with('Creator');
        if (!empty($companyId)) {
            $images->where('company_id', $companyId);
        }

        $imagesList = $images->get();
		return $imagesList;
	}

	/**
	 * Method saves new image
     * 
     * @param array $data Image data collection
     * 
	 * @return object
	 */
	public function saveImage($data)
	{
        if (!empty($data)) {
            return $this->imagesModel->create($data);
        }
	}

	/**
	 * Method deletes image
     * 
     * @param integer $id Image identifier
     * 
	 * @return object
	 */
	public function deleteImage($id)
	{
        if (!empty($id)) {
            return $this->imagesModel->where('id', $id)->delete();
        }
	}
}