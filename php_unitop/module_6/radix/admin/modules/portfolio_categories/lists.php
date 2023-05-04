<?php
if(!defined("_INCODE")) die("unauthorized access...");

$data = [
    "pageTitle"=>"Danh mục dự án"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

// xử lý lọc dữ liệu
$view = 'add'; //mặc định ở trang add
$id = 0; // mặc định id


$body = getBody('get');
// xử lý lọc theo từ khóa
$filter = '';
if(!empty($body['keyword'])){
    $keyword = trim($body['keyword']);
    $filter="WHERE name LIKE '%$keyword%'";
}
if(!empty($body['view'])){
    $view=$body['view'];
}
if(!empty($body['id'])){
    $id = $body['id'];
}


// xử lý phân trang
// lấy số lượng bản ghi danh mục  dự án
$allCateNumber = getRows("SELECT * FROM `portfolio_categories` $filter");
//1. xác định được số bản ghi trên 1 trang
$perPage = _PER_PAGE; // mỗi trang có 3 bản ghi

//2. tính số trang
$maxPage = ceil($allCateNumber/$perPage); //hàm ceil: làm tròn lên

//3. xử lý sô trang dưạ vào phương thức get
if(!empty(getBody()["page"])){
    $page = getBody()["page"];
    if($page<1 || $page>$maxPage){
        $page = 1;
    }
}else{
    $page = 1;
}

//4. tính toán offset trong limit dựa vào biến $page
/**
 * $page = 1 => offset = 0 =($page-1)*$perpage
 * $page =2 => offset = 3=($page-1)*$perpage
 * $page =3 => offset = 6=($page-1)*$perpage
 * 
 */
$offset = ($page-1)*$perPage;
//truy vấn lấy tất cả bản ghi dữ liệu nhóm người dùng
$listCate = getData("SELECT *,(SELECT COUNT(`portfolios`.id) FROM portfolios WHERE `portfolios`.portfolio_category_id=`portfolio_categories`.id) AS portfolios_count FROM `portfolio_categories` $filter ORDER BY create_at DESC LIMIT $offset,$perPage");

//xủ lý query string tìm kiếm với phân trang
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=portfolio_categories','',$queryString);
    $queryString = str_replace('&page='.$page,'',$queryString);
    $queryString = trim($queryString,'&');
    $queryString ='&'.$queryString;
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
?>
    <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <?php
            getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <div class="row">
            <div class="col-6">
                <?php 
                    if(!empty($view) && !empty($id)){
                        require_once 'edit.php';
                    }else{
                        require 'add.php';
                    }
                ?>
            </div>
            <div class="col-6">
                <h4>Danh sách danh mục</h4>
                <form action="" method="get">
                    <div class="row">
                        <div class="col-9">
                            <input type="search" class="form-control" name="keyword" placeholder="Nhập tên danh mục..." value="<?php echo (!empty($keyword))?$keyword:false; ?>">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                    </div>
                    <input type="hidden" name="module" value="portfolio_categories">
                </form>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th>Tên danh mục</th>
                            <th width="15%">Sl dự án</th>
                            <th width="20%">Thời gian</th>
                            <th width="10%">Sửa</th>
                            <th width="10%">Xóa</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if(!empty($listCate)):
                                foreach($listCate as $key=>$item):
                        ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><a href="<?php echo getLinkAdmin("portfolio_categories","",['id'=>$item['id'],'view'=>'edit']); ?>"><?php echo $item['name']; ?></a> <a class="btn btn-danger btn-sm" style="padding: 0 5px;" href="<?php echo getLinkAdmin("portfolio_categories","duplicate",['id'=>$item['id']]); ?>"> Nhân bản</a></td>
                            <td><?php echo $item['portfolios_count']; ?></td>
                            <td><?php echo (!empty($item['name']))?getDateFormat($item["create_at"],'d/m/Y H:m:s'):'' ; ?></td>
                            <td><a href="<?php echo getLinkAdmin("portfolio_categories","",['id'=>$item['id'],'view'=>'edit']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                            <td><a href="<?php echo getLinkAdmin("portfolio_categories","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php
                            endforeach; else:
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">Không có danh mục dự án</td>
                        </tr>
                            <?php endif;?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                    <ul class="pagination">
                        <?php
                            if($page>1){
                                $prevPage = $page-1;
                                echo '<li class="page-item"><a class="page-link" href="?module=portfolio_categories'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
                            }
                        ?>
                        <?php 
                        // bước giới hạn ô chuyển trang
                            $begin = $page - 2;
                            if($begin < 1){
                                $begin = 1;
                            }
                            $end = $page + 2;
                            if($end>$maxPage){
                                $end = $maxPage;
                            }
                            for($index=$begin; $index<=$end;$index++){ 
                        ?>
                        <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=portfolio_categories<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                        <!-- thêm active vào class để tô màu cho ô chuyển trang -->
                        <?php }?>
                        <?php
                            if($page<$maxPage){
                                $lastPage = $page+1;
                                echo '<li class="page-item"><a class="page-link" href="?module=portfolio_categories'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                            }
                        ?>
                        
                    </ul>
                </nav>
            </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);