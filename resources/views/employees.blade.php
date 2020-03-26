@extends('layouts.app')
<script type="text/javascript">
	var access_token='';
	var base_url = '<?php echo base_url(); ?>/';
  window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
  ]); ?>
</script>
@section('content')
  <div class="content">
    <div class="container-fluid"> 
      <!-- Page-Title -->
      <div class="row">
        <div class="col-md-6 col-lg-6 serachBox">
          <div class="form-group">
            <h2>Add Employee</h2>
              <div class="col-md-6 col-sm-6 col-lg-5">
              </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-3 col-xs-12 pull-right text-right">
          <button type="button" class="btn btn-success btn-rounded waves-effect waves-light m-b-5 addcrnaBtn" data-toggle="modal" data-target="#addEmployee">Add Employee</button>
        </div>
      </div>
      <div class="crnadeatailMAinBox">
        <div class="row">    
          <div class="col-sm-12 col-lg-12">
            <div class="panel">
              <div class="panel-body">
                <div class="media-main"> <!-- <a href="javascript:;" class="redirectAnch"></a> --> 
                  <table id="datatable-buttons" class="table table-striped ">
                    <thead>
                      <tr>
                        <th>S.no</th>
                        <th>Company Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class="text-center">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($data)) { ?>
                      <?php $page_start_index = ($pagination['current']-1)*$pagination['perpage'];?>
                      <?php foreach($data as $index => $row){?>                    
                      <tr>
                        <td class="table-width2"><?php echo ($index+1)+$page_start_index?></td>
                        <td class="table-width2"><?php echo $row['company_name'];?></td>
                        <td class="table-width2"><?php echo $row['first_name'];?></td>
                        <td class="table-width2"><?php echo $row['last_name'];?></td>
                        <td class="table-width2"><?php echo $row['email'];?></td>
                        <td class="table-width2"><?php echo $row['phone_no'];?></td>
                        <td class="table-width2 btn-group-sm text-center">
                          <a class="btn btn-success waves-effect waves-light tooltips" data-toggle="modal" href="#_" data-target="#editEmployee<?php echo $row['id'];?>"> <i class="fa fa-pencil"></i></a>
                          
                          <a class="btn btn-danger waves-effect waves-light tooltips" onclick="deleteEmployee('editEmployeeForm<?php echo $row['id'];?>','deleteemployee','<?php echo $row['id'];?>')" href="#_" id="sa-warning"> <i class="fa fa-close"></i></a>
                        </td>
                        <div id="editEmployee<?php echo $row['id'];?>" class="doc-list modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <form id="editEmployeeForm<?php echo $row['id'];?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Employee</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-md-6" style="padding-left: 0px !important;">
                                      <label class="col-md-6 control-label">First Name</label>
                                      <div class="col-md-12">
                                        <input type="hidden" id="employee<?php echo $row['id'];?>" name="employee_id" value="<?php echo $row['id'];?>">
                                        <input name="first_name" id="first_name<?php echo $row['id'];?>" type="text" class="form-control chk" placeholder="Enter First Name" value="<?php echo $row['first_name'];?>">
                                      </div>
                                      </div>
                                    
                                      <div class="col-md-6" style="padding-left: 0px !important;">
                                      <label class="col-md-6 control-label">Last Name</label>
                                      <div class="col-md-12">
                                        <input name="last_name" id="last_name<?php echo $row['id'];?>" type="text" class="form-control chk" placeholder="Enter Last Name" value="<?php echo $row['last_name'];?>">
                                      </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-12 control-label">Email</label>
                                      <div class="col-md-12">
                                        <input name="email" id="email<?php echo $row['id'];?>" type="text" class="form-control emailchk" placeholder="peter@gmail.com" value="<?php echo $row['email'];?>">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-12 control-label">Phone No</label>
                                      <div class="col-md-12">
                                        <input name="phone_no" id="phone_no<?php echo $row['id'];?>" type="text" class="form-control emailchk" placeholder="+92312-2323234" value="<?php echo $row['phone_no'];?>">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-12 control-label">Company</label>
                                      <div class="col-md-12">
                                        <select name="company" id="company_id<?php echo $row['id'];?>" class="form-control">
                                            <option value="" disabled="" selected="">Select State</option>
                                            <?php if(!empty($companies)){?>
                                            <?php foreach ($companies as $key => $company){?>
                                            <option <?php echo $company['id']==$row['company_id']?'selected':''?> value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                          </select>
                                      </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                      <div class="col-md-12 send-btn">
                                        <br> 
                                        <button type="button" class="pull-right btn btn-success waves-effect waves-light m-b-5" onclick="editEmployee('editEmployeeForm<?php echo $row['id'];?>','editemployee','<?php echo $row['id'];?>')">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </form>
                        </div>
                      </tr>
                      <?php } ?>
                      <?php }else{ ?>
                      <tr>
                        <td colspan="1000" style="text-align: center;">No Record Found.</td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
                <div class="clearfix"></div>
              </div>
              <!-- panel-body --> 
            </div>
            {{pagintion($pagination,$pageLink='')}}
          </div>
        </div>  
      </div>
    </div>
    <!-- container -->   
  </div>
  <div id="addEmployee" class="doc-list modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="addEmployeeForm">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6" style="padding-left: 0px !important;">
                <label class="col-md-6 control-label">First Name</label>
                <div class="col-md-12">
                  <input name="first_name" id="first_name" type="text" class="form-control chk" placeholder="Enter First Name">
                </div>
                </div>
              
                <div class="col-md-6" style="padding-left: 0px !important;">
                <label class="col-md-6 control-label">Last Name</label>
                <div class="col-md-12">
                  <input name="last_name" id="last_name" type="text" class="form-control chk" placeholder="Enter Last Name">
                </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12 control-label">Email</label>
                <div class="col-md-12">
                  <input name="email" id="email" type="text" class="form-control emailchk" placeholder="peter@gmail.com">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12 control-label">Phone No</label>
                <div class="col-md-12">
                  <input name="phone_no" id="phone_no" type="text" class="form-control emailchk" placeholder="+92312-2323234">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12 control-label">Company</label>
                <div class="col-md-12">
                  <select name="company" id="company_id" class="form-control">
                      <option value="" disabled="" selected="">Select State</option>
                      <?php if(!empty($companies)){?>
                      <?php foreach ($companies as $key => $company){?>
                      <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                </div>
              </div>
                
              <div class="form-group">
                <div class="col-md-12 send-btn">
                  <br> 
                  <button type="button" class="pull-right btn btn-success waves-effect waves-light m-b-5" onclick="addEmployee('addEmployeeForm','addemployee')">Save</button>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </form>
  </div>
  <img src="https://demo-tollpays.amaxzatech.com/public/administration/default/images/spinner/spinnerwait.gif" id="spinnerMain" style="background-color:#fff;border:solid #c59140; position:fixed;top:10px;right:50%;margin-right:-29px;display:none;width:50px;z-index:99999;border-radius:60%">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> 
  <script type="text/javascript" src="https://demo-tollpays.amaxzatech.com/public/administration/default/js/common.js?t=1585223636"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">
function addEmployee(FormId,method)
{
  $("#spinnerMain").show();
	var formData = {
    'first_name' : $('#first_name').val(),
    'last_name'  : $('#last_name').val(),
    'email'      : $('#email').val(),
    'phone_no'   : $('#phone_no').val(),
    'company_id' : $('#company_id').val(),
  };
	$.ajax({
  	type: "POST",
  	url: base_url+method,
  	data: formData,
  	success: function(response)
    {
      if(response.status == "SUCCESS")
      {
        $("#spinnerMain").hide();
        toastr['success'](response.message);
        setTimeout(function(){ window.location = "" ; },1000);
      } 
      else
      {
        $("#spinnerMain").hide();
        toastr['error'](response.message);
      }
    }
  });
}
function editEmployee(FormId,method,Id)
{
  var formData = {
    'first_name' : $('#first_name'+Id).val(),
    'last_name'  : $('#last_name'+Id).val(),
    'email'      : $('#email'+Id).val(),
    'phone_no'   : $('#phone_no'+Id).val(),
    'company_id' : $('#company_id'+Id).val(),
    'employee_id' : $('#employee'+Id).val(),
  };
  $("#spinnerMain").show();
  $.ajax({
    type: "POST",
    url: base_url+method,
    data: formData,
    success: function(response)
    {
      if(response.status == "SUCCESS")
      {
          $("#spinnerMain").hide();
          toastr['success'](response.message);
          setTimeout(function(){ window.location = "" ; },1000);
      } 
      else
      {
        $("#spinnerMain").hide();
        toastr['error'](response.message);
      }
    }
  });
}
function deleteEmployee(FormId,method,Id)
{
  swal({   
      title: "Are you sure?",   
      text: "You will not be able to recover this!",   
      type: "warning",
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
    }, function(){
      editEmployee(FormId,method,Id);
    });
}
</script>
@endsection
