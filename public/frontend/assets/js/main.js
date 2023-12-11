/*
Template Name: ShopGrids - Bootstrap 5 eCommerce HTML Template.
Author: GrayGrids
*/

(function () {
    //===== Prealoder

    window.onload = function () {
        window.setTimeout(fadeout, 500);
    };

    function fadeout() {
        document.querySelector(".preloader").style.opacity = "0";
        document.querySelector(".preloader").style.display = "none";
    }

    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        // show or hide the back-top-top button
        var backToTo = document.querySelector(".scroll-top");
        if (
            document.body.scrollTop > 50 ||
            document.documentElement.scrollTop > 50
        ) {
            backToTo.style.display = "flex";
        } else {
            backToTo.style.display = "none";
        }
    };

    //===== mobile-menu-btn
    // let navbarToggler = document.querySelector(".mobile-menu-btn");
    // navbarToggler.addEventListener('click', function () {
    //     navbarToggler.classList.toggle("active");
    // });

    const menu = document.querySelector(".menu");
    const menuInner = menu.querySelector(".menu-inner");
    const menuArrow = menu.querySelector(".menu-arrow");
    const burger = document.querySelector(".burger");
    const overlay = document.querySelector(".overlay");

    // Navbar Menu Toggle Function
    function toggleMenu() {
        menu.classList.toggle("is-active");
        overlay.classList.toggle("is-active");
    }

    // Show Mobile Submenu Function
    function showSubMenu(children) {
        subMenu = children.querySelector(".submenu");
        subMenu.classList.add("is-active");
        subMenu.style.animation = "slideLeft 0.35s ease forwards";
        const menuTitle =
            children.querySelector("i").parentNode.childNodes[0].textContent;
        menu.querySelector(".menu-title").textContent = menuTitle;
        menu.querySelector(".menu-header").classList.add("is-active");
    }

    // Hide Mobile Submenu Function
    function hideSubMenu() {
        subMenu.style.animation = "slideRight 0.35s ease forwards";
        setTimeout(() => {
            subMenu.classList.remove("is-active");
        }, 300);

        menu.querySelector(".menu-title").textContent = "";
        menu.querySelector(".menu-header").classList.remove("is-active");
    }

    // Toggle Mobile Submenu Function
    function toggleSubMenu(e) {
        if (!menu.classList.contains("is-active")) {
            return;
        }
        if (e.target.closest(".menu-dropdown")) {
            const children = e.target.closest(".menu-dropdown");
            showSubMenu(children);
        }
    }

    // Fixed Navbar Menu on Window Resize
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 992) {
            if (menu.classList.contains("is-active")) {
                toggleMenu();
            }
        }
    });

    // Initialize All Event Listeners
    burger.addEventListener("click", toggleMenu);
    overlay.addEventListener("click", toggleMenu);
    menuArrow.addEventListener("click", hideSubMenu);
    menuInner.addEventListener("click", toggleSubMenu);

    

})();
