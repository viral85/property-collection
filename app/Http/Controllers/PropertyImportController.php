<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SavePropertyRequest;
use Input;
use Redirect;
use App\Services\Property\Contracts\PropertyRepository;
use Response;
use Helpers;

class PropertyImportController extends Controller {
    /*
     * Initialize repository @PropertyRepository
     */

    public function __construct(PropertyRepository $PropertyRepository) {
        $this->PropertyRepository = $PropertyRepository;
    }

    /*
     * Blend view for import property
     */

    public function index() {
        return view('import-property');
    }

    /*
     * Save property data from csv. Only csv file formate allowed
     */

    public function save(SavePropertyRequest $request) {
        if (Input::hasFile('fileData')) {
            $csvFile = Input::file('fileData');
            if ($csvFile != '' && null !== $csvFile->getClientMimeType() && $csvFile->getClientMimeType() === "application/vnd.ms-excel") {
                //Remove Space from file name & temp store
                $name = time() . '-' . preg_replace('/\s+/', '', $csvFile->getClientOriginalName());

                // Moves file to folder on server
                $csvFile->move(public_path() . '/upload/csv/', $name);
                $path = public_path('upload/csv/' . $name);

                $delimiter = ",";

                if (file_exists($path) && is_readable($path)) {
                    $header = NULL;
                    $properties = array();
                    if (($handle = fopen($path, 'r')) !== FALSE) {
                        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                            if (!$header) {
                                $header = $row;
                            } else {
                                $properties[] = array_combine($header, $row);
                            }
                        }
                        fclose($handle);
                    }
                    if (!empty($properties)) {
                        foreach ($properties as $key => $value) {
                            $property = $this->PropertyRepository->create([
                                'name' => (isset($value['Name'])) ? $value['Name'] : "",
                                'price' => (isset($value['Price'])) ? $value['Price'] : "",
                                'bedroom' => (isset($value['Bedrooms'])) ? $value['Bedrooms'] : "",
                                'bathroom' => (isset($value['Bathrooms'])) ? $value['Bathrooms'] : "",
                                'store' => (isset($value['Storeys'])) ? $value['Storeys'] : "",
                                'garage' => (isset($value['Garages'])) ? $value['Garages'] : "",
                            ]);
                        }
                        return Redirect::to("/import-property")->with('success', 'Property imported successfully');
                    } else {
                        return Redirect::to("/import-property")->with('error', 'No any property for import!');
                    }
                } else {
                    return Redirect::to("/import-property")->with('error', 'Something went wrong, Please try it again!');
                }

                //Delete temp file
                unlink($path);
            } else {
                return Redirect::to("/import-property")->with('error', 'Csv file formate is required!');
            }
        } else {
            return Redirect::to("/import-property")->with('error', 'File is required!');
        }
    }

}
