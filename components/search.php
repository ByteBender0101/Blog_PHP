<?php 
    require_once __DIR__ . '/../actions/search.php';
?>
<div class="col-lg-4">
    <div class="card mb-4">
        <div class="card-header">Поиск</div>
        <div class="card-body">
            <div class="input-group">
                <input class="form-control shadow-none" type="text" name="search" id="search" placeholder="Введите поисковый запрос..." autocomplete="off">
                <span class="input-group-text">
                    <div class="search_result-btn">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                </span>
            </div>
            <div id="search_box-result"></div>
        </div>
    </div>