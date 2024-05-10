var ajax_url = "ajax.php";
var result_address = $(".result-address");
var select_city = $(".select2.select-city");
var result_city = $(".result-city");
var select_section_town = $(".select-section.select-section-town");
var select_town = $(".select2.select-town");
var result_town = $(".result-town");
var select_section_district = $(".select-section.select-section-district");
var select_district = $(".select2.select-district");
var result_district = $(".result-district");
var select_section_neighbourhood = $(".select-section.select-section-neighbourhood");
var select_neighbourhood = $(".select2.select-neighbourhood");
var result_neighbourhood = $(".result-neighbourhood");
var select_section_street = $(".select-section.select-section-street");
var select_street = $(".select2.select-street");
var result_street = $(".result-street");
var input_section_street_no = $(".input-section-street-no");
var input_section_floor = $(".input-section-floor");
var input_section_flat_no = $(".input-section-flat-no");
var select2_properties = {
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
    input_section_street_no.hide();
    input_section_floor.hide();
    input_section_flat_no.hide();
}

function showSelectMenu(select_item, result_item) {
    select_item.show();
    result_item.show();
    if (result_item.find('code').length > 0) {
        //result_item.find('code').attr('data-highlighted', null);
        delete result_item.find('code')[0].dataset.highlighted;
        hljs.highlightElement(result_item.find('code')[0]);
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text);
}

function showAddressText() {
    var address = '';
    var city = select_city.select2("data")[0].name;
    var town = select_town.select2("data")[0].name;
    var district = select_district.select2("data")[0].name;
    var neighbourhood = select_neighbourhood.select2("data")[0].name;
    var zip_code = select_neighbourhood.select2("data")[0].zip_code;
    var street = select_street.select2("data")[0].name;
    var street_no = input_section_street_no.find('input').val().trim();
    var floor = input_section_floor.find('input').val().trim().replace('.', '');
    var flat_no = input_section_flat_no.find('input').val().trim();

    if (neighbourhood !== undefined && neighbourhood !== '') {
        address += neighbourhood + ", ";
    }
    if (street !== undefined && street !== '') {
        address += street + ", ";
    }
    if (street_no !== undefined && street_no !== '') {
        if ($.isNumeric(street_no)) {
            address += "No: " + street_no;
            if (flat_no === undefined || flat_no === '') {
                address += ', ';
            }
        } else {
            address += street_no + ', ';
        }
    }
    if (flat_no !== undefined && flat_no !== '') {
        if ($.isNumeric(flat_no)) {
            if ($.isNumeric(street_no)) {
                address += "/";
            } else {
                address += "Daire ";
            }
        } else {
            if (street_no !== undefined && street_no !== '' && $.isNumeric(street_no)) {
                address += ', ';
            }
        }
        address += flat_no + ", ";
    }
    if (floor !== undefined && floor !== '') {
        if ($.isNumeric(floor)) {
            address += floor + ". KAT";
        } else {
            address += floor;
        }
        address += ", ";
    }
    if (district !== undefined && district !== '') {
        address += district + ", ";
    }
    if (town !== undefined && town !== '') {
        address += town + "/";
    }
    if (city !== undefined && city !== '') {
        address += city + " ";
    }
    if (zip_code !== undefined && zip_code !== '') {
        address += zip_code;
    }

    result_address.find('code').text(address);
    result_address.show();
}

function showAddressTextWithTimeout() {
    if (timeout !== undefined && timeout !== null) {
        clearTimeout(timeout);
    }
    var timeout = setTimeout(function () {
        showAddressText();
    }, 100);
}

