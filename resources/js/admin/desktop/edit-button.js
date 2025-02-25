export let renderEditButton = () => {

    let editButtons = document.querySelectorAll(".edit-button");
    let table = document.querySelector(".table");
    let edit = document.querySelector(".edit-section");

    document.addEventListener("renderFormModules", (event => {
        renderEditButton();
    }));

    editButtons.forEach(editButton => {

        editButton.addEventListener('click', () => {
            table.classList.add("minimized");
            edit.classList.add("active");
        });
    });
}