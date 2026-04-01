<?php
$conn = new mysqli("127.0.0.1", "root", "1234", "Portfolio");

if($conn->connect_error){
    die("DB 연결 실패 : ".$conn->connect_error);
}

$conn->set_charset("utf8");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$main_sql = "SELECT * FROM portfolio where id = $id";
$result = $conn->query($main_sql);

$portfolio = $result->fetch_assoc();

$teg_sql = "SELECT * FROM tag where portfolio_id = {$portfolio['id']}";
$teg_result = $conn->query($teg_sql);

$subject_sql = "SELECT * FROM subject where portfolio_id = {$portfolio['id']}";
$subject_result = $conn->query($subject_sql);

$subject_list = [
    '요약' => [],
    '역할' => [],
    '성과' => []
];

while($row = $subject_result->fetch_assoc()){
    $subject_list[$row['type']] [] = $row['content'];
}

$href_sql = "SELECT * FROM href where portfolio_id = {$portfolio['id']}";
$href_result = $conn->query($href_sql);
//$href_list = $href_result->fetch_assoc();

?>

<title>ImagePix | Hyeju Portfolio</title>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<div class="menu">
    <div class="brand">
    <a style="color: #fdcb6e" href="index.php">Hyeju's Portfolio</a>
    </div>
    <div class="nav">
        <a href="index.php#about">About</a>
        <a href="index.php#projects">Projects</a>
        <a href="index.php#contact">Contact</a>
    </div>
</div>


<main class="container">

    <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> 목록으로</a>

    <div class="project-title"><?=$portfolio['title']?> <span class="project-content">– <?=$portfolio['content']?></span></div>
    <div class="bar"></div>
    <div style="display: flex; align-items: center">
    <p class="period">
        기간: <?=$portfolio['duration']?><br>
        <!--          URL: <a href="http://13.60.98.74:8081/hj/" target="_blank" rel="noopener noreferrer">-->
        <!--          http://13.60.98.74:8081/hj/-->
        <!--      </a>-->
        <?php if($portfolio['id'] == 3) :  ?>
        <span style="color: red">* 현재 작업중인 포트폴리오입니다. 빠른 시일내로 작업 완료하겠습니다.</span>
        <?php endif; ?>
    </p>
        <div style="flex: 2"></div>
    <a href="<?=$portfolio['site_link']?>" target="_blank">
        <div class="click">
            <i class="fa-solid fa-link"></i> 링크
            <span class="link-click" style="color: #fdcb6e">
                click!
            </span>
        </div>
    </a>
    </div>

    <div class="tag-area">
        <?php         while($teg = $teg_result->fetch_assoc()) {
            $names[] = '<span class="tag">'.$teg['name'].'</span>';
        }
        echo implode('<span style="margin-right: 10px">·</span>', $names);

        ?>
    </div>

    <h2 class="section-title">요약</h2>
    <hr>
    <?php foreach ($subject_list['요약'] as $content) : ?>
    - <?=$content?><br>
    <?php endforeach; ?>
    <p>

    </p>

    <h2 class="section-title">역할</h2>
    <hr>
    <?php foreach ($subject_list['역할'] as $content) : ?>
        - <?=$content?><br>
    <?php endforeach; ?>
    <p>

    </p>

    <h2 class="section-title">성과</h2>
    <hr>
    <p>
        <?php foreach ($subject_list['성과'] as $content) : ?>
            - <?=$content?><br>
        <?php endforeach; ?>
    </p>

    <?php while ($href = $href_result->fetch_assoc()) : ?>
    <img class="project-image" src="<?=$href['link']?>">
    <?php endwhile; ?>

</main>