$(document).ready(function () {
    hljs.highlightAll();
    //Select2 input events
    select_city.select2(select2_properties);
    select_city.on('select2:select', function (e) {
        e.preventDefault();
        result_address.hide();
        resetSelectMenu(select_town, result_town);
        resetSelectMenu(select_district, result_district);
        resetSelectMenu(select_neighbourhood, result_neighbourhood);
        resetSelectMenu(select_street, result_street);
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
        result_address.hide();
        if (e.params.hasOwnProperty('city_id') && Number.isInteger(e.params.city_id)) {
            let props = select2_properties;
            props.placeholder = 'Turkey Towns';
            props.ajax.data = function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    get_town_list: 1,
                    city_id: e.params.city_id
                };
            };
            select_town.select2(props);
        }
    });
    select_town.on('select2:select', function (e) {
        e.preventDefault();
        result_address.hide();
        resetSelectMenu(select_district, result_district);
        resetSelectMenu(select_neighbourhood, result_neighbourhood);
        resetSelectMenu(select_street, result_street);
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
        result_address.hide();
        if ((e.params.hasOwnProperty('city_id') && Number.isInteger(e.params.city_id)) && e.params.hasOwnProperty('town_id') && Number.isInteger(e.params.town_id)) {
            let props = select2_properties;
            props.placeholder = 'Turkey Districts';
            props.ajax.data = function (params) {
                return {
                    q: params.term,
                    page: params.page,
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
        result_address.hide();
        resetSelectMenu(select_neighbourhood, result_neighbourhood);
        resetSelectMenu(select_street, result_street);
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
        result_address.hide();
        if ((e.params.hasOwnProperty('city_id') && Number.isInteger(e.params.city_id)) && (e.params.hasOwnProperty('town_id') && Number.isInteger(e.params.town_id))) {
            let props = select2_properties;
            props.placeholder = 'Turkey Neighbourhoods';
            props.ajax.data = function (params) {
                return {
                    q: params.term,
                    page: params.page,
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
        resetSelectMenu(select_street, result_street);
        if (e.params.hasOwnProperty('data')) {
            var item = e.params.data;
            result_neighbourhood.find('.neighbourhood_name').text(formatSelectItemSelection(item));
            if (item.hasOwnProperty('streets')) {
                result_neighbourhood.find('code').html(JSON.stringify(item.streets, null, "  "));
            }
            if (item.hasOwnProperty('id')) {
                select_street.trigger({
                    type: 'select2:clear',
                    params: {
                        city_id: item.city_id,
                        town_id: item.town_id,
                        district_id: item.district_id,
                        neighbourhood_id: item.id,
                        zip_code: item.zip_code
                    }
                });
                showSelectMenu(select_section_street, result_neighbourhood);
            }
        } else {
            result_address.hide();
        }
    });
    select_street.on('select2:clear', function (e) {
        e.preventDefault();
        result_address.hide();
        if ((e.params.hasOwnProperty('city_id') && Number.isInteger(e.params.city_id)) && (e.params.hasOwnProperty('town_id') && Number.isInteger(e.params.town_id)) && (e.params.hasOwnProperty('neighbourhood_id') && Number.isInteger(e.params.neighbourhood_id))) {
            let props = select2_properties;
            props.placeholder = 'Turkey Streets';
            props.ajax.data = function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    get_street_list: 1,
                    city_id: e.params.city_id,
                    town_id: e.params.town_id,
                    district_id: e.params.district_id,
                    neighbourhood_id: e.params.neighbourhood_id,
                    zip_code: e.params.zip_code
                };
            };
            select_street.select2(props);
        }
    });
    select_street.on('select2:select', function (e) {
        e.preventDefault();
        result_address.hide();
        if (e.params.hasOwnProperty('data')) {
            var item = e.params.data;
            if (item.hasOwnProperty('id')) {
                showAddressText();
                input_section_street_no.show();
                input_section_floor.show();
                input_section_flat_no.show();
            }
        }
    });
    $(".input-section-street-no input").on("input", showAddressTextWithTimeout);
    $(".input-section-floor input").on('input', showAddressTextWithTimeout);
    $(".input-section-flat-no input").on('input', showAddressTextWithTimeout);
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