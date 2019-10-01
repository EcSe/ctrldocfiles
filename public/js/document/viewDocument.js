let parametrosURL = new URLSearchParams(document.location.search.substring(1));

let viewDocument = () => {
    let id = parametrosURL.get('id');
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`/document/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('tid').innerHTML = data.id;
        document.getElementById('ttipodoc').innerHTML = data.id_type.description;
        document.getElementById('tcliente').innerHTML = data.id_client.description;
        document.getElementById('tcodigo').innerHTML = data.document_code;
        document.getElementById('tdescripcion').innerHTML = data.description;
        document.getElementById('tfilename').innerHTML = data.filename;

        document.getElementById('objectdocument').data = `/documentos/${data.filename}`;
        document.getElementById('idocument').src = `/documentos/${data.filename}`;

        document.getElementById('tfecha').innerHTML = data.document_date;
        document.getElementById('tperiodin').innerHTML = data.period_start_date;
        document.getElementById('tperiodfin').innerHTML = data.period_finish_date;
        document.getElementById('tvalue').innerHTML = data.value;
        document.getElementById('tdocrel').innerHTML = data.main_doc_id;
        document.getElementById('tlugar').innerHTML = data.place_details_id;
        document.getElementById('tdetallelugar').innerHTML = data.place_details_obs;
        document.getElementById('tuserupload').innerHTML = data.user_upload_id.name;
        document.getElementById('testado').innerHTML = data.document_state.description;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    viewDocument();
});