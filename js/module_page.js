{/* <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                    <div class="icon-container-green icon-container" onclick="addChecklistItem();"><i class="far fa-plus-square fa-2x icon"></i></div>
                </div> */}


let checkboxNum = document.getElementsByClassName("check").length + 1;

const checklist = document.getElementById("checklist-table");


const reorder = () => {
    let checkItems = document.getElementsByClassName("check");
    for(var i = 0; i < checkItems.length; i++) {
        checkItems.item(i).setAttribute("name", "checklist-".concat((i+1).toString()));
    }
}

const addChecklistItem = () => {
    // const item = document.createElement("li");

    const inputGroup = document.createElement("div");
    inputGroup.classList.add("input-group");
    inputGroup.classList.add("checklist-item");

    const checkboxDiv = document.createElement("div");
    checkboxDiv.classList.add("input-group-text");

    const checkbox = document.createElement("input");
    checkbox.classList.add("form-check-input");
    checkbox.type = "checkbox";
    checkboxDiv.appendChild(checkbox);
    inputGroup.appendChild(checkboxDiv);

    const textbox = document.createElement("input");
    textbox.classList.add("form-control");
    textbox.classList.add("check");
    textbox.type = "text";

    textbox.setAttribute("name", "checklist-".concat(checkboxNum.toString()));
    checkboxNum++;
    inputGroup.appendChild(textbox);

    const addButton = document.createElement("div");
    addButton.classList.add("icon-container-green");
    addButton.classList.add("icon-container");
    addButton.addEventListener("click", addChecklistItem)

    const addIcon = document.createElement("i");
    addIcon.classList.add("far");
    addIcon.classList.add("fa-plus-square");
    addIcon.classList.add("icon");
    addButton.appendChild(addIcon);
    inputGroup.appendChild(addButton);

    const deleteButton = document.createElement("div");
    deleteButton.classList.add("icon-container-red");
    deleteButton.classList.add("icon-container");
    deleteButton.addEventListener("click", deleteChecklistItem);

    const deleteIcon = document.createElement("i");
    deleteIcon.classList.add("far");
    deleteIcon.classList.add("fa-minus-square");
    deleteIcon.classList.add("icon");
    deleteButton.appendChild(deleteIcon);
    inputGroup.appendChild(deleteButton);

    // item.appendChild(inputGroup);
    checklist.appendChild(inputGroup);
}

const deleteChecklistItem = (e) => {
    let item = e.target; 
    
    if(item.classList[0] === "far") {
        item.parentElement.parentElement.remove();
    } else {
        e.target.parentElement.remove();
    }
    checkboxNum--;
    reorder();
}

const deleteItem = (e) => {
    const item = e;
    
    if(item.classList[0] === "far") {
        item.parentElement.parentElement.remove();
    } else {
        item.parentElement.remove();
    }
    checkboxNum--;
    reorder();
}