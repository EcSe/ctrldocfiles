let frmAddClient = document.getElementById('frmAddClient');

let addClient = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmAddClient);
    let init = {
        method: "POST",
        body: frmData,
    }
    fetch('/client', init).then(res => res.json()).then(data => {
        frmAddClient.reset();
        let p = document.getElementById('clientMessage');
        p.innerHTML = data;
    });
};



//#region Llamadas a eventos
frmAddClient.addEventListener('submit', (e) => {
    addClient(e);
});
////#endregion