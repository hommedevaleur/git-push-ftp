
function getLawyers() {
    $("#spinner-handler").css({ "display": "flex" })
    $.ajax({
        url: "backend/lawyer.php?q=list",
        method: "get",
        data: JSON.stringify({})
    }).done((res) => {
        $("#spinner-handler").css({ "display": "none" })
        r = JSON.parse(res)
        let content = ""
        if (r.length > 0) {
            content = `<h1>Liste des professionnels</h1>
        <table class="table table-striped">
            <thead><tr>
                <th>Nom</th>
                <th>prenom</th>
                <th>Email</th>
                <th>Domaine</th>
                <th>Ville</th>
                <th>Option</th>
            </tr></thead><tbody>`
            r.forEach(j => {
                let domains = getDomainLawyer(j.id)
                content += `
            <tr>
                <td>${j.name}</td>
                <td>${j.lastName}</td>
                <td>${j.email}</td>
                <td>${domains}</td>
                <td>${j.cityName}</td>
                <td><button id=${j.id} class="btn btn-primary" onclick="getRdv(this.id)">Selectionner</button></td>
            </tr>`
            })
            content += `</tbody></table>`
        } else {
            content = `<h1>Liste des professionnels</h1>
        <div class="alert alert-danger" role="alert">no data...</div>`
        }
        $("#liste_juriste").html(content)
    }).fail((err) => {
        console.log(err)
    })
}

function getLawyer(domainId, cityId) {
    $("#spinner-handler").css({ "display": "flex" })
    $.ajax({
        url: "backend/lawyer.php?q=search",
        method: "post",
        data: JSON.stringify({
            "domainId": domainId,
            "cityId": cityId
        })
    }).done((res) => {
        $("#spinner-handler").css({ "display": "none" })
        r = JSON.parse(res)
        if(r.length>0){
        content = `<h1>Liste des professionnels</h1>
        <table class="table table-striped">
            <thead><tr>
                <th>Nom</th>
                <th>prenom</th>
                <th>Email</th>
                <th>Domaine</th>
                <th>Ville</th>
                <th>Option</th>
            </tr></thead><tbody>`
            r.forEach(j => {
                let domains = getDomainLawyer(j.id)
                content += `
            <tr>
                <td>${j.name}</td>
                <td>${j.lastName}</td>
                <td>${j.email}</td>
                <td>${domains}</td>
                <td>${j.cityName}</td>
                <td><button id=${j.id} class="btn btn-primary" onclick="getRdv(this.id)">Selectionner</button></td>
            </tr>`
            })
            content += `</tbody></table>`
        } else {
            content = `<h1>Liste des professionnels</h1>
        <div class="alert alert-danger" role="alert">no data...</div>`
        }
        $("#liste_juriste").html(content)
    }).fail((err) => {
        console.log(err)
    })
}

function getCities() {
    $("#spinner-handler").css({ "display": "flex" })
    $.ajax({
        url: "backend/city.php?q=list",
        method: "get",
        data: JSON.stringify({})
    }).done((res) => {
        $("#spinner-handler").css({ "display": "none" })
        r = JSON.parse(res)
        let content = ""
        if (r.length > 0) {
            content = `<select class="form-select form-select-lg" aria-label="Default select example" id="cityId">
            <option value="">choose city</option>`
            r.forEach(c => {
                content += `<option value="${c.id}">${c.name}</option>`
            });
            content += `</select>`
        } else {
            content = `<select class="form-select form-select-lg" aria-label="Default select example" id="cityId">
            <option value="">no data loaded</option>
            </select>`
        }
        $("#input-city").html(content)
    })
}
function getDomains() {
    $("#spinner-handler").css({ "display": "flex" })
    $.ajax({
        url: "backend/domain.php?q=list",
        method: "get",
        data: JSON.stringify({})
    }).done((res) => {
        $("#spinner-handler").css({ "display": "none" })
        r = JSON.parse(res)
        let content = ""
        if (r.length > 0) {
            content = `<select class="form-select form-select-lg" aria-label="Default select example" id="domainId">
            <option value="">choose domain</option>`
            r.forEach(c => {
                content += `<option value="${c.id}">${c.name}</option>`
            });
            content += `</select>`
        } else {
            content = `<select class="form-select form-select-lg" aria-label="Default select example" id="domainId">
            <option value="">no data loaded</option>
            </select>`
        }
        $("#input-domain").html(content)
    }).fail((err) => {
        console.log(err)
    })
}

function getDomainLawyer(lawyerId) {
    $("#spinner-handler").css({ "display": "flex" })
    let content = ""
    $.ajax({
        url: "backend/domain.php?q=domainLawyer&lawyerId=" + lawyerId,
        method: "get",
        data: JSON.stringify({}),
        async: false
    }).done((res) => {
        $("#spinner-handler").css({ "display": "none" })
        r = JSON.parse(res)
        if (r.length > 0) {
            r.forEach(d => {
                content += `<span class="badge rounded-pill text-bg-primary">${d.name}</span>`
            });
        } else {
            content += "no data"
        }
    }).fail((err) => {
        console.log(err)
    })
    return content
}

function getRdv(id){
    alert("prendre rdv avec le pro id->"+id)
    location.href="reservation.html?lawyer=1"
}