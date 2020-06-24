const movArray = document.getElementById('movie');

const movieInterval = setInterval(() => {
    movieGenres()
    .then((data) => data.json())
    .then((data) => {
        for (let index = 0; index < data.genres.length; index ++) {
            const myGenre = data.genres[index];
            const block = document.createElement('div');
            const genreContainer = document.createElement('div');
            genreContainer.classList.add('genreContainer');
            const heading1 = document.createElement('h1');
            const nom = document.createTextNode(myGenre.name);
            const value = myGenre.id;
            block.appendChild(heading1);
            heading1.appendChild(nom);
            block.appendChild(genreContainer);
            movArray.appendChild(block);
            moviesByGenre(value)
            .then((movie) => movie.json())
            .then((movie) => {
                for (let index = 0; index < movie.results.length; index++) {
                    const item = movie.results[index];
                    const container = document.createElement('a');
                    container.setAttribute('href', `/OCP5/index.php?action=movieDetail&id=${item.id}` );
                    container.classList.add('movieTitle');
                    const title = document.createTextNode(item.title);
                    const image = document.createElement('img');
                    if (item.poster_path != null) {
                        image.setAttribute('src', `${imageUrl}/${item.poster_path}`);
                    }
                    const heading2 = document.createElement('h2');
                    container.appendChild(image);
                    container.appendChild(heading2);
                    heading2.appendChild(title);
                    genreContainer.appendChild(container);
                }
            });
        }
    })
    clearInterval(movieInterval);
}, 100);