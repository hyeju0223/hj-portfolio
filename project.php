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


?>

<title>ImagePix | Hyeju Portfolio</title>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<div class="menu">
    <div class="brand">
    <a style="color: #fdcb6e" href="index.html">Hyeju's Portfolio</a>
    </div>
    <div class="nav">
        <a href="index.html#about">About</a>
        <a href="index.html#projects">Projects</a>
        <a href="index.html#contact">Contact</a>
    </div>
</div>


<main class="container">

    <a href="index.html" class="back-link"><i class="fa-solid fa-arrow-left"></i> 목록으로</a>

    <h1 class="project-title"><?=$portfolio['title']?> – <?=$portfolio['content']?></h1>
    <p class="period">
        기간: <?=$portfolio['duration']?><br>
        <!--          URL: <a href="http://13.60.98.74:8081/hj/" target="_blank" rel="noopener noreferrer">-->
        <!--          http://13.60.98.74:8081/hj/-->
        <!--      </a>-->
    </p>

    <div class="tag-area">
        <?php while($tegs = $teg_result->fetch_assoc()) : ?>
        <span class="tag"><?=$tegs['name']?></span>
        <?php endwhile; ?>
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
    <img class="project-image" src="<?=$href['link']?>" alt="TripPlanner 메인 화면">
    <?php endwhile; ?>

</main>


