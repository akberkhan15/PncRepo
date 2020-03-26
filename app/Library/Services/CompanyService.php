<?php
namespace App\Library\Services;

use DB;
use Storage;

use App\Companies as Companies;
use App\Employees as Employees;

use App\Traits\ValidationTrait as ValidationTrait;
use App\Traits\CommonTrait as CommonTrait;

class CompanyService {
    use ValidationTrait;
    use CommonTrait;
    public function addcompany($requestData)
    {
        $custom_validate = $this->company_addcompany_validation($requestData);
        if($custom_validate['status'])
        {
            /* Add Company Start */
            $data = array(
                "name"       => $requestData['name'],
                "website"    => $requestData['website'],
                "email"      => strtolower($requestData['email']),
                "deleted"    => "0"
            );
            $this->sendEmail("emails.addcompany",$data);
            if(!empty($requestData['logo']))
            {
                $filename = Companies::uploadImage(ImagesFolder,$requestData['logo'],100);
                if($filename) 
                    $data['logo'] = $filename;
                else
                    $data['logo'] = "";
            }
            Companies::add($data);
            $status   = 200;
            $response = array(
                'status'  => 'SUCCESS',
                'message' => trans('messages.company_success'),
                'ref'     => 'company_success',
            );
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $custom_validate['message'],
                'ref'     => $custom_validate['ref'],
            );
        }
        $response_data['status'] = $status;
        $response_data['response'] = $response;
        return $response_data;
    }
    public function deletecompany($requestData)
    {
        $custom_validate = $this->company_deletecompany_validation($requestData);
        if($custom_validate['status'])
        {
            /* Delete Employee Start */
            $data['logo'] = "";
            $data['deleted'] = "1";
            if(!empty($custom_validate['company_data']['logo']) && $custom_validate['company_data']['logo'] != '')
                Storage::delete(ImagesFolder.'/'.$custom_validate['company_data']['logo']);
    
            Companies::updateRecord(['id'=> (int) $requestData['company_id']],$data);
            
            $where[] = ['deleted', '=', '0'];
            $where[] = ['company_id', '=', (int) $requestData['company_id']];

            $company_employees = Employees::getAll($where,0)['data'];
            if(!empty($company_employees))
            {
                foreach ($company_employees as $key => $employee) 
                {
                    Employees::updateRecord(['id'=> (int) $employee['id']],['deleted' => '1']);      
                }
            }

            $status   = 200;
            $response = array(
                'status'  => 'SUCCESS',
                'message' => trans('messages.delete_company_successs'),
                'ref'     => 'delete_company_successs',
            );
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $custom_validate['message'],
                'ref'     => $custom_validate['ref'],
            );
        }
        $response_data['status'] = $status;
        $response_data['response'] = $response;
        return $response_data;   
    }
    public function editcompany($requestData)
    {
        $custom_validate = $this->company_editcompany_validation($requestData);
        if($custom_validate['status'])
        {
            /* Delete Employee Start */
            $data = array(
                "name"       => $requestData['name'],
                "website"    => $requestData['website'],
                "email"      => strtolower($requestData['email']),
                "deleted"    => "0"
            );
            if(!empty($requestData['logo']))
            {
                $filename = Companies::uploadImage(ImagesFolder,$requestData['logo'],100);
                if($filename) 
                {
                    $data['logo'] = $filename;
                    if(!empty($custom_validate['company_data']['logo']) && $custom_validate['company_data']['logo'] != '')
                        Storage::delete(ImagesFolder.'/'.$custom_validate['company_data']['logo']);
                } 
                else
                    $data['logo'] = "";
            }
            Companies::updateRecord(['id'=> (int) $requestData['company_id']],$data);
            $status   = 200;
            $response = array(
                'status'  => 'SUCCESS',
                'message' => trans('messages.edit_company_successs'),
                'ref'     => 'edit_company_successs',
            );
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $custom_validate['message'],
                'ref'     => $custom_validate['ref'],
            );
        }
        $response_data['status'] = $status;
        $response_data['response'] = $response;
        return $response_data;  
    }
}
?>