<?php
namespace App\Traits;
use Illuminate\Http\Request;

use App\Employees as Employees;
use App\Companies as Companies;

trait ValidationTrait
{
    
    /* Employee Controller Validation Start */
    public function employee_addemployee_validation($requestData)
    {
        $validate = array(
            "status"   => true,
            "message"  => "",
            "ref"      => "",
        );
        
        //Email already exists
        $employee_email = Employees::where(['email' => strtolower($requestData['email'])])->first();
        if(!empty($employee_email))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_email_inuse');
            $validate['ref']     = "error_email_inuse";
            return $validate;
        }
        return $validate;
    }
    public function employee_deleteemployee_validation($requestData)
    {
        $validate = array(
            "status"   => true,
            "message"  => "",
            "ref"      => "",
        );
        
        //employee
        $employee_exist = Employees::where(['id' => $requestData['employee_id']])->first();
        if(empty($employee_exist))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_employee_invalid');
            $validate['ref']     = "error_employee_invalid";
            return $validate;
        }
        return $validate;   
    }
    public function employee_editemployee_validation($requestData)
    {
        $validate = array(
            "status"   => true,
            "message"  => "",
            "ref"      => "",
        );
        
        //employee
        $employee_exist = Employees::where(['id' => $requestData['employee_id']])->first();
        if(empty($employee_exist))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_employee_invalid');
            $validate['ref']     = "error_employee_invalid";
            return $validate;
        }

        $email_exist = Employees::where(['email' => strtolower($requestData['email'])])->where('id', '!=', (int) $requestData['employee_id'])->first();
        if(!empty($email_exist))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_email_inuse');
            $validate['ref']     = "error_email_inuse";
            return $validate;
        }
        return $validate;  
    }
    /* Employee Controller Validation End */

    /* Company Controller Validation Start */
    public function company_addcompany_validation($requestData)
    {
        $validate = array(
            "status"   => true,
            "message"  => "",
            "ref"      => "",
        );
        
        //Email already exists
        $company_email = Companies::where(['email' => strtolower($requestData['email'])])->first();
        if(!empty($company_email))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_email_inuse');
            $validate['ref']     = "error_email_inuse";
            return $validate;
        }
        return $validate;
    }
    public function company_deletecompany_validation($requestData)
    {
        $validate = array(
            "status"   => true,
            "message"  => "",
            "ref"      => "",
        );
        
        //employee
        $company_exist = Companies::where(['id' => $requestData['company_id']])->first();
        if(empty($company_exist))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_company_invalid');
            $validate['ref']     = "error_company_invalid";
            return $validate;
        }
        $validate['company_data'] = $company_exist;
        return $validate;   
    }
    public function company_editcompany_validation($requestData)
    {
        $validate = array(
            "status"   => true,
            "message"  => "",
            "ref"      => "",
        );
        
        //employee
        $company_exist = Companies::where(['id' => $requestData['company_id']])->first();
        if(empty($company_exist))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_company_invalid');
            $validate['ref']     = "error_company_invalid";
            return $validate;
        }
        $validate['company_data'] = $company_exist;
        $email_exist = Companies::where(['email' => strtolower($requestData['email'])])->where('id', '!=', (int) $requestData['company_id'])->first();
        if(!empty($email_exist))
        {
            $validate['status']  = false;
            $validate['message'] = trans('messages.error_email_inuse');
            $validate['ref']     = "error_email_inuse";
            return $validate;
        }
        return $validate;  
    }
    /* Company Controller Validation End */
}