<?php 
include("include/header.php");
include("../config/db.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рейтинг посетителей</title>
</head>
<body>
    <header>
        <?php include("include/menu.php") ?>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Рейтинг наших посетителей</h1>
                </div>
            </div>
            <div class="row rating-container">
                <?php
                    $sql = "SELECT src, name, age, description, tags, likes FROM people ORDER BY likes DESC";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $tags = htmlspecialchars($row["tags"]);
                            $tagsArray = $tags ? explode(',', $tags) : [];
                            ?>
                            <div class="row rating-container__card">
                                <div class="col-lg-6 rating-container__picture">
                                    <img class="rating-container__img" src="../img/<?=htmlspecialchars($row["src"])?>" alt="<?=htmlspecialchars($row["name"])?>">
                                </div>
                                <div class="col-lg-6">
                                    <h2><?=htmlspecialchars($row["name"])?> - <?=htmlspecialchars($row["age"])?></h2>
                                    <p><?=htmlspecialchars($row["description"])?></p>
                                    
                                    <?php if (!empty($tagsArray)): ?>
                                        <div class="tags-container">
                                            <?php foreach($tagsArray as $tag): ?>
                                                <span class="tag"><?=trim($tag)?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="likes-container">
                                        <span class="likes-count"><?=htmlspecialchars($row["likes"])?></span>
                                        <i class="bi bi-heart-fill icon-like"></i>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <h3>Пока нет участников</h3>
                                <p>Будьте первым, кто добавит свою анкету!</p>
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </main>
    <?php include("include/footer.php"); ?>
</body>
</html>