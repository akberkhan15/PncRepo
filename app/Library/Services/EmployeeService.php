<?php
namespace App\Library\Services;

use DB;
use App\Employees as Employees;
use App\Traits\ValidationTrait as ValidationTrait;

class EmployeeService {
    use ValidationTrait;
    public function addemployee($requestData)
    {
        $custom_validate = $this->employee_addemployee_validation($requestData);
        if($custom_validate['status'])
        {
            /* Add Employee Start */
            $data = array(
                "first_name"  => $requestData['first_name'],
                "last_name"   => $requestData['last_name'],
                "email"       => strtolower($requestData['email']),
                "deleted"     => "0",
                "company_id"  => (int) $requestData['company_id'],
                "phone_no"    => (int) $requestData['phone_no'],
            );
            Employees::add($data);
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

    public function deleteemployee($requestData)
    {
        $custom_validate = $this->employee_deleteemployee_validation($requestData);
        if($custom_validate['status'])
        {
            /* Delete Employee Start */
            Employees::updateRecord(['id'=> (int) $requestData['employee_id']],['deleted'=>'1']);
            $status   = 200;
            $response = array(
                'status'  => 'SUCCESS',
                'message' => trans('messages.delete_employee_successs'),
                'ref'     => 'delete_employee_successs',
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

    public function editemployee($requestData)
    {
        $custom_validate = $this->employee_editemployee_validation($requestData);
        if($custom_validate['status'])
        {
            $data = array(
                "first_name"  => $requestData['first_name'],
                "last_name"   => $requestData['last_name'],
                "email"       => strtolower($requestData['email']),
                "deleted"     => "0",
                "company_id"  => (int) $requestData['company_id'],
                "phone_no"    => (int) $requestData['phone_no']
            );
            /* Edit Employee Start */
            Employees::updateRecord(['id'=> (int) $requestData['employee_id']],$data);
            $status   = 200;
            $response = array(
                'status'  => 'SUCCESS',
                'message' => trans('messages.edit_employee_successs'),
                'ref'     => 'edit_employee_successs',
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