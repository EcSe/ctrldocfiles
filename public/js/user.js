let frmAddUser = document.getElementById('frmAddUser');

let addUser = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmAddUser);
    let init = {
        method: "POST",
        body: frmData,
    }
    fetch('/user', init).then(res => res.json()).then(data => {
        frmAddUser.reset();
        let p = document.getElementById('userMessage');
        p.innerHTML = data;
    });
};

//#region Llamadas a eventos
frmAddUser.addEventListener('submit', (e) => {
    addUser(e);
});
//#endregion