let btnUpdateBack = document.getElementById('updateBack');
let hrfBack = document.getElementById('back');
let btnUpdate = document.getElementById('update');
let parametrosURL = new URLSearchParams(document.location.search.substring(1));
let frmUpdate = document.getElementById('frmUpdateUser');
let id = parametrosURL.get('id');

let cargarCampos = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`/user/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('code').value = data.code;
        document.getElementById('name').value = data.name;
        //document.getElementById('email').value = data.email;
        frmUpdate.email.value = data.email;
        document.getElementById('description').value = data.description;
        document.getElementById('login').value = data.login;
        document.getElementById('password').value = data.password;
        document.getElementById('keyaccess').value = data.keyaccess;
        document.getElementById('typeLevel').value = data.type_level.id;
        document.getElementById('accountState').value = data.account_state.id;
    });
};

let updateUser = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmUpdate);
    let init = {
        method: "post",
        body: frmData
    };

    fetch(`/user/${id}`, init).then(res => res.json()).then(data => {
        let p = document.getElementById('userMessage');
        p.innerHTML = data;
    });
};

let back = () => {
    // hrfBack.click();
    location.href = "http://ctrldocfiles.com.devel/list";
};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    cargarCampos();
});

frmUpdate.addEventListener('submit', (e) => {
    updateUser(e);
});
//#endregion