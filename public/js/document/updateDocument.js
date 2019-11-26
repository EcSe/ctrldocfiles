let cboClient = document.getElementById('id_client');
let cboEstadoDocumento = document.getElementById('document_state');
let cboTypeDocument = document.getElementById('id_type');

let btnUpdateBack = document.getElementById('updateBack');
let hrfBack = document.getElementById('back');
let btnUpdate = document.getElementById('update');
let parametrosURL = new URLSearchParams(document.location.search.substring(1));
let frmUpdate = document.getElementById('frmUpdateDocument');
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
}

let listDocumentState = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`${appurl}/documentState`, init).then(res => res.json()).then(data => {
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
    fetch(`${appurl}/documentType`, init).then(res => res.json()).then(data => {
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            cboTypeDocument.appendChild(option);
        }
    });
}

let cargarCampos = () => {
    listClient();
    listDocumentState();
    listDocumentType();
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`${appurl}/document/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('id_type').value = data.id_type.id;
        document.getElementById('id_client').value = data.id_client.id;
        document.getElementById('document_code').value = data.document_code;
        document.getElementById('description').value = data.description;
        document.getElementById('document_date').value = data.document_date;
        document.getElementById('period_start_date').value = data.period_start_date;
        document.getElementById('period_finish_date').value = data.period_finish_date;
        document.getElementById('value').value = data.value;
        document.getElementById('main_doc_id').value = data.main_doc_id;
        document.getElementById('place_details_id').value = data.place_details_id;
        document.getElementById('place_details_obs').value = data.place_details_obs;
        document.getElementById('document_state').value = data.document_state.id;
    });
};

let updateDocument = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmUpdate);
    let init = {
        method: "post",
        body: frmData
    };

    fetch(`${appurl}/document/${id}`, init).then(res => res.json()).then(data => {
        let alertDocumentUpdate = document.getElementById('alertDocumentUpdate');
        let spnDocumentMessageUpdate = document.getElementById('documentMessageUpdate');
        alertDocumentUpdate.style.display = 'block';
        spnDocumentMessageUpdate.innerHTML = data;
        setTimeout(() => {
            alertDocumentUpdate.style.display = 'none';
        }, 9000);
    });
};

let back = () => {
    // hrfBack.click();
    location.href = "http://ctrldocfiles.com.devel/ld";
};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    cargarCampos();
});

frmUpdate.addEventListener('submit', (e) => {
    updateDocument(e);
});
//#endregion