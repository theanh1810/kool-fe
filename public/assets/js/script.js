// const { remove } = require("lodash");

// const { forEach } = require("lodash");

$(document).ready(function () {
    //Handle Timer -------------
    //Format date and tim

    $(".owl__u-need").owlCarousel({
        margin: 20,
        items: 4, //10 items above 1000px browser width
        responsive: {
            0: {
                items: 1,
                nav: true,
                dots: false,
            },
            600: {
                items: 2,
                nav: false,
                dots: true,
            },
            1000: {
                items: 4,
                nav: false,
                dots: true,
            },
        },
    });

    $(".owl__u-need-small-detail").owlCarousel({
        margin: 10,
        items: 3, //10 items above 1000px browser width
        responsive: {
            0: {
                items: 3,
                nav: true,
                dots: false,
            },
            600: {
                items: 3,
                nav: true,
                dots: false,
            },
            1000: {
                items: 3,
                nav: true,
                dots: false,
            },
        },
        nav: true,
    });

    $(".qty__plus").click(function () {
        // Lấy giá trị hiện tại trong ô input
        var currentValue = parseInt($(".qty__number").val());
        // Tăng giá trị lên 1
        if (currentValue < 100) {
            var newValue = currentValue + 1;
        }
        if (currentValue >= 100) {
            var newValue = 100;
        }
        // Cập nhật giá trị mới vào ô input
        $(".qty__number").val(newValue);
    });

    $(".qty__minus").click(function () {
        // Lấy giá trị hiện tại trong ô input
        var currentValue = parseInt($(".qty__number").val());
        // Tăng giá trị lên 1
        // Giam giá trị xuong 1
        if (currentValue >= 1) {
            var newValue = currentValue - 1;
        }
        if (currentValue <= 1) {
            var newValue = 1;
        }
        // Cập nhật giá trị mới vào ô input
        $(".qty__number").val(newValue);
    });

    var slider__column = $(".slider__column");

    slider__column.click(function () {
        slider__column.removeClass("border__slider-active");
        $(this).addClass("border__slider-active");
    });
});

