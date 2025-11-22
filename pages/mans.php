<?php 
include("include/header.php");
include("../config/db.php");
?>
<body>
    <header>
        <?php include("include/menu.php"); ?>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="menu-items">Мужчины</h1>
                    <div class="cards">
                        <div class="swiper-button-prev">
                            <i class="bi bi-arrow-left-short" style="font-size: 3rem;color:black;"></i>
                        </div>
                        <div class="swiper peopleSwiper">
                            <div class="swiper-wrapper">
                                <?php
                                $sql = "SELECT id, src, name, age, description, tags FROM people WHERE sex = 'male' ORDER BY RAND()";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) 
                                    {?>
                                        <div class="swiper-slide card-information">
                                            <img src="../img/<?=htmlspecialchars($row["src"])?>" alt="<?=htmlspecialchars($row["name"])?>">
                                            <h2><?=htmlspecialchars($row["name"])?> - <?=htmlspecialchars($row["age"])?></h2>
                                            <p><?=htmlspecialchars($row["description"])?></p>
                                            <p><?=htmlspecialchars($row["tags"])?></p>
                                            <form action="" class="likeForm">
                                                <input type="hidden" name="idPeople" value="<?=$row["id"]?>">
                                                <button type="submit" class="btn-like">
                                                    <i class="bi bi-arrow-through-heart icon-like" style="font-size: 3rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    <?php }
                                } else {
                                    echo '<div class="swiper-slide">Нет анкет</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="swiper-button-next">
                            <i class="bi bi-arrow-right-short" style="font-size: 3rem;color:black;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("include/footer.php"); ?>
</body>
</html>