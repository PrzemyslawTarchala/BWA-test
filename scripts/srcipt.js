const body = document.querySelector("body"),
			sidebar = document.querySelector(".sidebar"),
			toggle = document.querySelector(".toggle"),
			searchBtn = document.querySelector(".search-box"),
			modeSwitch = document.querySelector(".toggle-switch"),
			modeText = document.querySelector(".mode-text"),
			
			expand = document.querySelector(".expand"),
			expanseCategoryList = document.querySelector(".expense-data .category .input");


			toggle.addEventListener("click", () => {
				sidebar.classList.toggle("close");
			});

			modeSwitch.addEventListener("click", () => {
				body.classList.toggle("dark");

				if(body.classList.contains("dark")){
					modeText.innerText = "Light Mode";
				} else{
					modeText.innerText = "Dark Mode";
				}
			});
