/**
 * Template Name: HeroBiz
 * Updated: Mar 10 2023 with Bootstrap v5.2.3
 * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    /**
     * Porfolio isotope and filter
     */
    let portfolionIsotope = document.querySelector(".portfolio-isotope");

    if (portfolionIsotope) {
        let portfolioFilter = portfolionIsotope.getAttribute(
            "data-portfolio-filter"
        )
            ? portfolionIsotope.getAttribute("data-portfolio-filter")
            : "*";
        let portfolioLayout = portfolionIsotope.getAttribute(
            "data-portfolio-layout"
        )
            ? portfolionIsotope.getAttribute("data-portfolio-layout")
            : "masonry";
        let portfolioSort = portfolionIsotope.getAttribute(
            "data-portfolio-sort"
        )
            ? portfolionIsotope.getAttribute("data-portfolio-sort")
            : "original-order";

        window.addEventListener("load", () => {
            let portfolioIsotope = new Isotope(
                document.querySelector(".portfolio-container"),
                {
                    itemSelector: ".portfolio-item",
                    layoutMode: portfolioLayout,
                    filter: portfolioFilter,
                    sortBy: portfolioSort,
                }
            );

            let menuFilters = document.querySelectorAll(
                ".portfolio-isotope .portfolio-flters li"
            );
            menuFilters.forEach(function (el) {
                el.addEventListener(
                    "click",
                    function () {
                        document
                            .querySelector(
                                ".portfolio-isotope .portfolio-flters .filter-active"
                            )
                            .classList.remove("filter-active");
                        this.classList.add("filter-active");
                        portfolioIsotope.arrange({
                            filter: this.getAttribute("data-filter"),
                        });
                        if (typeof aos_init === "function") {
                            aos_init();
                        }
                    },
                    false
                );
            });
        });
    }

    /**
     * Animation on scroll function and init
     */
    function aos_init() {
        AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    }
    window.addEventListener("load", () => {
        aos_init();
    });

    $(".copy_txt_btn").click(function () {
        let copyText = $(this).data("link");
        var successful = navigator.clipboard.writeText(copyText);
        var msg = successful
            ? "Link Copied Succesfully, paste into your apps!"
            : "Copying failed, consider upgrading your browser.";
        alert(msg);
    });
});
