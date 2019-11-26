let btnUpdateBack = document.getElementById('updateBack');
let hrfBack = document.getElementById('back');
let btnUpdate = document.getElementById('update');
let parametrosURL = new URLSearchParams(document.location.search.substring(1));
let frmUpdate = document.getElementById('frmUpdateUser');
let id = parametrosURL.get('id');

let listUserState = () => {
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(`${appurl}/accountState`, init).then(res => res.json()).then(data => {
        let cboAccountState = document.getElementById('accountState');
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.text = data[i].description;
            option.value = data[i].id;
            cboAccountState.appendChild(option);
        }
    });
};

let listUserLevel = () => {
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(`${appurl}/userLevel`, init).then(res => res.json()).then(data => {
        let cboTypeLevel = document.getElementById('typeLevel');
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboTypeLevel.appendChild(option);
        }
    });
};


let cargarCampos = () => {
    listUserState();
    listUserLevel();
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`${appurl}/user/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('code').value = data.code;
        document.getElementById('name').value = data.name;
        document.getElementById('email').value = data.email;
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

    fetch(`${appurl}/user/${id}`, init).then(res => res.json()).then(data => {
        let alertUserUpdate = document.getElementById('alertUserUpdate');
        let spnUserMessageUpdate = document.getElementById('userMessageUpdate');
        alertUserUpdate.style.display = 'block';
        spnUserMessageUpdate.innerHTML = data;
        setTimeout(() => {
            alertUserUpdate.style.display = 'none';
        }, 9000);
    });
};

let back = () => {

    location.href = `${appurl}/list`;
};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    cargarCampos();
});

frmUpdate.addEventListener('submit', (e) => {
    updateUser(e);
});
//#endregionv