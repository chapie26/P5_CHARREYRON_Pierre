const burl = 'https://api.themoviedb.org/3';
const apikey = '76cebbae31140d094e15deb2671b11a6';
const language = 'fr';
const imageUrl = 'http://image.tmdb.org/t/p/w185';
const date = new Date(Math.floor(Date.now() - 13088670 * 1000));//on soustrait le timestramp de 6mois a la date d'aujourd'hui
const date2 = new Date(Math.floor(Date.now() - 21039030 * 1000));//9mois
const formatDate = `${date.getFullYear()}-${('0' + (date.getMonth()+1)).slice(-2)}-${date.getDate()}`;
const formatDate2 = `${date2.getFullYear()}-${('0' + (date2.getMonth()+1)).slice(-2)}-${date2.getDate()}`;

const movieLast = async function (page = 1) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&release_date.lte=${formatDate}&release_date.gte=${formatDate2}&page=${page}`);
}
movieLast();

const movieGenres =  function () {
    return fetch (`${burl}/genre/movie/list?api_key=${apikey}&language=${language}`);
}

const tvshowGenres = function () {
    return fetch (`${burl}/genre/tv/list?api_key=${apikey}&language=${language}`);
}

const moviesByGenre = function (genre) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_genres=${genre}`);
}

const tvshowsByGenre = function (tvshowsGenres) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_genres=${tvshowsGenres}`);
}


const seasonDetails = function (imdb_id, season_id) {
    console.log(season_id);
    return fetch (`${burl}/tv/${imdb_id}/season/${season_id}?api_key=${apikey}&language=${language}`);
}

const search = async function (search) {
    return fetch(`${burl}/search/multi?api_key=${apikey}&language=${language}&query=${search}`);
}
search();