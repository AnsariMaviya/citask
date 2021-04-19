<?php
use Config\Services;
$this->session = Services::session();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/all.css" integrity="sha512-ajhUYg8JAATDFejqbeN7KbF2zyPbbqz04dgOLyGcYEk/MJD3V+HJhJLKvJ2VVlqrr4PwHeGTTWxbI+8teA7snw==" crossorigin="anonymous" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?=base_url()?>/assets/css/croppie.css" type="text/css">

    <script type="text/javascript" src="<?=base_url()?>/assets/js/croppie.js"></script>
	<style type="text/css">
		body{
			height: 100vh;
		}
		.image{
			position: fixed;
		  	top: 50%;
		  	left: 20%;
		  	transform: translate(-50%, -60%);
		}
		.container{
			position: fixed;
		  	top: 50%;
		  	left: 50%;
		  	transform: translate(-50%, -50%);
		}
	</style>
</head>
<body>
	<?php
	    if($this->session->getFlashdata('loginMessage')){
	      echo '<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="d-flex">
			    <div class="toast-body">
			     '.$this->session->getFlashdata('loginMessage').'
			    </div>
			    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			  </div>
			</div> ';
	    }
	?>
		
	<div class="container justify-content-center d-flex">
		<div class="col-6">
			<div class="text-center image text-justify align-items-center">
                <div class="">Update Profile Image</div>
                <div id="uploaded_image"></div><br />
                <img class="border-dark border-xl img-responsive"  id="cropped-image" src="<?=base_url()?>/assets/UserData/<?=$data->profile?>"  style="width:50%; margin-bottom: 30px; border: 2px solid black;" alt=""/>
                <div class="row" align="center">

                  <input type="text" class="form-control col-md-8 image_path" style="width: 70%" id="image_path" name="image_path" value="<?=$data->profile?>" disabled>
                  <button type="button" class="btn btn-info col-md-3 d-flex justify-content-center" style="margin-left: 5px;" id="upload_img_bt">Upload</button>

                </div>
              </div>
		</div>
		<div class="col-6">
			<a href="<?php echo base_url(); ?>/Login/logout" class="btn nav-link justify-content-end d-flex" title="Logout" data-toggle="tooltip">
               <button class="btn btn-primary">Logout</button>
            </a>
			<form method="post" id="updateForm">
				<div class="mb-3">
				  <label for="fname" class="form-label">First Name *</label>
				  <input type="text" class="form-control" id="fname" name="fname" value="<?=$data->fname?>" required>
				</div>
				 <input type="hidden" class="form-control image_path" id="profile" name="profile" value="<?=$data->profile?>">
				<div class="mb-3">
				  <label for="lname" class="form-label">Last Name *</label>
				  <input type="text" class="form-control" id="lname" name="lname" value="<?=$data->lname?>" required>
				</div>
				<div class="mb-3">
				  <label for="email" class="form-label">Email ID</label>
				  <input type="email" class="form-control" id="email" name="email" value="<?=$data->email?>" value="" readonly>
				</div>
				<div class="mb-3">
				  <label for="pwd" class="form-label">Password *</label>
				  <input type="password" class="form-control" id="pwd" name="pwd" value="<?=$data->pwd?>" required>
				</div>
				<div class="mb-3">
				  <label for="dept" class="form-label">Department *</label>
				  <select class="form-control" id="dept" name="dept" required>
				  	<option value="">Select</option>
				  	<?php
				  		foreach ($dept as $value) {
				  			echo '<option value="'.$value->id.'" '.($value->id==$data->dept ? "selected" : "").' >'.$value->dept.'</option>';
				  		}
				  	?>
				  </select>
				</div>
				<div class="mb-3">
				  <label for="subdept" class="form-label">Sub Department *</label>
				  <select class="form-control" id="subdept" name="subdept" required>
				  	<option>Select</option>
				  </select>
				</div>
				<div class="d-flex justify-content-center">
					<button type="button" class="btn btn-primary" id="save">Save</button>
				</div>
			</form>
		</div>
	</div>
	<div id="uploadimageModal" class="modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content justify-content-center d-flex" style="width: 800px!important;">
      <div class="modal-header">
        <h4 class="modal-title">Upload & Crop Image</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-7 text-center">
            <div id="image_demo" style="width:350px; margin-top:0px"></div>
          </div>
          <div class="col-md-5" style="padding-top:30px;">
            <br />
            <br />
            <br/>
            <button class="btn btn-success crop_image" style="margin-bottom: 20px;">Crop & Upload Image</button>
              <div class="form-group">
                <div class="custom-file">
              <input type="file" class="custom-file-input form-control form-control-lg"
              aria-describedby="inputGroupFileAddon01" onchange="select_file()" name="upload_image" id="upload_image" accept="image/*" required/>
            </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		if($('#dept').val()!=""){
			$('#subdept').empty()
			$('#subdept').append('<option value="">Select</option>')
			$.post('<?=base_url()?>/Login/getSubDept',{dept:$('#dept').val()},function(data){
				var dept = JSON.parse(data).dept
				for(i=0; i<dept.length; i++)
					$('#subdept').append('<option value="'+dept[i].id+'" '+(dept[i].id==<?=!empty($data->subdept) ? $data->subdept : 0?> ? "selected" : '' )+'>'+dept[i].sub_dept+'</option>')
			})
		}
		$('.toast').toast('show')
		$('#dept').change(function(){
			$('#subdept').empty()
			$('#subdept').append('<option value="">Select</option>')
			$.post('<?=base_url()?>/Login/getSubDept',{dept:$(this).val()},function(data){
				var dept = JSON.parse(data).dept
				for(i=0; i<dept.length; i++)
					$('#subdept').append('<option value="'+dept[i].id+'" '+(dept[i].id==<?=!empty($data->subdept) ? $data->subdept : 0?>  ? "selected" : '' )+'>'+dept[i].sub_dept+'</option>')
			})
		})

		$('.crop_image').click(function(event){
			if($('#upload_image').val()!=""){
      var image = $('#image_path').val();
      var folder = 'UserData';
      var action = 1;
      var code = 'USR';
      if(image != '' || image != null)
        image = '1'
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response){
        $.ajax({
          url:"<?=base_url()?>/Dashboard/upload_cropped_image/"+image+"/"+folder+"/"+action+"/"+code,
          type: "POST",
          data:{"image": response, "id" : "<?=$data->id.'-'.$data->fname?>"},
          success:function(data)
          {
            $('#uploadimageModal').modal('hide');
            $('.image_path').val(data);
            $('#cropped-image').attr('src','<?=base_url()?>/assets/'+folder+'/'+data+'?'+Math.floor(100000000 + Math.random() * 900000000));
          }
        });
      })
  }
  else{
  	alert('Please select a image')
  }
    });

