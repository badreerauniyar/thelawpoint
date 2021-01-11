<?php
require('top.php');
$name='';
$email='';
$mobile='';
$comment='';
$added_on='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from contact_us where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$name=$row['name'];
        $email=$row['email'];
        $mobile=$row['mobile'];
        $comment=$row['comment'];
        $added_on=$row['added_on'];
	}else{
		header('location:contact.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $comment=get_safe_value($con,$_POST['comment']);
    $added_on=get_safe_value($con,$_POST['added_on']);

	$res=mysqli_query($con,"select * from name where name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Comment already exist";
			}
		}else{
			$msg="Comment already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update contact_us set name='$name',email='$email', mobile='$mobile', comment='$comment', added_on='$added_on', where id='$id'");
		}else{
			mysqli_query($con,"insert into contact_us(name,email,mobile,comment,added_on) values('$name','$email','$mobile','$comment','$added_on')");
		}
		header('location:contact.php');
		die();
	}
}
?>
 <div>
 <a class="breadcrumb-item" href="index.php">Home</a>
 <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
 <a class="breadcrumb-item" href="contact.php">Contact Us</a>
</div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                        
                    </div>
                        <h2 class="title__line--6">CONTACT US</h2>
                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-location-pin icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">our address</h2>
                                <p>Kathmandu </p>
                            </div>
                        </div>
                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-envelope icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">openning hour</h2>
                                <p>Available 24*7 </p>
                            </div>
                        </div>

                        <div class="address">
                            <div class="address__icon">
                                <i class="icon-phone icons"></i>
                            </div>
                            <div class="address__details">
                                <h2 class="ct__title">Phone Number</h2>
                                <p>Will update later</p>
                            </div>
                        </div>
                          
                </div>
               
                <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Send your message </strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
								<div class="form-group">
									<label for="categories" class=" form-control-label">name</label>
									<input type="text" name="name" placeholder="Enter name" class="form-control" required value="<?php echo $name?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Email</label>
									<input type="text" name="email" placeholder="Enter your email" class="form-control" required value="<?php echo $email?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">mobile</label>
									<input type="text" name="mobile" placeholder="Enter your mobile number" class="form-control" required value="<?php echo $mobile?>">
								</div>
                               <div class="form-group">
									<label for="categories" class=" form-control-label">Your message</label>
									<textarea name="your_message" placeholder="Enter your message" class="form-control" required><?php echo $comment?></textarea>
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        </section>
<?php
require('footer.php');
?>
   