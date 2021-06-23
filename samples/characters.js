form = document.getElementById('form-characters')
form.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(e.target)
    fetch('characters.php?character=' + formData.get('character'))
        .then(response => response.json())
        .then(respJson =>
        {
            document.getElementById('name').innerHTML = respJson.name;
            document.getElementById('status').innerHTML = respJson.status;
            document.getElementById('species').innerHTML = respJson.species;
            document.getElementById('gender').innerHTML = respJson.gender;
            let imgElement = document.getElementById('image');
            imgElement.setAttribute('src', respJson.image);
        });
})

