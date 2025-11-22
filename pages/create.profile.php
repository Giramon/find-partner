<?php include("include/header.php"); ?>
<body>
    <header>
        <?php include("include/menu.php") ?>
    </header>
    <main>
        <div class="container menu-items">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Хотите создать свою анкету?</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="dating-form-container">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <form class="dating-form">
                                <div class="form-header">
                                    <h2><i class="bi bi-heart-fill text-danger me-2"></i>Создать анкету</h2>
                                    <p>Расскажите о себе и найдите свою половинку</p>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Имя *</label>
                                        <input type="text" name="name" class="form-control" placeholder="Введите ваше имя" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Возраст *</label>
                                        <input type="number" name="age" class="form-control" min="18" max="100" placeholder="Ваш возраст" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Ваш пол *</label>
                                    <div class="gender-selection">
                                        <div class="gender-option">
                                            <input type="radio" name="gender" id="male" class="gender-input" value="male" required>
                                            <label for="male" class="gender-label">
                                                <i class="bi bi-gender-male gender-icon"></i>
                                                Мужской
                                            </label>
                                        </div>
                                        <div class="gender-option">
                                            <input type="radio" name="gender" id="female" class="gender-input" value="female">
                                            <label for="female" class="gender-label">
                                                <i class="bi bi-gender-female gender-icon"></i>
                                                Женский
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Фотография *</label>
                                    <div class="photo-upload-area" id="photoUpload">
                                        <i class="bi bi-cloud-arrow-up-fill photo-upload-icon"></i>
                                        <h5>Загрузите ваше фото</h5>
                                        <p class="text-muted">Перетащите сюда файл или нажмите для выбора</p>
                                        <input type="file" name="photo" id="photoInput" accept="image/*" style="display: none;" required>
                                        <img id="previewImage" class="preview-image" alt="Предпросмотр">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">О себе *</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Расскажите о своих интересах, увлечениях, характере..." maxlength="500" required></textarea>
                                    <div class="character-count">0/300 символов</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Кого ищете *</label>
                                    <div class="looking-for-tags">
                                        <div class="tag-option">
                                            <input type="radio" name="lookingFor" id="serious" class="tag-input" value="serious" required>
                                            <label for="serious" class="tag-label">
                                                <i class="bi bi-heart me-2"></i>Серьёзные отношения
                                            </label>
                                        </div>
                                        <div class="tag-option">
                                            <input type="radio" name="lookingFor" id="friendship" class="tag-input" value="friendship">
                                            <label for="friendship" class="tag-label">
                                                <i class="bi bi-people me-2"></i>Дружба и общение
                                            </label>
                                        </div>
                                        <div class="tag-option">
                                            <input type="radio" name="lookingFor" id="dating" class="tag-input" value="dating">
                                            <label for="dating" class="tag-label">
                                                <i class="bi bi-cup-straw me-2"></i>Свободные встречи
                                            </label>
                                        </div>
                                        <div class="tag-option">
                                            <input type="radio" name="lookingFor" id="travel" class="tag-input" value="travel">
                                            <label for="travel" class="tag-label">
                                                <i class="bi bi-geo-alt me-2"></i>Спутник для путешествий
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="submit-btn">
                                    <i class="bi bi-heart-fill me-2"></i>Создать анкету
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("include/footer.php"); ?>
</body>
</html>