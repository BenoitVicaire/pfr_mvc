
// Dictionaire traduction
const translation = {
	fr: {
		login: "Se connecter",
		logout: "Se déconnecter",
		profil : "Mon profil",
		messages : "Message",
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
		//
		login_title: "Connexion",
		tab_register: "S'inscrire",
		tab_login: "Se connecter",
		register_title: "S'inscrire",
		login_form_title: "Se connecter",
		email_placeholder: "Email",
		password_placeholder: "Mot de passe",
		password_confirm_placeholder: "Veuillez vérifier votre mot de passe",
		name_placeholder: "Nom",
		create_account_btn: "Créer le compte",
		login_btn: "Connexion",
		welcome_message: "Bonjour",
		welcome_back_home: "Revenir à la page d'accueil",
		congrats: "Félicitations !"
	},
	gb: {
		login: "Login",
		logout: "Logout",
		profil: "My profil",
		messages : "Message",
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
		//
		login_title: "Login",
		tab_register: "Sign up",
		tab_login: "Log in",
		register_title: "Sign up",
		login_form_title: "Log in",
		email_placeholder: "Email in english",
		password_placeholder: "Password",
		password_confirm_placeholder: "Please confirm your password",
		name_placeholder: "Name",
		create_account_btn: "Create account",
		login_btn: "Login",
		welcome_message: "Hello",
		welcome_back_home: "Back to homepage",
		congrats: "Congratulations!"
	}
};

// fonction pour changer la langue

export function setLanguage(lang) {
	document.querySelectorAll("[data-i18n]").forEach(el=>{
		const key =el.getAttribute("data-i18n");

		if(translation[lang][key]){
			el.textContent = translation[lang][key];
		}
	});

	document.querySelectorAll("[data-i18n-placeholder]").forEach(el => {
        const key = el.dataset.i18nPlaceholder;
        if (translation[lang][key]) {
            el.placeholder = translation[lang][key];
        }
    });

	localStorage.setItem("lang", lang);

	// document.querySelector("#loginLink").textContent = texts[lang].login;
	// document.querySelector("#logoutLink").textContent = texts[lang].logout;
	// document.querySelector("#my_profil").textContent = texts[lang].profil;
	// document.querySelector("#language").textContent = texts[lang].language;
	// document.querySelector("#article1_title").textContent = texts[lang].article1_title;
	// document.querySelector("#article2_title").textContent = texts[lang].article2_title;
	// document.querySelector("#article3_title").textContent = texts[lang].article3_title;
	// document.querySelector("#article1_text").textContent = texts[lang].article1_text;
	// document.querySelector("#article2_text").textContent = texts[lang].article2_text;
	// document.querySelector("#article3_text").textContent = texts[lang].article3_text;
	// document.querySelector("#legal").textContent = texts[lang].legal;
	// document.querySelector("#tos").textContent = texts[lang].tos;
	// document.querySelector("#contact_support").textContent = texts[lang].contact_support;
}

// export function initLangue() {
//     setLanguage("fr");
// }

