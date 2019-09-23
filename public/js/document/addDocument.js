let cboClient = document.getElementById('id_client');
let cboEstadoDocumento = document.getElementById('document_state');
let cboTypeDocument = document.getElementById('id_type');
let frmDocument = document.getElementById('frmAddDocument');

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
}

let listDocumentState = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch('/documentState', init).then(res => res.json()).then(data => {
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboEstadoDocumento.appendChild(option);
        }
    });
}

let listDocumentType = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch('/documentType', init).then(res => res.json()).then(data => {
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboTypeDocument.appendChild(option);
        }
    });
}

let addDocument = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmDocument);
    let init = {
        method: 'POST',
        body: frmData
    }
    fetch('/document', init).then(res => res.json()).then(data => {
        frmDocument.reset();
        let alertDocument = document.getElementById('alertDocument');
        let spnDocumentMessage = document.getElementById('documentMessage');
        alertDocument.style.display = 'block';
        spnDocumentMessage.innerHTML = data;
        setTimeout(() => {
            alertDocument.style.display = 'none';
        }, 9000);
    });
}

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    listClient();
    listDocumentState();
    listDocumentType();
});
frmDocument.addEventListener('submit', (e) => {
    addDocument(e);
});
//#endregion