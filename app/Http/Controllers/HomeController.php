<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

use App\Employees as Employees;
use App\Companies as Companies;

use App\Library\Services\EmployeeService as EmployeeService;
use App\Library\Services\CompanyService as CompanyService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->_EmployeeService = new EmployeeService();
        $this->_CompanyService = new CompanyService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function employees()
    {
        $where = [];
        $where[] = ['employees.deleted', '=', '0'];
        $data = Employees::getAll($where,PAGINATOR_LIMIT);
       
        $companywhere[] = ['deleted', '=', '0'];
        $data['companies'] = Companies::getAll($companywhere,0)['data'];
        $data['public'] = '/public/admin/';
        return view('employees',$data)->render();
    }
    public function companies()
    {
        $where = [];
        $where[] = ['deleted', '=', '0'];
        $data = Companies::getAll($where,PAGINATOR_LIMIT);
        $data['public'] = '/public/admin/';
        return view('companies',$data)->render();
    }
    
    public function addemployee(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|min:4|max:15',
            'last_name'  => 'required|string|min:4|max:15',
            'email'      => 'required|string|min:10',
            'phone_no'   => 'required|string|min:10|max:20',
            'company_id' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if (!$validator->fails()) 
        {
           
            $requestData = $request->all();
            $response = $this->_EmployeeService->addemployee($requestData);
            $status   = $response['status'];
            $response = $response['response']; 
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $validator->messages()->first(),
                'ref'     => 'missing_parameters',
            );
        }
        return $this->response($response,$status);
    }

    public function editemployee(Request $request)
    {
        $rules = [
            'first_name'  => 'required|string|min:4|max:15',
            'last_name'   => 'required|string|min:4|max:15',
            'email'       => 'required|string|min:10',
            'phone_no'    => 'required|string|min:10|max:20',
            'company_id'  => 'required|string',
            'employee_id' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if (!$validator->fails()) 
        {
           
            $requestData = $request->all();
            $response = $this->_EmployeeService->editemployee($requestData);
            $status   = $response['status'];
            $response = $response['response']; 
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $validator->messages()->first(),
                'ref'     => 'missing_parameters',
            );
        }
        return $this->response($response,$status);
    }

    public function deleteemployee(Request $request)
    {
        $rules = [
            'employee_id' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if (!$validator->fails()) 
        {
           
            $requestData = $request->all();
            $response = $this->_EmployeeService->deleteemployee($requestData);
            $status   = $response['status'];
            $response = $response['response']; 
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $validator->messages()->first(),
                'ref'     => 'missing_parameters',
            );
        }
        return $this->response($response,$status);
    }

    public function addcompany(Request $request)
    {
        $rules = [
            'name'    => 'required|string|min:4|max:15',
            'email'   => 'required|string|min:10',
            'website' => 'required|string|min:10|max:20',
            'logo'    => 'mimes:jpeg,png,jpg|max:5128',
        ];
        $validator = Validator::make($request->all(),$rules);
        if (!$validator->fails()) 
        {
            $requestData = $request->all();
            $response = $this->_CompanyService->addcompany($requestData);
            $status   = $response['status'];
            $response = $response['response']; 
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $validator->messages()->first(),
                'ref'     => 'missing_parameters',
            );
        }
        return $this->response($response,$status);
    }

    public function editcompany(Request $request)
    {
         $rules = [
            'name'       => 'required|string|min:4|max:15',
            'email'      => 'required|string|min:10',
            'website'    => 'required|string|min:10|max:20',
            'logo'       => 'mimes:jpeg,png,jpg|max:5128',
            'company_id' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if (!$validator->fails()) 
        {
           
            $requestData = $request->all();
            $response = $this->_CompanyService->editcompany($requestData);
            $status   = $response['status'];
            $response = $response['response']; 
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $validator->messages()->first(),
                'ref'     => 'missing_parameters',
            );
        }
        return $this->response($response,$status);
    }

    public function deletecompany(Request $request)
    {
        $rules = [
            'company_id' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if (!$validator->fails()) 
        {
            $requestData = $request->all();
            $response = $this->_CompanyService->deletecompany($requestData);
            $status   = $response['status'];
            $response = $response['response']; 
        }
        else
        {
            $status = 400;
            $response = array(
                'status'  => 'FAILED',
                'message' => $validator->messages()->first(),
                'ref'     => 'missing_parameters',
            );
        }
        return $this->response($response,$status);
    }
}
