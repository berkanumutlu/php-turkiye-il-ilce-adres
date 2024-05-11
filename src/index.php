<?php
require_once '../vendor/autoload.php';
require_once 'config/db.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turkey Address</title>
    <meta name="description" content="Turkey Address by Berkan Ümütlü">
    <meta name="keywords" content="php, turkey, address, türkiye, türkiye il ilçe adres, türkiye adres">
    <meta name="author" content="Berkan Ümütlü">
    <meta name="copyright" content="Berkan Ümütlü">
    <meta name="owner" content="Berkan Ümütlü">
    <meta name="url" content="https://github.com/berkanumutlu">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="assets/plugins/highlight.js/styles/default.min.css" rel="stylesheet">
    <link href="assets/web/css/style.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card my-5">
                <div class="card-header d-flex align-items-center">
                    <img src="assets/web/images/edevlet.png" class="me-2" width="42" height="32" alt="E-Devlet Logo">
                    <h1 class="mb-0 fs-4 fw-semibold">Turkey Address</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="select-section select-section-city">
                                <label for="city">Suburb/City/State/Province/Region</label>
                                <select id="city" name="city" class="select2 select-city">
                                    <option value="">Suburb/City/State/Province/Region</option>
                                </select>
                                <div class="code-block-section result-section result-city">
                                    <div class="code-block-header">
                                        <small class="code-block-header-title">
                                            <a href="javascript:;" class="code-block-view-button">
                                                <span class="city_name"></span> towns JSON <i
                                                        class="arrow arrow-right ms-1"></i></a></small>
                                        <div class="code-block-button-wrapper">
                                            <?php include 'assets/components/web/_button_copy_to_clipboard.html'; ?>
                                        </div>
                                    </div>
                                    <div class="code-block-content">
                                        <pre class="code-block-pre"><code class="language-json"></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="select-section select-section-town">
                                <label for="town">Town</label>
                                <select id="town" name="town" class="select2 select-town">
                                    <option value="">Town</option>
                                </select>
                                <div class="code-block-section result-section result-town">
                                    <div class="code-block-header">
                                        <small class="code-block-header-title">
                                            <a href="javascript:;" class="code-block-view-button">
                                                <span class="town_name"></span> districts JSON <i
                                                        class="arrow arrow-right ms-1"></i></a></small>
                                        <div class="code-block-button-wrapper">
                                            <?php include 'assets/components/web/_button_copy_to_clipboard.html'; ?>
                                        </div>
                                    </div>
                                    <div class="code-block-content">
                                        <pre class="code-block-pre"><code class="language-json"></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="select-section select-section-district">
                                <label for="district">District</label>
                                <select id="district" name="district" class="select2 select-district">
                                    <option value="">District</option>
                                </select>
                                <div class="code-block-section result-section result-district">
                                    <div class="code-block-header">
                                        <small class="code-block-header-title">
                                            <a href="javascript:;" class="code-block-view-button">
                                                <span class="district_name"></span> neighbourhoods JSON <i
                                                        class="arrow arrow-right ms-1"></i></a></small>
                                        <div class="code-block-button-wrapper">
                                            <?php include 'assets/components/web/_button_copy_to_clipboard.html'; ?>
                                        </div>
                                    </div>
                                    <div class="code-block-content">
                                        <pre class="code-block-pre"><code class="language-json"></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="select-section select-section-neighbourhood">
                                <label for="neighbourhood">Neighbourhood/Village</label>
                                <select id="neighbourhood" name="neighbourhood" class="select2 select-neighbourhood">
                                    <option value="">Neighbourhood/Village</option>
                                </select>
                                <div class="code-block-section result-section result-neighbourhood">
                                    <div class="code-block-header">
                                        <small class="code-block-header-title">
                                            <a href="javascript:;" class="code-block-view-button">
                                                <span class="neighbourhood_name"></span> streets JSON <i
                                                        class="arrow arrow-right ms-1"></i></a></small>
                                        <div class="code-block-button-wrapper">
                                            <?php include 'assets/components/web/_button_copy_to_clipboard.html'; ?>
                                        </div>
                                    </div>
                                    <div class="code-block-content">
                                        <pre class="code-block-pre"><code class="language-json"></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="select-section select-section-street mb-4">
                                <label for="street">Street/Avenue</label>
                                <select id="street" name="street" class="select2 select-street">
                                    <option value="">Street/Avenue</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-section-street-no mb-3">
                                <label for="street_no" class="form-label">Street No</label>
                                <input type="text" id="street_no" name="street_no" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-section-floor mb-3">
                                <label for="floor" class="form-label">Floor</label>
                                <input type="text" id="floor" name="floor" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-section-flat-no mb-3">
                                <label for="flat_no" class="form-label">Flat No</label>
                                <input type="text" id="flat_no" name="flat_no" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="code-block-section code-block-section-primary result-section result-address">
                                <hr>
                                <div class="code-block-header">
                                    <small class="code-block-header-title fw-bold">Address</small>
                                    <div class="code-block-button-wrapper">
                                        <?php include 'assets/components/web/_button_copy_to_clipboard.html'; ?>
                                    </div>
                                </div>
                                <div class="code-block-content">
                                    <pre class="code-block-pre"><code class="language-json"></code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-body-secondary">
                    <p class="mb-0">Copyright © 2023
                        <a href="https://github.com/berkanumutlu" target="_blank">Berkan Ümütlü</a>. All Right Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/plugins/jquery/jquery-3.7.1.min.js"></script>
<script src="assets/plugins/popperjs/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/highlight.js/highlight.min.js"></script>
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script src="assets/web/js/main.js"></script>
</body>
</html>
