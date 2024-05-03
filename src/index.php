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
                                            <button class="btn nohighlight btn-copy-clipboard mt-0 me-0"
                                                    aria-label="Copy to clipboard"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Copy to clipboard">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="#444"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 2C7.44772 2 7 2.44772 7 3C7 3.55228 7.44772 4 8 4H10C10.5523 4 11 3.55228 11 3C11 2.44772 10.5523 2 10 2H8Z"
                                                          fill="#444"></path>
                                                    <path
                                                            d="M3 5C3 3.89543 3.89543 3 5 3C5 4.65685 6.34315 6 8 6H10C11.6569 6 13 4.65685 13 3C14.1046 3 15 3.89543 15 5V11H10.4142L11.7071 9.70711C12.0976 9.31658 12.0976 8.68342 11.7071 8.29289C11.3166 7.90237 10.6834 7.90237 10.2929 8.29289L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071L10.2929 15.7071C10.6834 16.0976 11.3166 16.0976 11.7071 15.7071C12.0976 15.3166 12.0976 14.6834 11.7071 14.2929L10.4142 13H15V16C15 17.1046 14.1046 18 13 18H5C3.89543 18 3 17.1046 3 16V5Z"
                                                            fill="#444"></path>
                                                    <path
                                                            d="M15 11H17C17.5523 11 18 11.4477 18 12C18 12.5523 17.5523 13 17 13H15V11Z"
                                                            fill="#444"></path>
                                                </svg>
                                            </button>
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
                                            <button class="btn nohighlight btn-copy-clipboard mt-0 me-0"
                                                    aria-label="Copy to clipboard"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Copy to clipboard">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="#444"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 2C7.44772 2 7 2.44772 7 3C7 3.55228 7.44772 4 8 4H10C10.5523 4 11 3.55228 11 3C11 2.44772 10.5523 2 10 2H8Z"
                                                          fill="#444"></path>
                                                    <path
                                                            d="M3 5C3 3.89543 3.89543 3 5 3C5 4.65685 6.34315 6 8 6H10C11.6569 6 13 4.65685 13 3C14.1046 3 15 3.89543 15 5V11H10.4142L11.7071 9.70711C12.0976 9.31658 12.0976 8.68342 11.7071 8.29289C11.3166 7.90237 10.6834 7.90237 10.2929 8.29289L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071L10.2929 15.7071C10.6834 16.0976 11.3166 16.0976 11.7071 15.7071C12.0976 15.3166 12.0976 14.6834 11.7071 14.2929L10.4142 13H15V16C15 17.1046 14.1046 18 13 18H5C3.89543 18 3 17.1046 3 16V5Z"
                                                            fill="#444"></path>
                                                    <path
                                                            d="M15 11H17C17.5523 11 18 11.4477 18 12C18 12.5523 17.5523 13 17 13H15V11Z"
                                                            fill="#444"></path>
                                                </svg>
                                            </button>
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
                                            <button class="btn nohighlight btn-copy-clipboard mt-0 me-0"
                                                    aria-label="Copy to clipboard"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Copy to clipboard">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="#444"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 2C7.44772 2 7 2.44772 7 3C7 3.55228 7.44772 4 8 4H10C10.5523 4 11 3.55228 11 3C11 2.44772 10.5523 2 10 2H8Z"
                                                          fill="#444"></path>
                                                    <path
                                                            d="M3 5C3 3.89543 3.89543 3 5 3C5 4.65685 6.34315 6 8 6H10C11.6569 6 13 4.65685 13 3C14.1046 3 15 3.89543 15 5V11H10.4142L11.7071 9.70711C12.0976 9.31658 12.0976 8.68342 11.7071 8.29289C11.3166 7.90237 10.6834 7.90237 10.2929 8.29289L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071L10.2929 15.7071C10.6834 16.0976 11.3166 16.0976 11.7071 15.7071C12.0976 15.3166 12.0976 14.6834 11.7071 14.2929L10.4142 13H15V16C15 17.1046 14.1046 18 13 18H5C3.89543 18 3 17.1046 3 16V5Z"
                                                            fill="#444"></path>
                                                    <path
                                                            d="M15 11H17C17.5523 11 18 11.4477 18 12C18 12.5523 17.5523 13 17 13H15V11Z"
                                                            fill="#444"></path>
                                                </svg>
                                            </button>
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
                                            <button class="btn nohighlight btn-copy-clipboard mt-0 me-0"
                                                    aria-label="Copy to clipboard"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Copy to clipboard">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="#444"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 2C7.44772 2 7 2.44772 7 3C7 3.55228 7.44772 4 8 4H10C10.5523 4 11 3.55228 11 3C11 2.44772 10.5523 2 10 2H8Z"
                                                          fill="#444"></path>
                                                    <path
                                                            d="M3 5C3 3.89543 3.89543 3 5 3C5 4.65685 6.34315 6 8 6H10C11.6569 6 13 4.65685 13 3C14.1046 3 15 3.89543 15 5V11H10.4142L11.7071 9.70711C12.0976 9.31658 12.0976 8.68342 11.7071 8.29289C11.3166 7.90237 10.6834 7.90237 10.2929 8.29289L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071L10.2929 15.7071C10.6834 16.0976 11.3166 16.0976 11.7071 15.7071C12.0976 15.3166 12.0976 14.6834 11.7071 14.2929L10.4142 13H15V16C15 17.1046 14.1046 18 13 18H5C3.89543 18 3 17.1046 3 16V5Z"
                                                            fill="#444"></path>
                                                    <path
                                                            d="M15 11H17C17.5523 11 18 11.4477 18 12C18 12.5523 17.5523 13 17 13H15V11Z"
                                                            fill="#444"></path>
                                                </svg>
                                            </button>
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
                                        <button class="btn nohighlight btn-copy-clipboard mt-0 me-0"
                                                aria-label="Copy to clipboard"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Copy to clipboard">
                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 2C7.44772 2 7 2.44772 7 3C7 3.55228 7.44772 4 8 4H10C10.5523 4 11 3.55228 11 3C11 2.44772 10.5523 2 10 2H8Z"
                                                      fill="#444"></path>
                                                <path
                                                        d="M3 5C3 3.89543 3.89543 3 5 3C5 4.65685 6.34315 6 8 6H10C11.6569 6 13 4.65685 13 3C14.1046 3 15 3.89543 15 5V11H10.4142L11.7071 9.70711C12.0976 9.31658 12.0976 8.68342 11.7071 8.29289C11.3166 7.90237 10.6834 7.90237 10.2929 8.29289L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071L10.2929 15.7071C10.6834 16.0976 11.3166 16.0976 11.7071 15.7071C12.0976 15.3166 12.0976 14.6834 11.7071 14.2929L10.4142 13H15V16C15 17.1046 14.1046 18 13 18H5C3.89543 18 3 17.1046 3 16V5Z"
                                                ></path>
                                                <path
                                                        d="M15 11H17C17.5523 11 18 11.4477 18 12C18 12.5523 17.5523 13 17 13H15V11Z"
                                                ></path>
                                            </svg>
                                        </button>
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
