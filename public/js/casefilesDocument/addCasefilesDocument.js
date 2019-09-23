let parametrosURL = new URLSearchParams(document.location.search.substring(1));
let idCasefile = parametrosURL.get('id');
let frmDocument = document.getElementById('frmAddDocumentIntoCasefile');
let cboClient = document.getElementById('id_client');
let cboEstadoDocumento = document.getElementById('document_state');
let cboTypeDocument = document.getElementById('id_type');

let listClient = () => {
    init = {
        method: 'GET',
        mode: 'cors'
    };
    fetch(`/casefile/${idCasefile}`, init).then(res => res.json()).then(data => {
        let option = document.createElement('option');
        option.value = data.id_client.id;
        option.text = data.id_client.description;
        cboClient.appendChild(option);
    });
};

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
};

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
};

let addDocument = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmDocument);
    frmData.append('idCasefile', idCasefile);
    let init = {
        method: 'POST',
        body: frmData
    }
    fetch('/docuIntoCasefiles', init).then(res => res.json()).then(data => {
        frmDocument.reset();
        let alertCasefileDocumnet = document.getElementById('alertCasefileDocumnet');
        let spnCasefileDocumentMessage = document.getElementById('casefiledocumentMessage');
        alertCasefileDocumnet.style.display = 'block';
        spnCasefileDocumentMessage.innerHTML = data;
        setTimeout(() => {
            alertCasefileDocumnet.style.display = 'none';
        }, 9000);
    });
};

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