
<?php
$conn = new mysqli("127.0.0.1", "root", "1234", "Portfolio");

if($conn->connect_error){
    die("DB 연결 실패 : ".$conn->connect_error);
}

$conn->set_charset("utf8");

$main_sql = "SELECT * FROM portfolio";
$result = $conn->query($main_sql);



?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hyeju's Portfolio</title>

    <style>

        :root{
            --mint: rgb(0, 0, 0);
            --text: #ffffff;
            --subtext: #313133;
            --card: #ffffff;
            --shadow: 0 10px 24px rgba(0,0,0,0.08);
            --line: rgba(0,0,0,0.08);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 0;
            color: #2d3436;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Noto Sans KR", Arial, sans-serif;
            background: #fff;
            font-size: 17px;
            line-height: 1.7;
        }

        html { scroll-behavior: smooth; }
        section { scroll-margin-top: 84px; }


        .menu {
            position: sticky;
            top: 0;
            z-index: 50;
            display: flex;
            background-color: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
            color: var(--mint);
            padding: 14px 18px;
            justify-content: space-around;
            align-items: center;
            font-size: 18px;
        }

        .menu a:hover {
            color: #fdcb6e;
        }

        .brand{
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.3px;
            color: rgb(0, 0, 0);
        }

        .nav {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        .nav a, .brand a{
            text-decoration: none;
            color: var(--mint);
            font-weight: 700;
            padding: 8px 10px;
            border-radius: 10px;
        }


        .profile-section {
            padding: 56px 20px;
            text-align: center;
            margin-top: 0;
            background: linear-gradient(rgb(0, 0, 0), #000000);
        }

        .profile {
            margin-top: 8px;
            border-radius: 50%;
        }

        .hero-title{
            margin: 16px 0 6px;
            font-size: 34px;
            font-weight: 900;
            letter-spacing: -0.3px;
            color: #fdcb6e;
        }

        .hero-sub{
            font-size: 18px;
            color: rgba(255, 255, 255, 0.65);
            font-weight: 600;
        }

        .about-section {
            padding: 56px 20px;
            text-align: center;
            background-color: #ffffff;
        }

        .container{
            max-width: 1080px;
            margin: 0 auto;
        }

        .section-title{
            font-size: 34px;
            font-weight: 900;
            color: rgb(255, 255, 255);
            letter-spacing: -0.3px;
        }

        .section-title-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .section-title-black{
            font-size: 34px;
            font-weight: 900;
            margin: 30px 0;
            color: #2d3436;
            letter-spacing: -0.3px;
        }

        .section-title-black.about{
            margin-top: 50px;
        }

        .section-title-cnt {
            background-color: #fdcb6e;
            color: white;
            border-radius: 20px;
            padding: 0 6px;
            position: absolute;
            top: -3px;
            right: -35px;
            font-size: 16px;
        }


        .fa-face-grin{
            position: relative;
            color: #fdcb6e;
            top: -18px;
            right: -3px;
            font-size: 30px;
        }

        .about-text{
            color: var(--subtext);
            font-weight: 600;
            font-size: 18px;
        }

        .project-section {
            text-align: center;
            padding: 56px 20px 70px;
            background: #fbfbfb;
        }

        .project-link{
            text-decoration: none;
            color: #2d3436;
        }

        .projects-grid{
            display: grid;
            /*grid-template-columns: repeat(2, minmax(0, 1fr));*/
            gap: 18px;
            align-items: stretch;
        }

        @media (max-width: 900px){
            .projects-grid{ grid-template-columns: 1fr; }
            .menu{ justify-content: space-between; }
        }

        .project-box {
            position: relative;
            box-shadow: var(--shadow);
            border-radius: 16px;
            padding: 16px 18px;
            background-color: var(--card);
            border: 1px solid var(--line);
            text-align: left;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            cursor: pointer;
        }



        .project-box:hover{
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(0,0,0,0.10);
        }

        .project-box h3{
            margin: 4px 0 8px;
            font-size: 20px;
            letter-spacing: -0.2px;
        }

        .project-desc{
            color: var(--subtext);
            font-weight: 600;
            font-size: 16.5px;
            margin-bottom: 12px;
        }

        .tag-area {
            color: #393939;
            display: flex;
            flex-wrap: wrap;

        }

        .tag {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            padding-right: 10px;
            gap: 8px;
        }

        .project-image-wrap{
            padding-top: 10px;
            position: relative;
            z-index: 1;
        }
        .project-image {
            width: 100%;
            object-fit: cover;
        }

        .contact-section{
            padding: 56px 70px;
            text-align: start;
            background: #2d3436;
        }

        .contact-card{
            max-width: 520px;
            margin: 0 auto;
            /* background: rgba(255, 255, 255, 0.75); */
            /* border: 1px solid rgba(255, 255, 255, 0.9); */
            color: #2d3436;
            /* box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06); */
            /* backdrop-filter: blur(6px); */
        }

        .contact-line{
            font-weight: 700;
            color: rgba(255, 255, 255, 0.65);
            margin: 6px 0;
            font-size: 16.8px;
            text-decoration: none;
            text-align: start;
        }

        a.contact-line:hover{
            text-decoration: none;
            opacity: .9;
        }

        .social{
            display: inline-flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            margin-top: 12px;
        }

        .social a{
            display: inline-flex;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            align-items: center;
            justify-content: center;

        }

        .footer {
            text-align: center;
            padding: 18px 12px;
            color: rgba(255,255,255,0.95);
            background: #000000;
            font-size: 13px;
        }

    </style>
</head>
<body>
<div class="menu">
    <div class="brand" style="text-align: right !important;">
        <a style="color: #fdcb6e" href="#home">Hyeju's Portfolio</a></div>
    <div class="nav" style="text-align: right !important;">
        <a href="#about">About</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>
    </div>
</div>

<section class="profile-section" id="home">
    <div class="container">
        <img
            class="profile"
            src="img/profile_img.jpg"
            width="200" height="200" alt="profile"
        />
        <div class="hero-title">Hi, I'm Hyeju.</div>
        <div class="hero-sub">드러나지 않는 고민을 쌓아, 화면 위의 편안함을 만듭니다.</div>
    </div>
</section>

<section class="about-section" id="about">
    <div class="container">
        <div class="section-title-black about">About Me<i class="fa-solid fa-face-grin"></i></div>
        <div class="about-text">
            보이지 않는 흐름을 먼저 고민하며,<br>
            백엔드와 프론트를 연결해 생각합니다.<br><br>
            안정성과 감각 사이의 균형을 중요하게 여기고,<br>
            기능 너머의 경험을 만들고 싶습니다.<br><br>
            오늘도 이유 있는 개발을 향해 나아가고 있습니다.
        </div>
    </div>
</section>

<section class="project-section" id="projects">
    <div class="container">
        <div class="section-title-wrapper">
            <span class="section-title-black">Projects</span>
            <?php
            $count_sql = "SELECT count(*) as cnt FROM portfolio";
            $count_result = mysqli_query($conn, $count_sql);
            $count_result = mysqli_fetch_assoc($count_result);?>
            <span class="section-title-cnt"><i class="fa-solid fa-check" style="margin-right: 4px"></i><?=$count_result['cnt']?></span>

        </div>

        <div class="projects-grid">

            <!-- Project 1 -->
            <?php
            $i = 1;
            while($row = $result->fetch_assoc()) : ?>
            <a href="project.php?id=<?=$i?>" class="project-link">
                <div class="project-box">
                    <div>

                        <div style="margin: 25px">
                                <span style="font-size: 32px; font-weight: bold; color: #fdcb6e"><?=$row['title']?></span>

                        <div class="project-desc">
                            <?=$row['content']?>
                        </div>
                        <div class="tag-area">
                                <?php
                                    $portfilio_id = $row['id'];
                                    $teg_sql = "SELECT * FROM tag where portfolio_id = $portfilio_id";
                                    $teg_result = $conn->query($teg_sql);

                                    $names = [];

                                while($teg = $teg_result->fetch_assoc()) {
                                    $names[] = '<span class="tag">'.$teg['name'].'</span>';
                                }
                                echo implode('<span style="margin-right: 10px">·</span>', $names);
                                   
                                ?>
                        </div>
                        </div>
                        <div class="project-image-wrap">
                            <?php
                            $portfilio_id = $row['id'];
                            $href_sql = "SELECT * FROM href where portfolio_id = $portfilio_id AND link LIKE '%main%' ";
                            $href_result = $conn->query("$href_sql");
                            ?>
                            <?php while($href = $href_result->fetch_assoc()) : ?>
                                <img class="project-image" src="<?=$href['link']?>" />
                            <?php endwhile; ?>
                        </div>
                    </div>


                </div>
            </a>

            <?php $i++; endwhile; ?>


        </div>
    </div>
</section>

<section class="contact-section" id="contact">
    <div class="container">
        <a class="section-title">Contact</a>
        <div class="contact-line"><i class="fa-solid fa-envelope"></i> Email : juya_0223@naver.com</div>
        <div class="contact-line"><i class="fa-solid fa-phone"></i> Phone : 010-9188-0659</div>
        <div>
            <a>
                <div class="contact-line"  href="https://juya0223.tistory.com/" target="_blank" rel="noopener noreferrer">
                <i class="fa-solid fa-blog"></i> blog : Tistory
                </div>
            </a>
        </div>
        <div>
            <a>
                <div class="contact-line" href="https://github.com/hyeju0223" target="_github"  rel="noopener noreferrer">
                <i class="fa-brands fa-github"></i> : git
                </div>
            </a>
        </div>
    </div>
</section>

<div class="footer">© 2026 Hyeju. All rights reserved.</div>
</body>
</html>
