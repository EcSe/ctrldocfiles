let tbody = document.getElementById('tbodyDocument');
let frmSearchDocument = document.getElementById('frmSearchDocument');

let listClient = () => {
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch('/client', init).then(res => res.json()).then(data => {
        let srchClient = document.getElementById('srchClient');
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            srchClient.appendChild(option);
        }
    });
};


let listDocument = (ruta) => {
    frmSearchDocument.reset();
    let rutafetch;
    ruta ? rutafetch = ruta : rutafetch = '/documentPaginate';
    let init = {
        method: "get",
        mode: 'cors',
    }
    fetch(rutafetch, init).then(res => res.json()).then(data => {
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        for (let i = 0; i < data.listDocumentPaginate.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.listDocumentPaginate.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.listDocumentPaginate.data[i].id_type.description}</td>`);
            fila.innerHTML += (`<td>${data.listDocumentPaginate.data[i].id_client.description}</td>`);
            fila.innerHTML += (`<td>${data.listDocumentPaginate.data[i].description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="/docview?id=${data.listDocumentPaginate.data[i].id}"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/docedit?id=${data.listDocumentPaginate.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteDocument(this)"><i class="fa fa-trash"></i></button></td>`);
            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="/docview?id=${data.listDocumentPaginate.data[i].id}">
                                    <i class="fa fa-info"></i></a></td>`);
            }

            tbody.appendChild(fila);
        }
        //Paginacion
        let from = document.getElementById('from');
        from.innerHTML = data.listDocumentPaginate.from;
        let to = document.getElementById('to');
        to.innerHTML = data.listDocumentPaginate.to;
        let total = document.getElementById('total');
        total.innerHTML = data.listDocumentPaginate.total;
        let currentPage = document.getElementById('currentPage');
        currentPage.innerHTML = data.listDocumentPaginate.current_page;
        let hPrev = document.getElementById('hPrev');
        data.listDocumentPaginate.prev_page_url ? (hPrev.setAttribute('onclick', `return listDocument('${data.listDocumentPaginate.prev_page_url}');`),
                hPrev.style.visibility = "visible") :
            hPrev.style.visibility = 'hidden';
        let hNext = document.getElementById('hNext');
        data.listDocumentPaginate.next_page_url ? (hNext.setAttribute('onclick', `return listDocument('${data.listDocumentPaginate.next_page_url}');`),
                hNext.style.visibility = "visible") :
            hNext.style.visibility = "hidden";
    })
};

let searchDocument = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmSearchDocument);
    let init = {
        method: 'post',
        body: frmData
    };
    fetch('/searchDocument', init).then(res => res.json()).then(data => {
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        for (let i = 0; i < data.documents.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.documents.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.documents.data[i].id_type.description}</td>`);
            fila.innerHTML += (`<td>${data.documents.data[i].id_client.description}</td>`);
            fila.innerHTML += (`<td>${data.documents.data[i].description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="/docview?id=${data.documents.data[i].id}"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/docedit?id=${data.documents.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteDocument(this)"><i class="fa fa-trash"></i></button></td>`);
            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" class="btn btn-default" href="/docview?id=${data.documents.data[i].id}"><i class="fa fa-info">
                                    </i></a></td>`);
            }

            tbody.appendChild(fila);
        }
    });
};

let deleteDocument = (e) => {
    let idUser = e.parentNode.parentElement.cells[0].innerHTML;
    let init = {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        mode: 'cors'
    }
    let btnModalDelete = document.getElementById('btnModalDelete');
    document.onclick = (event) => {
        if (event.target == btnModalDelete) {
            fetch(`/document/${idUser}`, init).then(res => {
                if (!res.ok) {
                    let alertDocument = document.getElementById('alertDocument');
                    alertDocument.className = 'alert alert-danger alert-dismissible';
                    res.json().then(data => {
                        let spnDocumentMessage = document.getElementById('documentMessage');
                        alertDocument.style.display = 'block';
                        spnDocumentMessage.innerHTML = data;
                        setTimeout(() => {
                            alertDocument.style.display = 'none';
                        }, 9000);
                    });
                } else {
                    res.json().then(data => {
                        let row = e.parentNode.parentElement;
                        row.remove()
                        let alertDocument = document.getElementById('alertDocument');
                        alertDocument.className = 'alert alert-success alert-dismissible';
                        let spnDocumentMessage = document.getElementById('documentMessage');
                        alertDocument.style.display = 'block';
                        spnDocumentMessage.innerHTML = data;
                        setTimeout(() => {
                            alertDocument.style.display = 'none';
                        }, 9000);
                    });
                }
            }).catch(err => {
                console.log(err);
            });
        }
    }
};

//#region Llamadas a eventos
document.addEventListener('DOMContentLoaded', () => {
    listClient();
    listDocument();
});
frmSearchDocument.addEventListener('submit', (e) => {
    searchDocument(e);
});
//#endregion