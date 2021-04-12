const toggleView = (e) => {

    const listIconContainer = document.createElement("div");
    listIconContainer.classList.add("icon-container");
    listIconContainer.addEventListener("click", toggleView);

    const listIcon = document.createElement("i");
    listIcon.classList.add("fas");
    listIcon.classList.add("fa-bars");
    listIcon.classList.add("fa-2x");
    listIcon.classList.add("grid");
    listIconContainer.appendChild(listIcon);


    const gridIconContainer = document.createElement("div");
    gridIconContainer.classList.add("icon-container");
    gridIconContainer.addEventListener("click", toggleView);

    const gridIcon = document.createElement("i");
    gridIcon.classList.add("fas");
    gridIcon.classList.add("fa-grip-horizontal");
    gridIcon.classList.add("fa-2x");
    gridIcon.classList.add("grid");
    gridIconContainer.appendChild(gridIcon);

    let icon = e.target; 
    let header = document.getElementById("dashboard-header");

    if(icon.classList[0] == "icon-container") {
        icon = icon.childNodes[0];
    }

    if(icon.classList[1] === "fa-bars") {
        icon.remove();
        header.appendChild(gridIconContainer);  

        const children = document.getElementsByClassName("tutorial-container");

        for(let i = 0; i < children.length; i++) {
            children[i].classList.remove("tutorial-container-grid");
            children[i].classList.add("tutorial-container-list");
        }
    } else {
        icon.remove();
        header.appendChild(listIconContainer);
        const children = document.getElementsByClassName("tutorial-container");

        for(let i = 0; i < children.length; i++) {
            children[i].classList.remove("tutorial-container-list");
            children[i].classList.add("tutorial-container-grid");
        }
    }
}

const gridView = () => {
    const listIconContainer = document.createElement("div");
    listIconContainer.classList.add("icon-container");
    listIconContainer.addEventListener("click", toggleView);


    const listIcon = document.createElement("i");
    listIcon.classList.add("fas");
    listIcon.classList.add("fa-bars");
    listIcon.classList.add("fa-2x");
    listIcon.classList.add("grid");
    listIconContainer.appendChild(listIcon);

    const icon = document.getElementById("change-view-icon");
    icon.remove();
    const header = document.getElementById("dashboard-header");
    header.appendChild(listIconContainer);

    const children = document.getElementsByClassName("tutorial-container");

    for(let i = 0; i < children.length; i++) {
        children[i].classList.add("tutorial-container-grid");
    }
}

const deleteModule= (e) => {
    e.parentElement.parentElement.remove();
}