$(document).ready(function () {
    var sync1 = $("#owl-main");
    var sync2 = $("#owl__column-main");
    var slidesPerPage = 3; //globaly define number of elements per page
    var syncedSecondary = true;

    sync1
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            responsive: {
                0: {
                    items: 1,
                },
                450: {
                    items: 1,
                },
                1000: {
                    items: 1,
                },
            },
        })
        .on("changed.owl.carousel", syncPosition);

    sync2
        .on("initialized.owl.carousel", function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            stagePadding: 20,
            items: slidesPerPage,
            dots: false,
            nav: true,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 100,
            responsive: {
                0: {
                    items: 3,
                },
                450: {
                    items: 3,
                },
                1000: {
                    items: 3,
                },
            },
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find(".owl-item.active").length - 1;
        var start = sync2.find(".owl-item.active").first().index();
        var end = sync2.find(".owl-item.active").last().index();

        if (current > end) {
            sync2.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
            sync2.data("owl.carousel").to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data("owl.carousel").to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data("owl.carousel").to(number, 300, true);
    });

    $(".owl__category-small").owlCarousel({
        margin: 10,
        items: 3, //10 items above 1000px browser width
        itemsDesktop: [1000, 2], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 2], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0;
        itemsMobile: [450, 3], // itemsMobile disabled - inherit from itemsTablet option
        nav: true,
        dots: false,
    });

    $("#price__filter-input").ionRangeSlider({
        // min value
        min: 0,
        // max value
        max: 5000000,
        // overwrite default FROM setting
        from: $("#price__filter-input").data("from"),
        // overwrite default TO setting
        // Choose slider type,
        // could be single - for one handle, or double four two handles
        type: "double",
        // slider step
        step: 10000,
        // Set minimum diapason between sliders.
        min_interval: 100000,
        // Set maximum diapason between sliders.
        max_interval: 5000000,
        // Allow user to drag whole range.
        drag_interval: false,
        keyboard: true,
        // Movement step, than controling from keyboard. In percents.
        keyboard_step: 10000,
        prefix: "",
        // postfix value
        postfix: "vnd",
    });

    $(".plus__icon-category").on("click", function (e) {
        e.preventDefault();
        if (window.innerWidth > 480) {
            $(".plus__icon-category>i").toggleClass("bi-plus bi-dash");
            if ($("#open__filter-id").hasClass("filter-hidden")) {
                $(".category").stop().animate(
                    {
                        width: "77%",
                        marginLeft: "23%",
                    },
                    { duration: 1000 },
                    "linear"
                );
                $("#open__filter-id").stop().animate(
                    {
                        opacity: "1",
                    },
                    { duration: 1000 },
                    "linear"
                );
                $("#open__filter-id").removeClass("filter-hidden");
                $(".owl__category-small").addClass("owl-open");
                $("#open__filter-id").addClass("open__filter");
                $(".detail__category").addClass("category__open");
                $(".group__load-more").addClass("load_more_open");
                $(".close-filter-cate").addClass("hidden");
            } else {
                $("#open__filter-id")
                    .stop()
                    .animate(
                        {
                            opacity: "0",
                        },
                        { duration: 100 },
                        "linear",
                        function () {}
                    );
                $(".category").stop().animate(
                    {
                        width: "100%",
                        marginLeft: "0%",
                    },
                    { duration: 1000 },
                    "linear"
                );

                $("#open__filter-id").addClass("filter-hidden");
                $(".group__load-more").removeClass("load_more_open");
                $(".owl__category-small").removeClass("owl-open");
                $(".detail__category").removeClass("category__open");
                $("#open__filter-id").removeClass("open__filter");
            }
        } else {
        }
    });

    if (window.innerWidth < 480) {
        $(".plus__icon-category").on("click", function (e) {
            e.preventDefault();
            $("#open__filter-id").stop().animate(
                {
                    left: 0,
                    opacity: 1,
                },
                { duration: 500 },
                "linear"
            );
            $(".close-filter-cate").removeClass("hidden");
            $(".owl__category-small").addClass("owl-open");
            $("#open__filter-id").addClass("open__filter");
            $(".detail__category").addClass("category__open");
            $(".group__load-more").addClass("load_more_open");
            $(".con-filter").addClass("open");
        });
        $(".close-filter-cate>i").on("click", function (e) {
            e.preventDefault();

            $("#open__filter-id").stop().animate(
                {
                    opacity: 0,
                    left: -600,
                },
                { duration: 1000 },
                "linear"
            );
            $(".close-filter-cate").addClass("hidden");
            $(".group__load-more").removeClass("load_more_open");
            $(".owl__category-small").removeClass("owl-open");
            $(".detail__category").removeClass("category__open");
            $("#open__filter-id").removeClass("open__filter");
            $(".con-filter").removeClass("open");
        });
    }

    $(".filter__btn-sex").on("click", function () {
        $(".filter__btn-sex>i").toggleClass(
            "bi-caret-down-fill bi-caret-up-fill"
        );
        if ($(".filter__by-sex").hasClass("sex-close")) {
            $(".filter__by-sex").removeClass("sex-close");
            $(".filter__by-sex")
                .stop()
                .animate(
                    { height: "225px" },
                    500,
                    "easeInOutCubic",
                    function () {
                        $(".filter__by-sex")
                            .stop()
                            .animate(
                                {
                                    borderWidth: "0",
                                    borderColor: "#000000",
                                },
                                1,
                                "easeInOutCubic",
                                function () {
                                    $(".filter__by--sex-item").stop().animate(
                                        {
                                            opacity: "1",
                                        },
                                        100,
                                        "easeInOutCubic"
                                    );
                                }
                            );
                    }
                );
        } else {
            $(".filter__by-sex").addClass("sex-close");
            $(".filter__by-sex")
                .stop()
                .animate(
                    {
                        borderWidth: "1px",
                        borderColor: "#00000020",
                        borderStyle: "solid",
                    },
                    1,
                    "easeInOutCubic",
                    function () {
                        $(".filter__by--sex-item")
                            .stop()
                            .animate(
                                {
                                    opacity: "0",
                                },
                                100,
                                "easeInOutCubic",
                                function () {
                                    $(".filter__by-sex")
                                        .stop()
                                        .animate(
                                            { height: "35px" },
                                            500,
                                            "easeInOutCubic"
                                        );
                                }
                            );
                    }
                );
        }
    });

    $(".filter__btn-format").on("click", function () {
        $(".filter__btn-format>i").toggleClass(
            "bi-caret-down-fill bi-caret-up-fill"
        );
        if ($(".filter__by-format").hasClass("format-close")) {
            $(".filter__by-format").removeClass("format-close");
            $(".filter__by-format")
                .stop()
                .animate(
                    { height: "360px" },
                    500,
                    "easeInOutCubic",
                    function () {
                        $(".filter__by-format")
                            .stop()
                            .animate(
                                {
                                    borderWidth: "0",
                                    borderColor: "#000000",
                                },
                                1,
                                "easeInOutCubic",
                                function () {
                                    $(".filter__by-format-item").stop().animate(
                                        {
                                            opacity: "1",
                                        },
                                        100,
                                        "easeInOutCubic"
                                    );
                                }
                            );
                    }
                );
        } else {
            $(".filter__by-format").addClass("format-close");
            $(".filter__by-format")
                .stop()
                .animate(
                    {
                        borderWidth: "1px",
                        borderColor: "#00000020",
                        borderStyle: "solid",
                    },
                    1,
                    "easeInOutCubic",
                    function () {
                        $(".filter__by-format-item")
                            .stop()
                            .animate(
                                {
                                    opacity: "0",
                                },
                                100,
                                "easeInOutCubic",
                                function () {
                                    $(".filter__by-format")
                                        .stop()
                                        .animate(
                                            { height: "35px" },
                                            500,
                                            "easeInOutCubic"
                                        );
                                }
                            );
                    }
                );
        }
    });

    $(".filter__btn-material").on("click", function () {
        $(".filter__btn-material>i").toggleClass(
            "bi-caret-down-fill bi-caret-up-fill"
        );
        if ($(".filter__by_material").hasClass("material-close")) {
            $(".filter__by_material").removeClass("material-close");
            $(".filter__by_material")
                .stop()
                .animate(
                    { height: "225px" },
                    500,
                    "easeInOutCubic",
                    function () {
                        $(".filter__by_material")
                            .stop()
                            .animate(
                                {
                                    borderWidth: "0",
                                    borderColor: "#000000",
                                },
                                1,
                                "easeInOutCubic",
                                function () {
                                    $(".filter__by_material-item")
                                        .stop()
                                        .animate(
                                            {
                                                opacity: "1",
                                            },
                                            100,
                                            "easeInOutCubic"
                                        );
                                }
                            );
                    }
                );
        } else {
            $(".filter__by_material").addClass("material-close");

            $(".filter__by_material")
                .stop()
                .animate(
                    {
                        borderWidth: "1px",
                        borderColor: "#00000020",
                        borderStyle: "solid",
                    },
                    1,
                    "easeInOutCubic",
                    function () {
                        $(".filter__by_material-item")
                            .stop()
                            .animate(
                                {
                                    opacity: "0",
                                },
                                100,
                                "easeInOutCubic",
                                function () {
                                    $(".filter__by_material")
                                        .stop()
                                        .animate(
                                            { height: "35px" },
                                            500,
                                            "easeInOutCubic"
                                        );
                                }
                            );
                    }
                );
        }
    });

    let aa = null;
    $("div.slider__item-u-need-small-detail").on("mouseover", function () {
        if (aa != null) clearTimeout(aa);
        let elm_hover_image = $(this)
            .closest(".slider__item-u-need")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".slider__item-u-need")
            .find(".slider__a-u-need");
        elm_hover_image.data("origin_img", elm_hover_image.attr("src"));
        elm_origin_img.attr(
            "src",
            $(this).find(".product_variant__item").data("image")
        );
    });
    $(".slider__item-u-need-small-detail").on("mouseleave", function () {
        let elm_hover_image = $(this)
            .closest(".slider__item-u-need")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".slider__item-u-need")
            .find(".slider__a-u-need");
        aa = setTimeout(function () {
            elm_origin_img.attr("src", elm_hover_image.data("origin_img"));
        }, 100);
    });

    $(".slider__item-u-need>a").on("mouseover", function () {
        $(this).find(".second-image").addClass("second-image-active");
    });

    $(".slider__item-u-need>a").on("mouseout", function () {
        $img_rotate = $(this).find(".second-image");
        if ($img_rotate.hasClass("second-image-active")) {
            $img_rotate.removeClass("second-image-active");
        }
    });

    $(".hover-img-location").on("mouseover", function () {
        $(this)
            .siblings("a")
            .find(".second-image")
            .addClass("second-image-active");
    });

    $(".hover-img-location").on("mouseout", function () {
        $img_rotate = $(this).siblings("a").find(".second-image");
        if ($img_rotate.hasClass("second-image-active")) {
            $img_rotate.removeClass("second-image-active");
        }
    });

    $(".link-pro-sale").on("mouseover", function () {
        var imgHover = $(this).find(".sale-product-img-holder >.second-image");
        imgHover.addClass("second-image-active");
    });

    $(".link-pro-sale").on("mouseout", function () {
        var imgHover = $(this).find(".sale-product-img-holder >.second-image");
        if (imgHover.hasClass("second-image-active")) {
            imgHover.removeClass("second-image-active");
        }
    });

    // slider category
    $(".slider__item-category-small").on("mouseover", function () {
        if (aa != null) clearTimeout(aa);
        let elm_hover_image = $(this)
            .closest(".group__category-item")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".group__category-item")
            .find(".cate-origin");
        elm_hover_image.data("origin_img", elm_hover_image.attr("src"));
        elm_origin_img.attr(
            "src",
            $(this).find(".product_vari_cate").data("image")
        );
    });
    $(".slider__item-category-small").on("mouseleave", function () {
        let elm_hover_image = $(this)
            .closest(".group__category-item")
            .find(".hover-image");
        let elm_origin_img = $(this)
            .closest(".group__category-item")
            .find(".cate-origin");
        aa = setTimeout(function () {
            elm_origin_img.attr("src", elm_hover_image.data("origin_img"));
        }, 100);
    });

    // add cart

    // Bắt sự kiện click trên nút "Thêm vào giỏ hàng"
    $(".add__to-cart").on("click", function (e) {
        e.preventDefault();
        var productId = $(".detail__pro-hidden").data("pro-id");
        var productPrv = $(".detail__prv-hidden").data("prv-id");
        var productName = $(".name__pro-hidden").data("name-pro");
        var productNameColor = $(".name__color-hidden").data("name-color");
        var productQty = $(".qty__number").val();
        var productPrice = $(".detail__pro-price-hidden").data("price-pro");
        var productImage = $(".detail__image-hidden").data("image-pro");
        var productBrand = $(".detail__brand-hidden").data("brand-pro");
        var priceSale = $(".price_sale").val();
        if (priceSale == 0) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: window.location.origin + "/add-to-cart", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
                data: {
                    productId: productId,
                    productPrv: productPrv,
                    productName: productName,
                    productNameColor: productNameColor,
                    productQty: productQty,
                    productPrice: productPrice,
                    productImage: productImage,
                    productBrand: productBrand,
                },
                success: function (data) {
                    $(".count__pro-cart").empty();
                    $(".count__pro-cart").append(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        } else if (priceSale > 0) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: window.location.origin + "/add-to-cart", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
                data: {
                    productId: productId,
                    productPrv: productPrv,
                    productName: productName,
                    productNameColor: productNameColor,
                    productQty: productQty,
                    productPrice: priceSale,
                    productImage: productImage,
                    productBrand: productBrand,
                },
                success: function (data) {
                    $(".count__pro-cart").empty();
                    $(".count__pro-cart").append(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        }
        // can toi uu code
        // Gọi AJAX để thêm sản phẩm vào giỏ hàng
    });

    $(".buy__now").on("click", function (e) {
        e.preventDefault();
        var productId = $(".detail__pro-hidden").data("pro-id");
        var productPrv = $(".detail__prv-hidden").data("prv-id");
        var productName = $(".name__pro-hidden").data("name-pro");
        var productNameColor = $(".name__color-hidden").data("name-color");
        var productQty = $(".qty__number").val();
        var productPrice = $(".detail__pro-price-hidden").data("price-pro");
        var productImage = $(".detail__image-hidden").data("image-pro");
        var productBrand = $(".detail__brand-hidden").data("brand-pro");
        var priceSale = $(".price_sale").val();
        if (priceSale == 0) {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: window.location.origin + "/buy-now", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
                data: {
                    productId: productId,
                    productPrv: productPrv,
                    productName: productName,
                    productNameColor: productNameColor,
                    productQty: productQty,
                    productPrice: productPrice,
                    productImage: productImage,
                    productBrand: productBrand,
                },
                success: function (data) {
                    $url = window.location.origin + "/purchase";
                    window.location.href = $url;
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        } else if (priceSale > 0) {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: window.location.origin + "/buy-now", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
                data: {
                    productId: productId,
                    productPrv: productPrv,
                    productName: productName,
                    productNameColor: productNameColor,
                    productQty: productQty,
                    productPrice: priceSale,
                    productImage: productImage,
                    productBrand: productBrand,
                },
                success: function (data) {
                    $url = window.location.origin + "/purchase";
                    window.location.href = $url;
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        }
        // can toi uu code
        // Gọi AJAX để thêm sản phẩm vào giỏ hàng
    });
    // remove product out cart
});

$(document).ready(function () {
    $("#city-select").on("change", function () {
        var selectedOption = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: window.location.origin + "/get-district", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
            data: {
                cityId: selectedOption,
            },
            success: function (data) {
                var district = Object.values(data).map(function (item) {
                    return item;
                });
                if ($("#district-select option").length > 1) {
                    $("#district-select, #ward-select").empty();
                    $("#district-select").append(
                        ' <option class="place_option" value="">Vui lòng chọn khu vực Quận/ Huyện</option>'
                    );
                    $("#ward-select").append(
                        ' <option class="place_option" value="">Vui lòng chọn khu vực Phường/ Xã</option>'
                    );
                }
                var optionDistrict;
                district.forEach(function (district) {
                    optionDistrict = `<option  value="${district.dis_id}">${district.dis_name}</option>`;
                    $("#district-select").append(optionDistrict);
                });
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });

    $("#district-select").on("change", function () {
        var selectedOption = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: window.location.origin + "/get-wards", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
            data: {
                districtId: selectedOption,
            },
            success: function (data) {
                var war = Object.values(data).map(function (item) {
                    return item;
                });
                if ($("#war-select option").length > 1) {
                    $("#ward-select").empty();
                    $("#ward-select").append(
                        ' <option class="place_option" value="">Vui lòng chọn khu vực Phường/ Xã</option>'
                    );
                }
                var optionWar;
                war.forEach(function (war) {
                    optionWar = `<option value="${war.war_id}">${war.war_name}</option>`;
                    $("#ward-select").append(optionWar);
                });
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });

    var arrCheckedMaterial = [];
    function updateMaterialItems() {
        arrCheckedMaterial = [];
        $(".filter__by_material-item").each(function () {
            if ($(this).hasClass("active")) {
                arrCheckedMaterial.push(
                    $(this).find(".material__input-hidden").val()
                );
            }
        });
    }
    $(".filter__by_material-item").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        } else {
            $(this).addClass("active");
        }
        updateMaterialItems();
    });
    var arrCheckedFormat = [];
    function updateFormatItems() {
        arrCheckedFormat = [];
        $(".filter__by-format-item").each(function () {
            if ($(this).hasClass("active")) {
                arrCheckedFormat.push(
                    $(this).find(".format__input-hidden").val()
                );
            }
        });
    }
    $(".filter__by-format-item").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        } else {
            $(this).addClass("active");
        }
        updateFormatItems();
        console.log(arrCheckedFormat);
    });

    var arrChecked = [];
    function updateSelectedItems() {
        arrChecked = [];
        $(".brand-checkbox:checked").each(function () {
            arrChecked.push($(this).val());
        });
    }
    $(".brand-checkbox").change(function () {
        updateSelectedItems();
    });

    $("#order__category-select").on("change", function () {
        var selectedOption = $(this).val();
        var catId = $(".category_id").val();
        var filterType = $(".filter_type").val();
        var valueFormatId = $(".filter__format-value-id").val();
        var valueMaterialId = $(".filter__material-value-id").val();
        $(".material__save-data").val(arrCheckedMaterial);
        $(".format__save-data").val(arrCheckedFormat);
        $(".brand__save-data").val(arrChecked);
        var priceRange = $("#price__filter-input").val();
        var priceRangeSplit = priceRange.split(";");
        if (priceRangeSplit.length === 2) {
            var min = parseInt(priceRangeSplit[0], 10); // Chuyển chuỗi thành số nguyên
            var max = parseInt(priceRangeSplit[1], 10); // Chuyển chuỗi thành số nguyên
        } else {
            console.log("Chuỗi không hợp lệ");
        }
        if (
            selectedOption == "asc" ||
            selectedOption == "desc" ||
            selectedOption == "new"
        ) {
            $(".order_type").val(1);
        } else if (selectedOption == "") {
            $(".order_type").val(0);
        }
        var orderType = $(".order_type").val();
        $(".order_value_filter").val(selectedOption);
        if (selectedOption == "") {
            window.location.reload();
        } else {
            $(".detail__category").stop().animate(
                {
                    opacity: "0",
                },
                { duration: 100 },
                "linear"
            );
            var proInfo = $(".pro_category_data").val();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: window.location.origin + "/order-cate", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
                data: {
                    orderValue: selectedOption,
                    catId: catId,
                    filterType: filterType,
                    minPrice: min,
                    maxPrice: max,
                    orderType: orderType,
                    valueMaterial: arrCheckedMaterial,
                    valueMaterialId: valueMaterialId,
                    valueFormat: arrCheckedFormat,
                    valueFormatId: valueFormatId,
                    brandValue: arrChecked,
                },
                success: function (data) {
                    $(".detail__category").empty();
                    $(".detail__category").append(data);
                    $("script").remove();
                    $(".detail__category").stop().animate(
                        {
                            opacity: "1",
                        },
                        { duration: 1000 },
                        "linear"
                    );
                    $(".btn__load-more").addClass("btn-width-cl");
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        }
    });

    $(".btn__filter-cate").on("click", function (e) {
        e.preventDefault();
        $(".filter_type").val(1);
        var filterValue = $(".filter_type").val();
        var catId = $(".category_id").val();
        var priceRange = $("#price__filter-input").val();
        var valueFormatId = $(".filter__format-value-id").val();
        var valueMaterialId = $(".filter__material-value-id").val();
        $(".material__save-data").val(arrCheckedMaterial);
        $(".format__save-data").val(arrCheckedFormat);
        $(".brand__save-data").val(arrChecked);
        var priceRangeSplit = priceRange.split(";");
        if (priceRangeSplit.length === 2) {
            var min = parseInt(priceRangeSplit[0], 10); // Chuyển chuỗi thành số nguyên
            var max = parseInt(priceRangeSplit[1], 10); // Chuyển chuỗi thành số nguyên
        } else {
            console.log("Chuỗi không hợp lệ");
        }
        var orderType = $(".order_type").val();
        var orderValue = $(".order_value_filter").val();
        $(".detail__category").stop().animate(
            {
                opacity: "0",
            },
            { duration: 100 },
            "linear"
        );
        $.ajax({
            type: "POST",
            dataType: "html",
            url: window.location.origin + "/filter", // Đường dẫn route để thêm sản phẩm vào giỏ hàng
            data: {
                catId: catId,
                minPrice: min,
                maxPrice: max,
                orderType: orderType,
                filterType: filterValue,
                orderValue: orderValue,
                valueMaterial: arrCheckedMaterial,
                valueMaterialId: valueMaterialId,
                valueFormat: arrCheckedFormat,
                valueFormatId: valueFormatId,
                brandValue: arrChecked,
            },
            success: function (data) {
                $(".detail__category").empty();
                $(".detail__category").append(data);
                $("script").remove();
                $(".detail__category").stop().animate(
                    {
                        opacity: "1",
                    },
                    { duration: 1000 },
                    "linear"
                );
                $(".btn__load-more").addClass("btn-width-cl");
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    });

    var lastScrollTop = 0;
    $(document).scroll(function () {
        if (window.innerWidth >= 991) {
            var scrollTop = pageYOffset;
            if (scrollTop < 75) {
                $(".header-infor").removeClass("shadow-header");
                return;
            } else {
                $(".header-infor").addClass("shadow-header");
            }
            if (scrollTop > lastScrollTop) {
                $(".header-infor").stop().animate(
                    {
                        top: "-90px",
                    },
                    { duration: 100 },
                    "linear"
                );
            } else {
                $(".header-infor").stop().animate(
                    {
                        top: "0px",
                    },
                    { duration: 200 },
                    ""
                );
            }
            lastScrollTop = scrollTop;
        }
    });
});

$(document).ready(function () {
    $("#brand").owlCarousel({
        margin: 20,
        nav: true,
        dots: false,
        items: 4,
        responsive: {
            0: {
                items: 1,
            },
            450: {
                items: 1,
            },
            1000: {
                items: 4,
            },
        },
        autoPlay: true,
    });

    $("#nav-hamburger").on("click", function () {
        if ($("#nav-hamburger").hasClass("open")) {
            $("#nav-hamburger").removeClass("open");
            $("#navbar-mobile").removeClass("open");
        } else {
            $("#navbar-mobile").addClass("open");
            $("#nav-hamburger").addClass("open");
        }
    });

    $(".nav-product-hover").on("mouseover", function () {
        $(".nav-dropdown-hide").stop().animate(
            { opacity: 1, height: 300 },
            { duration: 200 },
            "linear"
            // function () {
            //     setTimeout(function () {}, 500);
            // }
        );
    });
    $(".nav-product-hover").on("mouseleave", function () {
        $(".nav-dropdown-hide")
            .stop()
            .animate({ opacity: 0, height: 0 }, { duration: 100 }, "linear");
    });

    $(".icon-drop-footer").on("click", function () {
        $(this).find("i").toggleClass("bi-caret-down-fill bi-caret-up-fill");
        footerDropParent = $(this).parents(".container-footer-item");
        footerNear = footerDropParent.siblings(".footer-infor-list");
        if (footerNear.hasClass("footer-hid")) {
            footerNear.removeClass("footer-hid");
            footerNear.removeClass("hidden");
            footerNear
                .stop()
                .animate(
                    { opacity: 1, height: 200 },
                    { duration: 200 },
                    "linear"
                );
        } else {
            footerNear.addClass("footer-hid");
            footerNear
                .stop()
                .animate(
                    { height: 0, opacity: 0 },
                    { duration: 200 },
                    "linear"
                );
            footerNear.addClass("hidden");
        }
    });




});


$(document).ready(function () {
    $(".search-group").on("click", function () {
        var query = $("#search-form").val();
        if (query.trim() !== "") {
            // Chuyển hướng đến trang tìm kiếm với tham số tìm kiếm
            window.location.href =
                "/search-product?query=" + encodeURIComponent(query);
        }

    });
});
// script detail-product
