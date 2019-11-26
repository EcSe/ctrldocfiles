let tbodyCasefile = document.getElementById('tbodyCasefile');
let frmSearchCasefile = document.getElementById('frmSearchCasefile');

let listClient = () => {
    let init = {
        method: 'get',
        mode: 'cors'
    };
    fetch(`${appurl}/client`, init).then(res => res.json()).then(data => {
        let srchClient = document.getElementById('srchClient');
        for (let i = 0; i < data.length; i++) {
            let option = document.createElement('option');
            option.value = data[i].id;
            option.text = data[i].description;
            srchClient.appendChild(option);
        }
    });
};

let listCasefile = (ruta) => {
    frmSearchCasefile.reset();
    let rutafetch;
    ruta ? rutafetch = ruta : rutafetch = `${appurl}/casefilePaginate`;
    let init = {
        method: 'GET',
        mode: 'cors'
    };
    fetch(rutafetch, init).then(res => res.json()).then(data => {
        while (tbodyCasefile.firstChild) {
            tbodyCasefile.removeChild(tbodyCasefile.firstChild);
        }
        for (let i = 0; i < data.listCasefilePaginate.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.listCasefilePaginate.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.listCasefilePaginate.data[i].id_client.description}</td>`);
            fila.innerHTML += (`<td>${data.listCasefilePaginate.data[i].id_type.description}</td>`);
            fila.innerHTML += (`<td>${data.listCasefilePaginate.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.listCasefilePaginate.data[i].casefile_state.description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="${appurl}/casefileview?id=${data.listCasefilePaginate.data[i].id}" class="btn btn-default"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="${appurl}/casefileedit?id=${data.listCasefilePaginate.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteCasefile(this)"><i class="fa fa-trash"></i></button></td>`);
            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="${appurl}/casefileview?id=${data.listCasefilePaginate.data[i].id}" class="btn btn-default">
                                    <i class="fa fa-info"></i></a></td>`);
            }

            tbodyCasefile.appendChild(fila);
        }
        //Paginacion
        let from = document.getElementById('from');
        from.innerHTML = data.listCasefilePaginate.from;
        let to = document.getElementById('to');
        to.innerHTML = data.listCasefilePaginate.to;
        let total = document.getElementById('total');
        total.innerHTML = data.listCasefilePaginate.total;
        let currentPage = document.getElementById('currentPage');
        currentPage.innerHTML = data.listCasefilePaginate.current_page;
        let hPrev = document.getElementById('hPrev');
        data.listCasefilePaginate.prev_page_url ? (hPrev.setAttribute('onclick', `return listCasefile('${data.listCasefilePaginate.prev_page_url}');`),
                hPrev.style.visibility = "visible") :
            hPrev.style.visibility = 'hidden';
        let hNext = document.getElementById('hNext');
        data.listCasefilePaginate.next_page_url ? (hNext.setAttribute('onclick', `return listCasefile('${data.listCasefilePaginate.next_page_url}');`),
                hNext.style.visibility = "visible") :
            hNext.style.visibility = "hidden";
    });
};

let searchCasefile = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmSearchCasefile);
    let init = {
        method: 'post',
        body: frmData
    };
    fetch(`${appurl}/searchCasefiles`, init).then(res => res.json()).then(data => {
        while (tbodyCasefile.firstChild) {
            tbodyCasefile.removeChild(tbodyCasefile.firstChild);
        }
        for (let i = 0; i < data.casefiles.data.length; i++) {
            let fila = document.createElement('tr');
            fila.innerHTML += (`<td style="display:none">${data.casefiles.data[i].id}</td>`);
            fila.innerHTML += (`<td>${data.casefiles.data[i].id_client.description}</td>`);
            fila.innerHTML += (`<td>${data.casefiles.data[i].id_type.description}</td>`);
            fila.innerHTML += (`<td>${data.casefiles.data[i].description}</td>`);
            fila.innerHTML += (`<td>${data.casefiles.data[i].casefile_state.description}</td>`);
            if (data.userLevel === 1) {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="${appurl}/casefileview?id=${data.casefiles.data[i].id}" class="btn btn-default"><i class="fa fa-info"></i></a>
                                <a title="Editar" class="btn btn-default" href="${appurl}/casefileedit?id=${data.casefiles.data[i].id}"><i class="fa fa-edit"></i></a>
                                <button title="Eliminar" class="btn btn-default" data-toggle="modal" data-target="#modal-danger" onclick="deleteCasefile(this)"><i class="fa fa-trash"></i></button></td>`);
            } else {
                fila.innerHTML += (`<td><a target="_self" title="Ver" href="${appurl}/casefileview?id=${data.casefiles.data[i].id}" class="btn btn-default">
                                    <i class="fa fa-info"></i></a></td>`);
            }

            tbodyCasefile.appendChild(fila);
        }
    });
};

let deleteCasefile = (e) => {
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
            fetch(`${appurl}/casefile/${idUser}`, init).then(res => {

                if (!res.ok) {
                    console.log(res);
                    let alertCasefile = document.getElementById('alertCasefile');
                    alertCasefile.className = 'alert alert-danger alert-dismissible';
                    res.json().then(data => {
                        let spnCasefileMessage = document.getElementById('casefileMessage');
                        alertCasefile.style.display = 'block';
                        spnCasefileMessage.innerHTML = data;
                        setTimeout(() => {
                            alertCasefile.style.display = 'none';
                        }, 9000);
                    });
                } else {
                    res.json().then(data => {
                        let row = e.parentNode.parentElement;
                        row.remove()
                        let alertCasefile = document.getElementById('alertCasefile');
                        alertCasefile.className = 'alert alert-success alert-dismissible';
                        let spnCasefileMessage = document.getElementById('casefileMessage');
                        alertCasefile.style.display = 'block';
                        spnCasefileMessage.innerHTML = data;
                        setTimeout(() => {
                            alertCasefile.style.display = 'none';
                        }, 9000);
                    });
                }
            }).catch(err => {
                console.log(err);
            });
        }
    }
};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    listCasefile();
    listClient();
});
frmSearchCasefile.addEventListener('submit', (e) => {
    searchCasefile(e);
});
//#endregiondata.