$image_crop = $('#image_demo').croppie({
      enableExif: true,
      viewport: {
        width:400,
        height:400,
      type:'square' //circle
    },
    boundary:{
      width:450,
      height:450
    }
  });

    $('#upload_img_bt').click(function() {

      $('#uploadimageModal').modal('show');
    });

    $('#upload_image').on(' change', function(){
      $('#uploadimageModal').modal('show');
    $('#image_name').attr("style",'border: none;border-bottom: 2px solid #28a745 !important')
      var reader = new FileReader();
      reader.onload = function (event) {
        $image_crop.croppie('bind', {
          url: event.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
    });
    $('#save').click(function(){
    	$("#updateForm").submit()
    })

    	$("#updateForm").submit(function(e) {
    		var serializedData = $(this).serializeArray();
            var c = 0;

            $.each(serializedData, function(i,data){
                if($.trim(data['value'])==''){
                    c++;
                }
            });
    		// e.preventDefault();
    		if(c==0)
			$.ajax({
		        url: '<?=base_url()?>/Dashboard/updateUser',
		        type: 'post',
		        dataType: 'json',
		        data: $('#updateForm').serialize(),
		        success: function(data) {
		           if(data==true)
		           	alert("Profile updated successfully")
		           else
		           	alert("Profile not updated")
		        }
		    });
			else
				alert('Please fill all the required fields')
	    });
  });
</script>