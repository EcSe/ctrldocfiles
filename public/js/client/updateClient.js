let btnUpdateBack = document.getElementById('updateBack');
let hrfBack = document.getElementById('back');
let btnUpdate = document.getElementById('update');
let parametrosURL = new URLSearchParams(document.location.search.substring(1));
let frmUpdate = document.getElementById('frmUpdateClient');
let id = parametrosURL.get('id');

let cargarCampos = () => {
    init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(`${appurl}/client/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('cif').value = data.cif;
        document.getElementById('code').value = data.code;
        document.getElementById('description').value = data.description;
        document.getElementById('address').value = data.address;
        document.getElementById('email').value = data.email;
        document.getElementById('phone').value = data.phone;
        document.getElementById('notes').value = data.notes;
        document.getElementById('type_client').value = data.type_client.id;
    });
};

let updateClient = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmUpdate);
    let init = {
        method: "post",
        body: frmData
    };
    fetch(`${appurl}/client/${id}`, init).then(res => res.json()).then(data => {
        let alertClientUpdate = document.getElementById('alertClientUpdate');
        let spnClientMessageUpdate = document.getElementById('clientMessageUpdate');
        alertClientUpdate.style.display = 'block';
        spnClientMessageUpdate.innerHTML = data;
        setTimeout(() => {
            alertClientUpdate.style.display = 'none';
        }, 9000);
    });
};

let back = () => {
    location.href = `${appurl}/lc`;
};
//#region Eventos
frmUpdate.addEventListener('submit', (e) => {
    updateClient(e);
});
document.addEventListener('DOMContentLoaded', () => {
    cargarCampos();
});
//#endregion