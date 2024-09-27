<?php

// PHP уровень 1

$db = mysqli_connect("localhost", "root", "root", "geekbrains");

/*
Использую антипаттерн Жесткое кодирование, прописывая подключение к БД
Также использую этот код на каждой странице.

Решение: Вынести код подключения в отдельный файл и создать конфиг с переменными
Здесь также можно использовать Антипаттерн Singleton
*/

// Мой проект (JS)

for (let m of mobs) {
    if ((m.dataset.castle == castleFilter || castleFilter == 'all')
        &&(m.dataset.level == levelFilter || levelFilter == 'all')
        &&(m.dataset.engname.includes(nameFilter.toLowerCase())
        || m.dataset.rusname.includes(nameFilter.toLowerCase())
        || (m.dataset.move.toLowerCase()).includes(nameFilter.toLowerCase())
        || (m.dataset.stat.toLowerCase()).includes(nameFilter.toLowerCase())
        || (m.dataset.land.toLowerCase()).includes(nameFilter.toLowerCase())
        || ('стрелок'.includes(nameFilter.toLowerCase()) && m.dataset.shoots != '-')
        || ('стреляет'.includes(nameFilter.toLowerCase()) && m.dataset.shoots != '-')
        || (m.dataset.hexes.toLowerCase()).includes(nameFilter.toLowerCase())
        || nameFilter == '')) {

        m.classList.remove('hidden');
    }
}

/*
Антипаттерн Спагетти-код с большим количеством условий в теле if ()

Решение: Вынести основные условия отдельно, а дальше сделать вложенные или делегировать проверки отдельным методам
*/

for (let l of links) {
    if (l.classList.contains('disabled')) {
        for (let sl of sublinks) {
            if (sl.name == l.id) {
                sl.classList.add('disabled');
            }
        }
    } else {
        for (let sl of sublinks) {
            if (sl.name == l.id) {
                sl.classList.remove('disabled');
            }
        }
    }
}

/*
Чрезмерная вложенность циклов и условий одни в другие

Решение: Изменить структуру элементов, чтобы можно было проходить по ним одним циклом
*/

const gridRebuild = (elem) => {
	let width = elem.offsetWidth;
	if (width > 880) {elem.style.gridTemplateColumns = 'repeat(7, 120px)';}
	else if (width > 770 && width <= 880) {elem.style.gridTemplateColumns = 'repeat(6, 120px)';}
	else if (width > 655 && width <= 770) {elem.style.gridTemplateColumns = 'repeat(5, 120px)';}
	else if (width > 520 && width <= 655) {elem.style.gridTemplateColumns = 'repeat(4, 120px)';}
	else if (width > 390 && width <= 520) {elem.style.gridTemplateColumns = 'repeat(3, 120px)';}
	else {elem.style.gridTemplateColumns = 'repeat(2, 120px)';}
};

/*
Пример использования Магических чисел, когда не понятна суть этих чисел

Решение: Создать числовые переменные и назвать их соответствующим образом, затем подставлять эти переменные в условия
*/

const changeTown = (town) => {
    townSelector.value = town;
    clearFields();
    changeTownIcon(town);
    changeTownInfo(town);
    changeTownAudio(town);
    changeTownBack(town);
    changeColor(town);
    pullStructures(town);
    changeTownScheme(town);
    pullMobs(town);
    pullHeroes(town);
    changeTownMosaic(town);
    changeAppearance(town);
};

/*
Метод Полтергейст, который просто вызывает другие методы, но ничего не делает сам

Решение: Повесить использование этих методов на обработчики событий
*/
