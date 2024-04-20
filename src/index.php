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
    <link href="assets/web/style.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card my-5">
                <div class="card-header d-flex align-items-center">
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
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="code-block-section result-section result-address">
                                <hr>
                                <div class="code-block-header">
                                    <small class="code-block-header-title fw-bold">Address</small>
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
<script>
    function formatSelectItem(item) {
        if (item.loading) {
            return item.name;
        }
        var $container = $(
            "<div class='select2-result-ajax clearfix'>" +
            "<div class='select2-result-ajax__title'></div>" +
            "</div>"
        );
        $container.find(".select2-result-ajax__title").text(formatSelectItemSelection(item));
        return $container;
    }

    function formatSelectItemSelection(item) {
        let element = '';
        if (item.hasOwnProperty('name')) {
            if (item.hasOwnProperty('plate_code')) {
                element = item.plate_code + ' - ' + item.name;
            } else if (item.hasOwnProperty('zip_code')) {
                element = item.zip_code + ' - ' + item.name;
            } else {
                element = item.name;
            }
        } else if (item.hasOwnProperty('text')) {
            element = item.text;
        }
        return element;
    }

    function resetSelectMenu(select_item, result_item) {
        select_item.val(null).empty().trigger("change");
        result_item.find('.city_name').text("");
        result_item.find('.town_name').text("");
        result_item.find('.district_name').text("");
        result_item.find('.neighbourhood_name').text("");
        result_item.find('code').html("");
        result_item.hide("");
        select_item.parent('.select-section').hide();
    }

    function showSelectMenu(select_item, result_item) {
        select_item.show();
        result_item.show();
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
    }

    $(document).ready(function () {
        hljs.highlightAll();
        var ajax_url = "ajax.php";
        let result_address = $(".result-address");
        let select_city = $(".select2.select-city");
        let result_city = $(".result-city");
        let select_section_town = $(".select-section.select-section-town");
        let select_town = $(".select2.select-town");
        let result_town = $(".result-town");
        let select_section_district = $(".select-section.select-section-district");
        let select_district = $(".select2.select-district");
        let result_district = $(".result-district");
        let select_section_neighbourhood = $(".select-section.select-section-neighbourhood");
        let select_neighbourhood = $(".select2.select-neighbourhood");
        let result_neighbourhood = $(".result-neighbourhood");
        let select2_properties = {
            width: '100%',
            language: 'en',
            placeholder: 'Turkey Cities',
            ajax: {
                url: ajax_url,
                type: "POST",
                dataType: "JSON",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        get_city_list: 1
                    };
                },
                processResults: function (response, params) {
                    let total = 0;
                    let data = [{'name': 'None'}];
                    if (response.hasOwnProperty('status') && response.status) {
                        if (response.hasOwnProperty('data')) {
                            if (response.data.hasOwnProperty('total')) {
                                total = response.data.total
                            }
                            if (response.data.hasOwnProperty('items')) {
                                data = response.data.items;
                            }
                        }
                    }
                    params.page = params.page || 1;
                    return {
                        results: data,
                        pagination: {
                            more: (params.page * 41) < total
                        }
                    };
                },
                cache: true,
                formatNoMatches: "No matches",
                formatSearching: "Searching..."
            },
            /*minimumInputLength: 3,
            minimumResultsForSearch: 3,*/
            templateResult: formatSelectItem,
            templateSelection: formatSelectItemSelection
        };
        //Select2 input events
        select_city.select2(select2_properties);
        select_city.on('select2:select', function (e) {
            e.preventDefault();
            resetSelectMenu(select_town, result_town);
            resetSelectMenu(select_district, result_district);
            resetSelectMenu(select_neighbourhood, result_neighbourhood);
            if (e.params.hasOwnProperty('data')) {
                var item = e.params.data;
                result_city.find('.city_name').text(formatSelectItemSelection(item));
                if (item.hasOwnProperty('towns')) {
                    result_city.find('code').html(JSON.stringify(item.towns, null, "  "));
                }
                if (item.hasOwnProperty('id')) {
                    select_town.trigger({
                        type: 'select2:clear',
                        params: {
                            city_id: item.id
                        }
                    });
                    showSelectMenu(select_section_town, result_city);
                }
            }
        });
        select_town.on('select2:clear', function (e) {
            e.preventDefault();
            if (e.params.hasOwnProperty('city_id') && Number.isInteger(e.params.city_id)) {
                let props = select2_properties;
                props.placeholder = 'Turkey Towns';
                props.ajax.data = function (params) {
                    return {
                        q: params.term,
                        get_town_list: 1,
                        city_id: e.params.city_id
                    };
                };
                select_town.select2(props);
            }
        });
        select_town.on('select2:select', function (e) {
            e.preventDefault();
            resetSelectMenu(select_district, result_district);
            resetSelectMenu(select_neighbourhood, result_neighbourhood);
            if (e.params.hasOwnProperty('data')) {
                var item = e.params.data;
                result_town.find('.town_name').text(formatSelectItemSelection(item));
                if (item.hasOwnProperty('districts')) {
                    result_town.find('code').html(JSON.stringify(item.districts, null, "  "));
                }
                if (item.hasOwnProperty('id')) {
                    select_district.trigger({
                        type: 'select2:clear',
                        params: {
                            city_id: item.city_id,
                            town_id: item.id
                        }
                    });
                    showSelectMenu(select_section_district, result_town);
                }
            }
        });
        select_district.on('select2:clear', function (e) {
            e.preventDefault();
            if ((e.params.hasOwnProperty('city_id') && Number.isInteger(e.params.city_id)) && e.params.hasOwnProperty('town_id') && Number.isInteger(e.params.town_id)) {
                let props = select2_properties;
                props.placeholder = 'Turkey Districts';
                props.ajax.data = function (params) {
                    return {
                        q: params.term,
                        get_district_list: 1,
                        city_id: e.params.city_id,
                        town_id: e.params.town_id
                    };
                };
                select_district.select2(props);
            }
        });
        select_district.on('select2:select', function (e) {
            e.preventDefault();
            resetSelectMenu(select_neighbourhood, result_neighbourhood);
            if (e.params.hasOwnProperty('data')) {
                var item = e.params.data;
                result_district.find('.district_name').text(formatSelectItemSelection(item));
                if (item.hasOwnProperty('neighbourhoods')) {
                    result_district.find('code').html(JSON.stringify(item.neighbourhoods, null, "  "));
                }
                if (item.hasOwnProperty('id')) {
                    select_neighbourhood.trigger({
                        type: 'select2:clear',
                        params: {
                            city_id: item.city_id,
                            town_id: item.town_id,
                            district_id: item.id
                        }
                    });
                    showSelectMenu(select_section_neighbourhood, result_district);
                }
            }
        });
        select_neighbourhood.on('select2:clear', function (e) {
            e.preventDefault();
            if ((e.params.hasOwnProperty('city_id') && Number.isInteger(e.params.city_id)) && e.params.hasOwnProperty('town_id') && Number.isInteger(e.params.town_id)) {
                let props = select2_properties;
                props.placeholder = 'Turkey Neighbourhoods';
                props.ajax.data = function (params) {
                    return {
                        q: params.term,
                        get_neighbourhood_list: 1,
                        city_id: e.params.city_id,
                        town_id: e.params.town_id,
                        district_id: e.params.district_id
                    };
                };
                select_neighbourhood.select2(props);
            }
        });
        select_neighbourhood.on('select2:select', function (e) {
            e.preventDefault();
            if (e.params.hasOwnProperty('data')) {
                var item = e.params.data;
                var city = select_city.select2("data")[0].name;
                var town = select_town.select2("data")[0].name;
                var district = select_district.select2("data")[0].name;
                var neighbourhood = item.name;
                var zip_code = item.zip_code;
                result_address.find('code').text(neighbourhood + ", " + district + ", " + town + "/" + city + " " + zip_code);
                result_address.show();
            }
        });
        //Show/Hide code block section
        $(".code-block-view-button").on('click', function (e) {
            e.preventDefault();
            let arrow_icon = $(this).find('i.arrow');
            if (arrow_icon.hasClass("arrow-right")) {
                arrow_icon.removeClass("arrow-right").addClass("arrow-down");
            } else {
                arrow_icon.removeClass("arrow-down").addClass("arrow-right");
            }
            $(this).parents('.code-block-section').find('.code-block-content').stop().slideToggle(1000);
        });
        //Copy to clipboard button with tooltip text
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        $(".btn-copy-clipboard").on('click', function (e) {
            var $this = $(this)
            const tooltipInstance = bootstrap.Tooltip.getInstance($this);
            copyToClipboard($this.parents('.code-block-section').find('.code-block-content code').text());
            tooltipInstance.setContent({'.tooltip-inner': 'Copied!'});
            $this.tooltip("show");
            setTimeout(function () {
                $this.tooltip("hide");
                tooltipInstance.setContent({'.tooltip-inner': $this.attr('aria-label')});
            }, 2500);
            e.preventDefault();
        });
    });
</script>
</body>
</html>
