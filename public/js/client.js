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
        let alertClient = document.getElementById('alertClient');
        let spnClientMessage = document.getElementById('clientMessage');
        alertClient.style.display = 'block';
        spnClientMessage.innerHTML = data;
        setTimeout(() => {
            alertClient.style.display = 'none';
        }, 9000);
    });
};



//#region Llamadas a eventos
frmAddClient.addEventListener('submit', (e) => {
    addClient(e);
});
////#endregion