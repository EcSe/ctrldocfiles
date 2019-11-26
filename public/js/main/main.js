let cargaMain = () => {
    init = {
        method: 'get',
        mode: 'cors'
    };
    Promise.all([
        fetch(`${appurl}/casefile`, init).then(res => res.json()),
        fetch(`${appurl}/user`, init).then(res => res.json()),
        fetch(`${appurl}/document`, init).then(res => res.json()),
        fetch(`${appurl}/disk`, init).then(res => res.json())
    ]).then(matriz => {
        let data = matriz[0];
        let data1 = matriz[1];
        let data2 = matriz[2];
        let data3 = matriz[3];

        //Expedientes Abiertos
        let casefileOpen = data.filter(data => data.casefile_state.id === 1);
        let hCasefileOpen = document.getElementById('hcasefileOpen');
        hCasefileOpen.innerHTML = casefileOpen.length;
        //Expedientes Cerrados
        let casefileClose = data.filter(data => data.casefile_state.id === 2);
        let hcasefileClose = document.getElementById('hcasefileClose');
        hcasefileClose.innerHTML = casefileClose.length;
        //#region Graficas
        //Grafica casefile
        let prueba = data.reduce((contador, b) => {
            contador[b.id_client.description] = (contador[b.id_client.description] || 0) + 1;
            return contador;
        }, {});
        let dataCasefile = Object.keys(prueba).map(key => {
            let obj = { 'cliente': key, 'casefiles': prueba[key] };
            return obj;
        });

        //BAR CHART
        if (data.length > 0) {
            let bar = new Morris.Bar({
                element: 'casefile-chart',
                resize: true,
                data: dataCasefile,
                barColors: ['#605ca8', '#00a65a'],
                xkey: 'cliente',
                ykeys: ['casefiles'],
                labels: ['Expedientes'],
                hideHover: 'auto'
            });
        }

        //Grafica Documentos
        let objDocument = data2.reduce((objEmpty, document) => {
            objEmpty[document.id_client.description] = (objEmpty[document.id_client.description] || 0) + 1;
            return objEmpty;
        }, {});
        let dataDocument = Object.keys(objDocument).map(key => {
            let obj = { 'cliente': key, 'document': objDocument[key] };
            return obj;
        });

        //BAR CHART
        if (data2.length > 0) {
            let barDocu = new Morris.Bar({
                element: 'document-chart',
                resize: true,
                data: dataDocument,
                barColors: ['#605ca8', '#00a65a'],
                xkey: 'cliente',
                ykeys: ['document'],
                labels: ['Documentos'],
                hideHover: 'auto'
            });
        }
        //#endregion
        //Usuarios
        let nroUsers = document.getElementById('nroUsers');
        nroUsers.innerHTML = data1.length;

        //Espacio en disco
        let espacioDisco = document.getElementById('hEspacioDisco');
        espacioDisco.innerHTML = `${data3.toFixed(2)} %`;

        //Espacio Ocupado por Expedientes
        let espacioOcupado = document.getElementById('hEspacioOcupado');
        espacioOcupado.innerHTML = `${(100.00-data3).toFixed(2)} %`
    });
};

//#region Eventos
document.addEventListener('DOMContentLoaded', () => {
    cargaMain();
});
//#endregion