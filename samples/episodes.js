form = document.getElementById('form-episodes')
form.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(e.target)
    fetch('episodes.php?episode=' + formData.get('episode'))
        .then(response => response.json())
        .then(respJson => {
            console.log(respJson)
            document.getElementById('name').innerHTML = respJson.name
            document.getElementById('air_date').innerHTML = respJson.air_date
            document.getElementById('episode_code').innerHTML = respJson.episode
        });
})