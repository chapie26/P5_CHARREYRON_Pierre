const burl = 'https://api.themoviedb.org/3';
const apikey = '76cebbae31140d094e15deb2671b11a6';
const language = 'fr';
const imageUrl = 'http://image.tmdb.org/t/p/w185';
const date = new Date(Math.floor(Date.now() - 13088670 * 1000));//on soustrait le timestramp de 6mois a la date d'aujourd'hui
const date2 = new Date(Math.floor(Date.now() - 21039030 * 1000));//9mois
const formatDate = `${date.getFullYear()}-${('0' + (date.getMonth()+1)).slice(-2)}-${date.getDate()}`;
const formatDate2 = `${date2.getFullYear()}-${('0' + (date2.getMonth()+1)).slice(-2)}-${date2.getDate()}`;


const moviePopular = async function (moviePopular) {
    return fetch (`${burl}/movie/popular?api_key=${apikey}&${language}&page=1`);
}
moviePopular();

const tvshowPopular = async function (tvshowPopular) {
    return fetch (`${burl}/tv/popular?api_key=${apikey}&language=${language}&page=1`);
}
tvshowPopular();

const movieAnimePopular = async function (movieAnimePopular) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&with_genres=16`);
}
movieAnimePopular();

const tvshowAnimePopular = async function (tvshowAnimePopular) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&with_genres=16`);
}
tvshowAnimePopular();

const movieLast = async function (movieLast) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&air_date.lte=${formatDate}&air_date.gte=${formatDate2}&page=1`);
}
movieLast();

const tvshowLast = async function (tvshowLast) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&air_date.lte=${formatDate}&air_date.gte=${formatDate2}&page=1`);
}
tvshowLast();

const movieAnimeLast = async function (movieAnimeLast) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&with_genres=16&air_date.lte=${formatDate}&air_date.gte=${formatDate2}&page=1`);
}
movieAnimeLast();

const tvshowAnimeLast = async function (tvshowAnimeLast) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&with_genres=16&air_date.lte=${formatDate}&air_date.gte=${formatDate2}&page=1`);
}
tvshowAnimeLast();

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

const searchPeople = function (name_people) {
    return fetch (`${burl}/search/person?api_key=${apikey}&language=${language}&query=${name_people}&page=1`);
}

const movieActor = function (people_id) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_cast=${people_id}`);
}

const tvshowActor = function (people_id) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_cast=${people_id}`);
}

const movieRealisator = function (people_id) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_crew=${people_id}`);
}

const tvshowRealisator = function (people_id) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_crew=${people_id}`);
}

const searchCompany = function (query) {
    return fetch (`${burl}/search/company?api_key=${apikey}&query=${query}&page=1`);
}

const tvshowByCompany = function (company_id) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_companies=${company_id}`);
}

const movieByCompany = function (company_id) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&with_companies=${company_id}`);
}

const movieYear = function (year) {
    return fetch (`${burl}/discover/movie?api_key=${apikey}&language=${language}&sort_by=popularity.desc&page=1&year=${year}`);
}

const TVshowYear = function (year) {
    return fetch (`${burl}/discover/tv?api_key=${apikey}&language=${language}&sort_by=popularity.desc&first_air_date_year=${year}&page=1`);
}

const seasonDetails = function (imdb_id, season_id) {
    return fetch (`${burl}/tv/${imdb_id}/season/${season_id}?api_key=${apikey}&language=${language}`);
}

const search = async function (search) {
    return fetch(`${burl}/search/multi?api_key=${apikey}&language=${language}&query=${search}`);
}
search();