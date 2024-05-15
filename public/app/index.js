function navbarSwitch(isLoading) {
    document.querySelectorAll(".btn-show-nav").forEach((element, index) => {
        if (index == 0) {
            let nav = document.querySelector(".nav-absolute");
            let main = document.querySelector(".main");

            if (isLoading) {
                if (localStorage.getItem("navStatus") == "true") {
                    element.classList.add("btn-show-nav-hide");
                    nav.classList.add("nav-absolute-show");
                    main.classList.add("main-nav");
                } else {
                    element.classList.remove("btn-show-nav-hide");
                    nav.classList.remove("nav-absolute-show");
                    main.classList.remove("main-nav");
                }
            } else {
                if (localStorage.getItem("navStatus") == "true") {
                    element.classList.remove("btn-show-nav-hide");
                    nav.classList.remove("nav-absolute-show");
                    main.classList.remove("main-nav");
                    localStorage.setItem("navStatus", false);
                } else {
                    element.classList.add("btn-show-nav-hide");
                    nav.classList.add("nav-absolute-show");
                    main.classList.add("main-nav");
                    localStorage.setItem("navStatus", true);
                }
            }
        }
    });
}

function handleNavbarSwitch(e) {
    if (
        e.target.matches(".btn-show-nav") ||
        e.target.matches(".btn-show-nav *")
    ) {
        navbarSwitch(false);
    }
}

function navbarSelect(e) {
    if (
        e.target.matches(".btn-show-nav") ||
        e.target.matches(".btn-show-nav *")
    ) {
        document.querySelectorAll(".btn-show-nav").forEach((element, index) => {
            if (index == 0) {
                let nav = document.querySelector(".nav-absolute");
                let main = document.querySelector(".main");

                if (element.classList.contains("btn-show-nav-hide")) {
                    element.classList.remove("btn-show-nav-hide");
                    nav.classList.remove("nav-absolute-show");
                    main.classList.remove("main-nav");
                } else {
                    element.classList.add("btn-show-nav-hide");
                    nav.classList.add("nav-absolute-show");
                    main.classList.add("main-nav");
                }
            }
        });
    }
}

function cancelAndHabilityForm(e) {
    if (e.target.matches(".btn-form-cancel")) {
        e.preventDefault();
        let urls = window.location.pathname.split("/");
        urls.pop();
        window.location.replace("http://www.w3schools.com");
        window.location.href = urls.join("/");
    }
    if (e.target.matches("#btn-habilitar-edicion")) {
        let inputs = document.querySelectorAll("[data-undisabled]");
        inputs.forEach((element) => {
            if (element.getAttribute("disabled") == null) {
                element.setAttribute("disabled", true);
            } else element.removeAttribute("disabled");
        });
    }
}

document.addEventListener("click", (e) => {
    handleNavbarSwitch(e);

    cancelAndHabilityForm(e);
});

document.addEventListener("DOMContentLoaded", (e) => {
    let nav1 = document.querySelectorAll("[data-nav]");
    let nav2 = document.querySelectorAll("[data-nav-abs]");

    nav1.forEach((element, index) => {
        if (
            element.getAttribute("href").includes(location.href.split("/")[3])
        ) {
            element.classList.add("link-active");
            nav2[index].classList.add("link-active");
        }
    });
});

window.addEventListener("load", function (event) {
    navbarSwitch(true);
});
