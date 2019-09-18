let cboClient = document.getElementById('id_client');
let cboType = document.getElementById('id_type');
let cboState = document.getElementById('casefile_state');
let frmCasefile = document.getElementById('frmAddCasefile');

let listClient = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch('/client', init).then(res => res.json()).then(data => {
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
    fetch('/casefileType', init).then(res => res.json()).then(data => {
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
    fetch('/casefileState', init).then(res => res.json()).then(data => {
        for (i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboState.appendChild(option);
        }
    });
};

let addCasefile = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmCasefile);
    let init = {
        method: 'post',
        body: frmData
    };
    fetch('/casefile', init).then(res => res.json()).then(data => {
        frmCasefile.reset();
        let p = document.getElementById('casefileMessage');
        p.innerHTML = data;
    });
}

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    listClient();
    listTipo();
    listState();
});
frmCasefile.addEventListener('submit', (e) => {
    addCasefile(e);
});
//#endregion