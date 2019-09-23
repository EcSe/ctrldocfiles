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
        let alertUser = document.getElementById('alertUser');
        let spnUserMessage = document.getElementById('userMessage');
        alertUser.style.display = 'block';
        spnUserMessage.innerHTML = data;
        setTimeout(() => {
            alertUser.style.display = 'none';
        }, 9000);

    });
};

//#region Llamadas a eventos
frmAddUser.addEventListener('submit', (e) => {
    addUser(e);
});
//#endregion