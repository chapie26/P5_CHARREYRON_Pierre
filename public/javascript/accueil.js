const movArray = document.getElementById('lastMovies');
var page = 1;

// const movieInterval = setInterval(getLastMovie(), 100);

const getLastMovie = () => {
    movieLast(page)
    .then((data) => data.json())
    .then((data) => {
        for (let index = 0; index < data.results.length; index++) {
            const item = data.results[index];
            const container = document.createElement('a');
            container.setAttribute('href', `/OCP5/index.php?action=movieDetail&id=${item.id}`);
            container.classList.add('movieLast');
            const title = document.createTextNode(item.title);
            const image = document.createElement('img');
            if (item.poster_path != null) {
                image.setAttribute('src', `${imageUrl}/${item.poster_path}`);
            }
            const heading2 = document.createElement('h2');
            container.appendChild(image);
            container.appendChild(heading2);
            heading2.appendChild(title);
            movArray.appendChild(container);
        }
    })
}
const movieInterval = setInterval(getLastMovie(), 100);