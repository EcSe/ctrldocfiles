let cboClient = document.getElementById('id_client');
let cboType = document.getElementById('id_type');
let cboState = document.getElementById('casefile_state');

let btnUpdateBack = document.getElementById('updateBack');
let hrfBack = document.getElementById('back');
let btnUpdate = document.getElementById('update');
let parametrosURL = new URLSearchParams(document.location.search.substring(1));
let frmUpdate = document.getElementById('frmUpdateCasefile');
let id = parametrosURL.get('id');

let listClient = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`${appurl}/client`, init).then(res => res.json()).then(data => {
        for (i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboClient.appendChild(option);
        }
    });
};

let listTipo = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`${appurl}/casefileType`, init).then(res => res.json()).then(data => {
        for (i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboType.appendChild(option);
        }
    });
};

let listState = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`${appurl}/casefileState`, init).then(res => res.json()).then(data => {
        for (i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboState.appendChild(option);
        }
    });
};

let cargarCampos = () => {
    listClient();
    listTipo();
    listState();
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(`${appurl}/casefile/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('id_client').value = data.id_client.id;
        document.getElementById('id_type').value = data.id_type.id;
        document.getElementById('description').value = data.description;
        document.getElementById('casefile_state').value = data.casefile_state.id;
    });
};

let updateCasefile = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmUpdate);
    let init = {
        method: "post",
        body: frmData
    };
    fetch(`${appurl}/casefile/${id}`, init).then(res => res.json()).then(data => {
        let alertCasefileUpdate = document.getElementById('alertCasefileUpdate');
        let spnCasefileMessageUpdate = document.getElementById('casefileMessageUpdate');
        alertCasefileUpdate.style.display = 'block';
        spnCasefileMessageUpdate.innerHTML = data;
        setTimeout(() => {
            alertCasefileUpdate.style.display = 'none';
        }, 9000);
    });
};

let back = () => {
    location.href = `${appurl}/lca`;
};
//#region Eventos
frmUpdate.addEventListener('submit', (e) => {
    updateCasefile(e);
});
document.addEventListener('DOMContentLoaded', () => {
    cargarCampos();
});
//#endregion