<?php 
//校验数据当前访问用户的箱子（session）有没有登录的登录标识
//操作session之前都必须要先启动session

//once是多次调用执行一次，require是多次调用执行多次
require_once '../functions.php';

//这个是判断用户是否登录，一定是最先去做，防止做无意义的操作
 xiu_get_current_user();
//这里我不需要接受返回值，因为我不需要用户信息啊
 
 //获取界面所需要的数据
 //严谨的做法还应该判断这个是否有查到的结果，那边有可能returnfalse
 $posts_count=xiu_fetch_one('select count(1) as num from posts;')['num'];


 $categories_count=xiu_fetch_one('select count(1) as num from categories;')['num'];


 $comments_count=xiu_fetch_one('select count(1) as num from comments;')['num'];

 ?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php' ;?>
    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.php" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong><?php echo $posts_count; ?></strong>篇文章（<strong>2</strong>篇草稿）</li>
              <li class="list-group-item"><strong><?php echo $categories_count; ?></strong>个分类</li>
              <li class="list-group-item"><strong><?php echo $comments_count; ?></strong>条评论（<strong>1</strong>条待审核）</li>
            </ul>
          </div>
        </div>
        <!-- 这三个是分列，我们在第二列里面加chart -->
        <div class="col-md-4">
            <canvas id="chart"></canvas>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

  <?php $current_page = 'dashboard'; ?>
  <?php include 'inc/sidebar.php' ;?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/static/assets/vendors/chart/Chart.js"></script>
  <script>
          var ctx = document.getElementById('chart').getContext('2d');
          var myChart = new Chart(ctx, {
              type: 'pie',
              data:{
          datasets: [{      
              data: [<?php echo $posts_count; ?>, <?php echo $categories_count; ?>, 
              <?php echo $comments_count; ?>],

   backgroundColor:[
         'hotpink',
         'pink',
         'deeppink'
         ]
         },
         {      
              data: [<?php echo $posts_count; ?>, <?php echo $categories_count; ?>, 
              <?php echo $comments_count; ?>],

   backgroundColor:[
         'hotpink',
         'pink',
         'deeppink'
         ]
         }],



    // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                    '文章',
                    '分类',
                    '评论'
                    ]
                    }     
          });
</script>




  <script>NProgress.done()</script>
</body>
</html>
