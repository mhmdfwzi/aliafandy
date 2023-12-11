const menu_shop = document.querySelector("#menu-shop");
const menuInner_shop = menu_shop.querySelector("#menu-inner-shop");
const menuArrow_shop = menu_shop.querySelector("#menu-arrow-shop");
const burger_shop = document.querySelector("#burger-shop");
const overlay_shop = document.querySelector("#overlay-shop");

// Navbar Menu Toggle Function
function toggleMenuShop() {
    menu_shop.classList.toggle("is-active");
    overlay_shop.classList.toggle("is-active");
}

// Show Mobile Submenu Function
function showSubMenuShop(children) {
    subMenu_shop = children.querySelector("#submenu-shop");
    subMenu_shop.classList.add("is-active");
    subMenu_shop.style.animation = "slideRight 0.35s ease forwards";
    const menuTitle_shop =
        children.querySelector("i").parentNode.childNodes[0].textContent;
    menu_shop.querySelector("#menu-title-shop").textContent = menuTitle_shop;
    menu_shop.querySelector("#menu-header-shop").classList.add("is-active");
}

// Hide Mobile Submenu Function
function hideSubMenuShop() {
    subMenu_shop.style.animation = "slideRight 0.35s ease forwards";
    setTimeout(() => {
        subMenu_shop.classList.remove("is-active");
    }, 300);

    menu_shop.querySelector("#menu-title-shop").textContent = "";
    menu_shop.querySelector("#menu-header-shop").classList.remove("is-active");
}

// Toggle Mobile Submenu Function
function toggleSubMenuShop(e) {
    if (!menu_shop.classList.contains("is-active")) {
        return;
    }
    if (e.target.closest("#menu-dropdown-shop")) {
        const children_shop = e.target.closest("#menu-dropdown-shop");
        showSubMenuShop(children_shop);
    }
}

// Fixed Navbar Menu on Window Resize
window.addEventListener("resize", () => {
    if (window.innerWidth >= 992) {
        if (menu_shop.classList.contains("is-active")) {
            toggleMenuShop();
        }
    }
});

// Initialize All Event Listeners
burger_shop.addEventListener("click", toggleMenuShop);
overlay_shop.addEventListener("click", toggleMenuShop);
menuArrow_shop.addEventListener("click", hideSubMenuShop);
menuInner_shop.addEventListener("click", toggleSubMenuShop);
