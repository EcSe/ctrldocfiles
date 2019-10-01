let tbodyClient = document.getElementById('tbodyClient');
let frmSearchClient = document.getElementById('frmSearchClient');

let listClient = (ruta) => {
    frmSearchClient.reset();
    let rutafetch;
    ruta ? rutafetch = ruta : rutafetch = '/clientPaginate';
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(rutafetch, init).then(res => res.json()).then(data => {
        while (tbodyClient.firstChild) {
            tbodyClient.removeChild(tbodyClient.firstChild);
        }
        for (let i = 0; i < data.listClientPaginate.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.listClientPaginate.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.listClientPaginate.data[i].cif}</td>`);
            fila.innerHTML += (`<td>${data.listClientPaginate.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.listClientPaginate.data[i].email}</td>`);
            fila.innerHTML += (`<td>${data.listClientPaginate.data[i].type_client.description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="/clientview?id=${data.listClientPaginate.data[i].id}" class="btn btn-default"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/clientedit?id=${data.listClientPaginate.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteClient(this)"><i class="fa fa-trash"></i></button></td>`);
            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="/clientview?id=${data.listClientPaginate.data[i].id}" class="btn btn-default">
                                     <i class="fa fa-info"></i></a></td>`);
            }
            tbodyClient.appendChild(fila);
        }
        //Paginacion
        let from = document.getElementById('from');
        from.innerHTML = data.listClientPaginate.from;
        let to = document.getElementById('to');
        to.innerHTML = data.listClientPaginate.to;
        let total = document.getElementById('total');
        total.innerHTML = data.listClientPaginate.total;
        let currentPage = document.getElementById('currentPage');
        currentPage.innerHTML = data.listClientPaginate.current_page;
        let hPrev = document.getElementById('hPrev');
        data.listClientPaginate.prev_page_url ? (hPrev.setAttribute('onclick', `return listClient('${data.listClientPaginate.prev_page_url}');`),
                hPrev.style.visibility = "visible") :
            hPrev.style.visibility = 'hidden';
        let hNext = document.getElementById('hNext');
        data.listClientPaginate.next_page_url ? (hNext.setAttribute('onclick', `return listClient('${data.listClientPaginate.next_page_url}');`),
                hNext.style.visibility = "visible") :
            hNext.style.visibility = "hidden";
    });
};

let deleteClient = (e) => {
    let idClient = e.parentNode.parentElement.cells[0].innerHTML;
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
            fetch(`/client/${idClient}`, init).then(res => {
                if (!res.ok) {
                    let alertClient = document.getElementById('alertClient');
                    alertClient.className = 'alert alert-danger alert-dismissible';
                    res.json().then(data => {
                        let spnClientMessage = document.getElementById('clientMessage');
                        alertClient.style.display = 'block';
                        spnClientMessage.innerHTML = data;
                        setTimeout(() => {
                            alertClient.style.display = 'none';
                        }, 9000);
                    });
                } else {
                    res.json().then(data => {
                        let row = e.parentNode.parentElement;
                        row.remove()
                        let alertClient = document.getElementById('alertClient');
                        alertClient.className = 'alert alert-success alert-dismissible';
                        let spnClientMessage = document.getElementById('clientMessage');
                        alertClient.style.display = 'block';
                        spnClientMessage.innerHTML = data;
                        setTimeout(() => {
                            alertClient.style.display = 'none';
                        }, 9000);
                    });
                }
            }).catch(err => {
                console.log(err);
            });
        }
    }
};

let searchClient = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmSearchClient);
    let init = {
        method: 'post',
        body: frmData
    };
    fetch('/searchClient', init).then(res => res.json()).then(data => {
        while (tbodyClient.firstChild) {
            tbodyClient.removeChild(tbodyClient.firstChild);
        }
        for (let i = 0; i < data.clients.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.clients.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.clients.data[i].cif}</td>`);
            fila.innerHTML += (`<td>${data.clients.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.clients.data[i].email}</td>`);
            fila.innerHTML += (`<td>${data.clients.data[i].type_client.description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="/clientview?id=${data.clients.data[i].id}" class="btn btn-default"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/clientedit?id=${data.clients.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteClient(this)"><i class="fa fa-trash"></i></button></td>`);
            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="/clientview?id=${data.clients.data[i].id}" class="btn btn-default">
                                    <i class="fa fa-info"></i></a></td>`);
            }
            tbodyClient.appendChild(fila);
        }
    });

};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    listClient();
});
frmSearchClient.addEventListener('submit', (e) => {
    searchClient(e);
});
//#endregion