let cboClient = document.getElementById('id_client');
let cboType = document.getElementById('id_type');
let cboState = document.getElementById('casefile_state');
let frmCasefile = document.getElementById('frmAddCasefile');

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

let addCasefile = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmCasefile);
    let init = {
        method: 'post',
        body: frmData
    };
    fetch(`${appurl}/casefile`, init).then(res => res.json()).then(data => {
        frmCasefile.reset();
        let alertCasefile = document.getElementById('alertCasefile');
        let spnCasefileMessage = document.getElementById('casefileMessage');
        alertCasefile.style.display = 'block';
        spnCasefileMessage.innerHTML = data;
        setTimeout(() => {
            alertCasefile.style.display = 'none';
        }, 9000);
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