let parametrosURL = new URLSearchParams(document.location.search.substring(1));
let id = parametrosURL.get('id');

let viewCasefile = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`/casefile/${id}`, init).then(res => res.json()).then(data => {
        document.getElementById('tid').innerHTML = data.id;
        document.getElementById('tclient').innerHTML = data.id_client.description;
        document.getElementById('tcasetype').innerHTML = data.id_type.description;
        document.getElementById('tdescription').innerHTML = data.description;
        document.getElementById('tstartdate').innerHTML = data.start_date;
        document.getElementById('tfinishdate').innerHTML = data.finish_date;
        document.getElementById('tstartuser').innerHTML = data.start_user_id.login;
        data.finish_user_id === null ? document.getElementById('tfinishuser').innerHTML = "" :
            document.getElementById('tfinishuser').innerHTML = data.finish_user_id.login;
        document.getElementById('tstate').innerHTML = data.casefile_state.description;
        document.getElementById('hrefAddDocument').href = `/casedocu?id=${id}`;
    });
}

let listDocument = (ruta) => {
    let rutafetch;
    ruta ? rutafetch = ruta : rutafetch = '/documentPaginate';
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    fetch(`/casefile/${id}`, init).then(res => res.json()).then(data => {
        idCliente = data.id_client.id;
        return fetch(rutafetch, init)
    }).then(res => res.json()).then(data1 => {
        let tbody = document.getElementById('tbodyDocumentCasefile');
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        let datos = data1.listDocumentPaginate.data;
        let docu = datos.filter(datos => datos.id_client.id === idCliente);
        for (let i = 0; i < docu.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${docu[i].id}</td>`);
            fila.innerHTML += (`<td>${docu[i].id_type.description}</td>`);
            fila.innerHTML += (`<td>${docu[i].id_client.description}</td>`);
            fila.innerHTML += (`<td>${docu[i].description}</td>`);
            fila.innerHTML += (`<td>${docu[i].value}</td>`);
            fila.innerHTML += (`<td><a target="_self" title="Agregar" class="btn btn-default" onclick="addDocumentstoCasefile(this)"><i class="fa fa-plus"></i></a>
                                </td>`);

            tbody.appendChild(fila);
        }
        //Paginacion
        let from = document.getElementById('from');
        from.innerHTML = data1.listDocumentPaginate.from;
        let to = document.getElementById('to');
        to.innerHTML = data1.listDocumentPaginate.to;
        let total = document.getElementById('total');
        total.innerHTML = data1.listDocumentPaginate.total;
        let currentPage = document.getElementById('currentPage');
        currentPage.innerHTML = data1.listDocumentPaginate.current_page;
        let hPrev = document.getElementById('hPrev');
        data1.listDocumentPaginate.prev_page_url ? (hPrev.setAttribute('onclick', `return listDocument('${data1.listDocumentPaginate.prev_page_url}');`),
                hPrev.style.visibility = "visible") :
            hPrev.style.visibility = 'hidden';
        let hNext = document.getElementById('hNext');
        data1.listDocumentPaginate.next_page_url ? (hNext.setAttribute('onclick', `return listDocument('${data1.listDocumentPaginate.next_page_url}');`),
                hNext.style.visibility = "visible") :
            hNext.style.visibility = "hidden";
    });
}

let addDocumentstoCasefile = (e) => {
    let idDocumento = e.parentNode.parentElement.cells[0].innerHTML;
    let datos = {
        'id_casefile': id,
        'id_document': idDocumento,
        'description': ""
    };
    let init = {
        method: 'post',
        body: JSON.stringify(datos),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    };
    fetch('casefiledocument', init).then(res => res.json()).then(data => {
        listDocumentsIntoCasefile();
        console.log(data);
    });

};

let listDocumentsIntoCasefile = (ruta) => {
    let rutafetch;
    ruta ? rutafetch = ruta : rutafetch = `/casefiledocument/${id}`;
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(rutafetch, init).then(res => res.json()).then(data => {
        let tbody = document.getElementById('tbodyDocumentIntoCasefile');
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        for (let i = 0; i < data.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.data[i].id}</td>`);
            fila.innerHTML += (`<td style="display:none">${data.data[i].id_document.id}</td>`);
            fila.innerHTML += (`<td style="display:none">${data.data[i].id_document.filename}</td>`);
            fila.innerHTML += (`<td>${data.data[i].id_document.id_type}</td>`);
            fila.innerHTML += (`<td>${data.data[i].id_document.id_client}</td>`);
            fila.innerHTML += (`<td>${data.data[i].id_document.description}</td>`);
            fila.innerHTML += (`<td>${data.data[i].id_document.value}</td>`);
            fila.innerHTML += (`<td><a target="_self" title="Eliminar" class="btn btn-default" onclick="deleteDocumentIntoCasefile(this)"><i class="fa fa-trash"></i></a>
                                <button title="Ver" class="btn btn-default" onclick="verPdf(this)" data-toggle="modal" data-target="#modal-default"><i class="fa fa-folder-open"></i></button></td>`);

            tbody.appendChild(fila);
        }
        //Paginacion
        let from = document.getElementById('sfrom');
        from.innerHTML = data.from;
        let to = document.getElementById('sto');
        to.innerHTML = data.to;
        let total = document.getElementById('stotal');
        total.innerHTML = data.total;
        let currentPage = document.getElementById('scurrentPage');
        currentPage.innerHTML = data.current_page;
        let hPrev = document.getElementById('shPrev');
        data.prev_page_url ? (hPrev.setAttribute('onclick', `return listDocumentsIntoCasefile('${data.prev_page_url}');`),
                hPrev.style.visibility = "visible") :
            hPrev.style.visibility = 'hidden';
        let hNext = document.getElementById('shNext');
        data.next_page_url ? (hNext.setAttribute('onclick', `return listDocumentsIntoCasefile('${data.next_page_url}');`),
                hNext.style.visibility = "visible") :
            hNext.style.visibility = "hidden";
    });
};

let verPdf = (e) => {
    let urlPdf = e.parentNode.parentElement.cells[2].innerHTML;
    document.getElementById('objectdocument').data = `/documentos/${urlPdf}`;
    document.getElementById('idocument').src = `/documentos/${urlPdf}`;

};

let deleteDocumentIntoCasefile = (e) => {
    let idCasefileDocument = e.parentNode.parentElement.cells[0].innerHTML;
    let init = {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        mode: 'cors'
    };
    fetch(`/casefiledocument/${idCasefileDocument}`, init).then(res => res.json())
        .then(data => {
            let row = e.parentNode.parentElement;
            row.remove();
            console.log(data);
        });
};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    viewCasefile();
    listDocumentsIntoCasefile();
});
//#region