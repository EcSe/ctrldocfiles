let frmUserProfile = document.getElementById('frmUserProfile');
let id = user.id

let userProfile = () => {
    let init = {
        method: 'GET',
        mode: 'cors'
    }
    Promise.all([
        fetch(`${appurl}/user/${id}`, init).then(res => res.json()),
        fetch(`${appurl}/dataProfile`, init).then(res => res.json())
    ]).then(matriz => {
        let data = matriz[0];
        let data1 = matriz[1];

        document.getElementById('hName').innerHTML = data.name
        document.getElementById('pDescription').innerHTML = data.description;
        document.getElementById('imgProfile').src = `https://robohash.org/${id}?size=180x180`;

        document.getElementById('name').value = data.name;
        document.getElementById('email').value = data.email;
        document.getElementById('description').innerHTML = data.description;
        document.getElementById('idUser').value = data.login;

        document.getElementById('spDocumentsUpload').innerHTML = data1.nroDocuments;
        document.getElementById('spCasefilesOpen').innerHTML = data1.nroCasefilesOpen;
        document.getElementById('spCasefilesClosed').innerHTML = data1.nroCasefilesClosed;
    });
}

let updateProfile = (e) => {
    e.preventDefault();
    let frmData = new FormData(frmUserProfile);
    let init = {
        method: 'post',
        body: frmData
    };
    fetch(`${appurl}/profile/${id}`, init).then(res => {
        if (!res.ok) {
            let alertUserProfile = document.getElementById('alertUserProfile');
            alertUserProfile.className = 'alert alert-danger alert-dismissible';
            res.json().then(data => {
                let spnProfileMessage = document.getElementById('userProfileMessage');
                alertUserProfile.style.display = 'block';
                spnProfileMessage.innerHTML = data;
                setTimeout(() => {
                    alertUserProfile.style.display = 'none';
                }, 9000);
            });
        } else {
            res.json().then(data => {
                let alertUserProfile = document.getElementById('alertUserProfile');
                alertUserProfile.className = 'alert alert-success alert-dismissible';
                let spnProfileMessage = document.getElementById('userProfileMessage');
                alertUserProfile.style.display = 'block';
                spnProfileMessage.innerHTML = data;
                userProfile();
                setTimeout(() => {
                    alertUserProfile.style.display = 'none';
                }, 9000);
            });
        }
    }).catch(err => {
        console.log(err);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    userProfile();
});
frmUserProfile.addEventListener('submit', (e) => {
    updateProfile(e);
});