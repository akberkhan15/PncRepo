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
            <h2>Add Company</h2>
            <div class="col-md-6 col-sm-6 col-lg-5">
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-3 col-xs-12 pull-right text-right">
          <button type="button" class="btn btn-success btn-rounded waves-effect waves-light m-b-5 addcrnaBtn" data-toggle="modal" data-target="#addCompany">Add Company</button>
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
                        <th>Name</th>
                        <th>Website</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th class="text-center">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($data)) { ?>
                      <?php $page_start_index = ($pagination['current']-1)*$pagination['perpage'];?>
                      <?php foreach($data as $index => $row){?>                    
                      <tr>
                        <td class="table-width2"><?php echo ($index+1)+$page_start_index?></td>
                        <td class="table-width2"><?php echo $row['name'];?></td>
                        <td class="table-width2"><?php echo $row['website'];?></td>
                        <td class="table-width2"><?php echo $row['email'];?></td>
                        <td class="table-width2"><img style="border-radius: 50%;" src="<?php echo $row ['company_logo_url'];?>" alt="Avatar" style="width:200px"></td>
                        <td class="table-width2 btn-group-sm text-center">
                          <a class="btn btn-success waves-effect waves-light tooltips" data-toggle="modal" href="#_" data-target="#editCompany<?php echo $row['id'];?>"> <i class="fa fa-pencil"></i></a>

                          <a class="btn btn-danger waves-effect waves-light tooltips" onclick="deleteCompany('editCompanyForm<?php echo $row['id'];?>','deletecompany','<?php echo $row['id'];?>',event)" href="#_" id="sa-warning"> <i class="fa fa-close"></i></a>
                        </td>
                      </tr>
                      <div id="editCompany<?php echo $row['id'];?>" class="doc-list modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form id="editCompanyForm<?php echo $row['id'];?>" onsubmit="editsubmitForm(event,'editcompany','<?php echo $row['id'];?>')">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group">
                                    <div class="col-md-12" style="padding-left: 0px !important;">
                                    <label class="col-md-12 control-label">Name</label>
                                    <div class="col-md-12">
                                      <input type="hidden" name="company_id" value="<?php echo $row['id']; ?>">
                                      <input name="name" id="name<?php echo $row['id'];?>" type="text" class="form-control chk" placeholder="Enter Company Name" value="<?php echo $row['name'];?>">
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
                                    <label class="col-md-12 control-label">Website</label>
                                    <div class="col-md-12">
                                      <input name="website" id="website<?php echo $row['id'];?>" type="text" class="form-control chk" placeholder="Enter Website" value="<?php echo $row['website'];?>">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-12 control-label">Logo</label>
                                    <div class="col-md-6">
                                        <input value="upload image file" id="upload_txt<?php echo $row['id'];?>" disabled="disabled" class="form-control" type="text">
                                    </div>
                                    <div class="col-md-6">
                                       <input name="logo" id="logo<?php echo $row['id'];?>" class="upload" accept="image/*" onchange="uploadImg(event)" type="file">
                                    </div>
                                  </div>
                                    
                                  <div class="form-group">
                                    <div class="col-md-12 send-btn">
                                      <button type="submit" class="pull-right btn btn-success waves-effect waves-light m-b-5">Save</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </form>
                      </div>
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
  <div id="addCompany" class="doc-list modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="addCompanyForm" onsubmit="submitForm(event)">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Add Company</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-12" style="padding-left: 0px !important;">
                <label class="col-md-12 control-label">Name</label>
                <div class="col-md-12">
                  <input name="name" id="name" type="text" class="form-control chk" placeholder="Enter Company Name">
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
                <label class="col-md-12 control-label">Website</label>
                <div class="col-md-12">
                  <input name="website" id="website" type="text" class="form-control chk" placeholder="Enter Website">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12 control-label">Logo</label>
                <div class="col-md-6">
                    <input value="upload image file" id="upload_txt" disabled="disabled" class="form-control" type="text">
                </div>
                <div class="col-md-6">
                   <input name="file" id="logo" class="upload" accept="image/*" onchange="uploadImg(event)" type="file">
                </div>
              </div>
                
              <div class="form-group">
                <div class="col-md-12 send-btn">
                  <button type="submit" class="pull-right btn btn-success waves-effect waves-light m-b-5">Save</button>
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
var uploaded_image = null;
var imgInfo={};
function uploadImg(event){
  let reader = new FileReader();
  let file = event.target.files[0];                
  reader.onloadend = () => {      
    imgInfo.filename = file.name;
    imgInfo.filetype = file.type;
    imgInfo.filesize = file.size;
    imgInfo.fileurl = reader.result;        
  };  
  reader.readAsDataURL(file);  
  uploaded_image = file  ;              
}
function submitForm(event){
  event.preventDefault();
  var form = $('#addCompanyForm').get(0);
  var formData = new FormData(form);
  formData.append("logo",uploaded_image);
  $("#spinnerMain").show();
  $.ajax({
    url: base_url+'addcompany',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response){          
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
    },
  });
}
function editsubmitForm(event,method,Id){
  event.preventDefault();
  var form = $('#editCompanyForm'+Id).get(0);
  var formData = new FormData(form);
  $("#spinnerMain").show();
  $.ajax({
    url: base_url+method,
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response){          
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
    },
  });
}
function deleteCompany(FormId,method,Id,event)
{
  swal({   
      title: "Are you sure?",   
      text: "You will not be able to recover this! and all employee are also deleted ",   
      type: "warning",
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
    }, function(){
      editsubmitForm(event,method,Id)
    });
}
</script>
@endsection
