<?php
if(isPost()){
   
        $body = getBody();
        $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

        // validate họ tên bắt buộc nhập, và phải >=5 ký tự
        if(empty(trim($body["name"]))){
            $errors["name"]["required"]="Họ tên không được để trống";
        }else{
            if(strlen(trim($body["name"]))<5){
                $errors["name"]["min"]="Họ tên phải >= 5 ký tự";
            }
        }

        // validate email : bắt buộc phải nhập,định dạng email, email duy nhất
        if(empty(trim($body["email"]))){
            $errors["email"]["required"]="Email bắt buộc phải nhập";

        }else{
            if(!isEmail(trim($body["email"]))){
                $errors["email"]["isEmail"]="Định dạng email không hợp lệ";
            }
        }


        // validate comment bắt buộc nhập, và phải >=5 ký tự
        if(empty(trim($body["content"]))){
            $errors["content"]["required"]="Vui lòng nhập bình luận";
        }else{
            if(strlen(trim($body["content"]))<10){
                $errors["content"]["min"]="Bình luận phải >= 10 ký tự";
            }
        }

        if(empty($errors)){ // không có lỗi xảy ra
            $dataInsert = [
                "name"=>trim(strip_tags($body["name"])),
                "email"=>trim(strip_tags($body["email"])),
                "website"=>trim(strip_tags($body["website"])),
                "content"=>trim(strip_tags($body["content"])),
                "parent_id"=>0,
                "blog_id"=>$id,
                "user_id"=>null,
                "status"=>0,
                "create_at"=>date('Y-m-d H:i:s')
            ];

            insert('comments',$dataInsert);
            //redirect('?module=blogs&action=detail&id='.$id.'#comment-form');
            // echo '<pre>';
            // print_r($dataInsert);
            // echo '</pre>';
            // setFlashData("msg","Gửi bình luận thành công, quản trị viên sẽ duyệt bình luận của bạn trong thời gian sớm nhất");
            // setFlashData("msg_type","success");
            
            
        }else{
            
            setFlashData("msg","vui lòng kiểm tra nội dung nhập vào !");
            setFlashData("msg_type","danger");
            setFlashData("errors",$errors);
            setFlashData("old",$body);
            redirect('?module=blogs&action=detail&id='.$id.'#comment-form');
        }
        // echo '<pre>';
        // print_r($errors);
        // echo '</pre>';

}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
?>
<div class="comments-form" id="comment-form">
    <h2 class="title">Viết bình luận</h2>
    <?php
        getMsg($msg,$msg_type);   // gọi hàm getMsg()
    ?>
    <!-- Contact Form -->
    <form class="form" method="post" action="">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Họ và tên..." >
                    <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email của bạn..." >
                    <?php echo form_errors('email',$errors,'<span class="errors">','</span>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="url" name="website" placeholder="Website của bạn..." >
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <textarea name="content" rows="5" placeholder="Viết bình luận của bạn..." ></textarea>
                    <?php echo form_errors('content',$errors,'<span class="errors">','</span>'); ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group button">	
                    <button type="submit" class="btn primary">Gửi bình luận</button>
                </div>
            </div>
        </div>
    </form>
    <!--/ End Contact Form -->
</div>