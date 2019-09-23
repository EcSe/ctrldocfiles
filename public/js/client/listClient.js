let tbodyClient = document.getElementById('tbodyClient');
let frmSearchClient = document.getElementById('frmSearchClient');

let listClient = (ruta) => {
    frmSearchClient.reset();
    let rutafetch;
    ruta ? rutafetch = ruta : rutafetch = '/clientPaginate';
    // let cantidadUsers;
    // cant ? cantidadUsers = cant : cantidadUsers = 10;
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(rutafetch, init).then(res => res.json()).then(data => {
        while (tbodyClient.firstChild) {
            tbodyClient.removeChild(tbodyClient.firstChild);
        }
        for (let i = 0; i < data.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.data[i].cif}</td>`);
            fila.innerHTML += (`<td>${data.data[i].code}</td>`);
            fila.innerHTML += (`<td>${data.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.data[i].email}</td>`);
            fila.innerHTML += (`<td>${data.data[i].type_client.description}</td>`);
            fila.innerHTML += (`<td><a target="_self" title="Ver" href="/clientview?id=${data.data[i].id}" class="btn btn-default"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/clientedit?id=${data.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteClient(this)"><i class="fa fa-trash"></i></button></td>`);

            tbodyClient.appendChild(fila);
        }
        //Paginacion
        let from = document.getElementById('from');
        from.innerHTML = data.from;
        let to = document.getElementById('to');
        to.innerHTML = data.to;
        let total = document.getElementById('total');
        total.innerHTML = data.total;
        let currentPage = document.getElementById('currentPage');
        currentPage.innerHTML = data.current_page;
        let hPrev = document.getElementById('hPrev');
        data.prev_page_url ? (hPrev.setAttribute('onclick', `return listClient('${data.prev_page_url}');`),
                hPrev.style.visibility = "visible") :
            hPrev.style.visibility = 'hidden';
        let hNext = document.getElementById('hNext');
        data.next_page_url ? (hNext.setAttribute('onclick', `return listClient('${data.next_page_url}');`),
                hNext.style.visibility = "visible") :
            hNext.style.visibility = "hidden";
    });
};

let deleteClient = (e) => {
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
            fetch(`/client/${idUser}`, init).then(res => res.json()).then(data => {
                let row = e.parentNode.parentElement;
                row.remove()
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
        for (let i = 0; i < data.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.data[i].cif}</td>`);
            fila.innerHTML += (`<td>${data.data[i].code}</td>`);
            fila.innerHTML += (`<td>${data.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.data[i].email}</td>`);
            fila.innerHTML += (`<td>${data.data[i].type_client.description}</td>`);
            fila.innerHTML += (`<td><a target="_self" title="Ver" href="/clientview?id=${data.data[i].id}" class="btn btn-default"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="/clientedit?id=${data.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteClient(this)"><i class="fa fa-trash"></i></button></td>`);

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