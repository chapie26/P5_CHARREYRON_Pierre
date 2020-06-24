const seasonsLink = document.querySelectorAll('.button');
const episodeArray = document.getElementById('episodes');
const urlParams = new URLSearchParams(window.location.search);
const imdbId = urlParams.get('id');

for (let index = 0; index < seasonsLink.length; index++) {
    const element = seasonsLink[index]
    element.addEventListener('click', function() {
        episodeArray.style.display = 'flex';
        seasonNumber = element.getAttribute("season");
        seasonDetails(imdbId, seasonNumber)
        .then((data) => data.json())
        .then((data) => {
            const div = document.getElementById('episodes');
            while(div.firstChild) {
                div.removeChild(div.firstChild);
            }
            for (let index = 0; index < data.episodes.length; index ++) {
                const episode = data.episodes[index];
                const container = document.createElement('div');
                container.classList.add('contenuEpisode');
                const numero = document.createTextNode(episode.episode_number);
                const title = document.createTextNode(episode.name);
                const paragraph = document.createElement('p');
                paragraph.classList.add('numberEpisode');
                const image = document.createElement('img');
                image.classList.add('imgEpisode');
                if (episode.still_path != null) {
                    image.setAttribute('src', `${imageUrl}/${episode.still_path}`);
                }
                else {
                    image.setAttribute('src', 'public/images/avatar_default.png');
                    image.classList.add('notFoundEpisode');
                }
                const heading3 = document.createElement('h3');
                container.appendChild(paragraph);
                paragraph.appendChild(numero);
                container.appendChild(image);
                container.appendChild(heading3);
                heading3.appendChild(title);
                episodeArray.appendChild(container);
            }
        });
    });
}