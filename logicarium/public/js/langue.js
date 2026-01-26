// Dictionaire traduction
const texts = {
	fr: {
		login: "Se connecter",
		profil : "Mon profil",
		language : "Langue",
		article1_title: "Découvrez notre nouveau jeu : Protect the dungeon",
		article2_title: "Découvrez notre nouveau jeu : Protect the dungeon",
		article3_title: "Découvrez notre nouveau jeu : Protect the dungeon",
		article1_text:"Une nouvelle aventure commence : une horde de monstres veux manger vos concitoyen, protégez vos confère en érigeant une défense impénétrable!",
		article2_text:"Une nouvelle aventure commence : une horde de monstres veux manger vos concitoyen, protégez vos confère en érigeant une défense impénétrable!",
		article3_text:"Une nouvelle aventure commence : une horde de monstres veux manger vos concitoyen, protégez vos confère en érigeant une défense impénétrable!",
		legal:"Mention légale",
		tos:"Mention d'usage",
		contact_support:"Contacter le support",
	},
	gb: {
		login: "Login",
		profil: "My profil",
		language : "Language",
		article1_title: "Discover our new game: Protect the Dungeon",
		article2_title: "Discover our new game: Protect the Dungeon",
		article3_title: "Discover our new game: Protect the Dungeon",
		article1_text:"A new adventure begins: a horde of monsters wants to eat your fellow citizens, protect your colleagues by erecting an impenetrable defense!",
		article2_text:"A new adventure begins: a horde of monsters wants to eat your fellow citizens, protect your colleagues by erecting an impenetrable defense!",
		article3_text:"A new adventure begins: a horde of monsters wants to eat your fellow citizens, protect your colleagues by erecting an impenetrable defense!",
		legal:"Legal mention",
		tos:"Terme of use",
		contact_support:"Contact support",
	}
};

// fonction pour changer la langue
function setLanguage(lang) {
	document.querySelector(".login").textContent = texts[lang].login;
	document.querySelector(".my_profil").textContent = texts[lang].profil;
	document.querySelector("#language").textContent = texts[lang].language;
	document.querySelector("#article1_title").textContent = texts[lang].article1_title;
	document.querySelector("#article2_title").textContent = texts[lang].article2_title;
	document.querySelector("#article3_title").textContent = texts[lang].article3_title;
	document.querySelector("#article1_text").textContent = texts[lang].article1_text;
	document.querySelector("#article2_text").textContent = texts[lang].article2_text;
	document.querySelector("#article3_text").textContent = texts[lang].article3_text;
	document.querySelector("#legal").textContent = texts[lang].legal;
	document.querySelector("#tos").textContent = texts[lang].tos;
	document.querySelector("#contact_support").textContent = texts[lang].contact_support;
}
