<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html> 
<html lang="vi">

<head>
    <title>Computer Store mua bán thiết bị điện tử giá rẻ</title>
    <meta name="description" content="Chuyên cung cấp đầy đủ linh kiện điện tử đáp ứng theo nhu cầu của khách hàng">
    <meta name="keywords" content="nhà sách online, mua sách hay, sách hot, sách bán chạy, sách giảm giá nhiều">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/home.css">
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="fontawesome_free_5.13.0/css/all.css">
    <link rel="stylesheet" href="css/sach-moi-tuyen-chon.css">
    <link rel="stylesheet" href="css/reponsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" />
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <link rel="canonical" href="">
    <meta name="google-site-verification" content="urDZLDaX8wQZ_-x8ztGIyHqwUQh2KRHvH9FhfoGtiEw" />
    <link rel="icon" type="logo/png" sizes="32x32" href="logo/logo.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    <style>
        img[alt="www.000webhost.com"] {
            display: none;
        }
    </style>
</head>

<body>
    <!-- code cho nut like share facebook  -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
    <?php
    include 'main/header/pre-header.php'
    ?>

    <?php
    include 'main/header/danhmuc.php';
    ?>
    <?php
    include 'main/header/banner.php';
    ?>
    <section class="content my-4">
        <div class="container">
            <div class="mb-4">
                Sắp xếp theo
                <select name="sapxep" id="sapxep" class="form-control" style="width: 200px; display: inline-block;">
                    <option value="newest">Mới nhất</option>
                    <option value="low_to_high">Giá: thấp ->cao</option>
                    <option value="high_to_low">Giá: cao ->thấp</option>
                    <option value="most_view">Xem nhiều nhất (không có trường xem)</option>
                    <option value="most_comment">Nhiều nhận xét</option>
                    <option value="rate">Đánh giá cao nhất</option>
                    <option value="a_z">Tên A -> Z</option>
                </select>
            </div>
            <div class="noidung bg-white" style=" width: 100%;">
                <div class="items">
                    <div class="row">
                        <?php
                        include 'connect_db.php';

                        if (isset($_GET['sort'])) {
                            $sort_option = $_GET['sort'];

                            switch ($sort_option) {
                                case 'newest':
                                    $sort_sql = "ORDER BY id DESC";
                                    break;
                                case 'low_to_high':
                                    $sort_sql = "ORDER BY price DESC";
                                    break;
                                case 'high_to_low':
                                    $sort_sql = "ORDER BY price ASC";
                                    break;
                                case 'most_view': 
                                    $sort_sql = "ORDER BY view DESC";
                                    break;
                                case 'most_comment':
                                    $sort_sql = "LEFT JOIN (SELECT product_id, COUNT(*) as comment_count FROM rate GROUP BY product_id) AS comments ON product.id = comments.product_id ORDER BY comment_count DESC"; // Sort by most comments
                                    break;
                                case 'rate':
                                    $sort_sql = "LEFT JOIN (SELECT product_id, AVG(rate) as avg_rate FROM rate GROUP BY product_id) AS ratings ON product.id = ratings.product_id ORDER BY avg_rate DESC"; // Sort by highest average rating
                                    break;
                                case 'a-z':
                                    $sort_sql = "ORDER BY name ASC";
                                    break;
                                default:
                                    $sort_sql = "";
                                    break;
                            }
                        } else {
                            $sort_sql = "";
                        }

                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $kw = $_GET["search"];
                            $sql = "SELECT * FROM product WHERE `name` LIKE '%$kw%' $sort_sql";
                        } else {
                            $sql = "SELECT * FROM product $sort_sql";
                        }

                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="col-lg-3 col-md-4 col-xs-6">
                                <div class="card-item">
                                    <a href="chitietsp.php?id= <?php echo $row['id'] ?>" class="motsanpham" style="text-decoration: none; color: black;" data-toggle="tooltip" data-placement="bottom" title="">
                                        <img class="card-img-top anh" src="<?php echo $row['image']; ?>">
                                        <div class="card-body noidungsp mt-3">
                                            <h6 class="card-title ten"><?php echo $row['name']; ?></h6>
                                            <a href="chitietsp.php?id= <?php echo $row['id'] ?>" class="btn btn-success" role="button">Chi tiết</a>
                                            <div class="gia d-flex align-items-baseline">
                                                <div class="giamoi"> <?php echo number_format($row['price']); ?> VNĐ</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="fixed-bottom">
        <div class="btn btn-warning float-right rounded-circle nutcuonlen" id="backtotop" href="#" style="background:#CF111A;"><i class="fa fa-chevron-up text-white"></i></div>
    </div>
    <?php
    include 'main/footer/dichvu.php';
    ?>
    <?php
    include 'main/footer/footer.php';
    ?>

    <script>
        $(document).ready(function() {
            // Function to update URL parameters
            function updateQueryStringParameter(uri, key, value) {
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }

            // Function to get URL parameter value by name
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            var sortParam = getUrlParameter('sort');

            if (sortParam) {
                $('#sapxep').val(sortParam);
            }

            $('#sapxep').change(function() {
                var selectedOption = $(this).val();
                var currentUrl = window.location.href;
                var newUrl = updateQueryStringParameter(currentUrl, 'sort', selectedOption);
                window.location.href = newUrl;
            });
        });
    </script>


</body>

</html>