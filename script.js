const addRecipeButton = document.getElementById("addRecipeButton");
const addRecipeModal = document.getElementById("addRecipeModal");
const closeModalButton = document.querySelectorAll(".close-button");
const addFoodForm = document.getElementById("addFoodForm");
const resultsList = document.getElementById("resultsList");
const mainDiv = document.querySelector(".main");
const searchInput = document.getElementById("searchInput");
const searchButton = document.getElementById("searchButton");
const errorMessage = document.getElementById("errorMessage");

let allRecipes = []; // Store all recipes

let currentRecipeId = null;

// Open modal to add a recipe
addRecipeButton.addEventListener("click", () => {
  addRecipeModal.style.display = "block";
});

// Close modals
closeModalButton.forEach(button => {
  button.addEventListener("click", () => {
    addRecipeModal.style.display = "none";
  });
});

// Submit form to add a new recipe
addFoodForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = new FormData(addFoodForm);

  fetch("saveRecipe.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert(data.message);
        addRecipeModal.style.display = "none";
        fetchRecipes(); // Refresh recipes after adding
      } else {
        alert(data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});

// Fetch and display recipes (without search functionality)
function fetchRecipes() {
  fetch("fetchRecipes.php")
    .then((response) => response.json())
    .then((data) => {
      allRecipes = data; // Store all recipes
      displayRecipes(allRecipes); // Display all recipes initially
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Function to filter and display recipes based on search query
function filterRecipes(query) {
  const filteredRecipes = allRecipes.filter(recipe => {
    return recipe.Recipe_Name.toLowerCase().includes(query.toLowerCase()) ||
           recipe.Ingredients.toLowerCase().includes(query.toLowerCase());
  });

  displayRecipes(filteredRecipes); // Display filtered recipes

  // Show error message if no results found
  if (filteredRecipes.length === 0) {
    errorMessage.classList.remove("hidden");
  } else {
    errorMessage.classList.add("hidden");
  }
}

// Function to display recipes in the results list
function displayRecipes(recipes) {
  resultsList.innerHTML = ""; // Clear the existing list
  recipes.forEach((recipe) => {
    const listItem = document.createElement("li");
    listItem.innerHTML = `
      <h3 class="recipe-title">${recipe.Recipe_Name}</h3>
    `;

    listItem.addEventListener("click", () => displayRecipeInMain(recipe));
    resultsList.appendChild(listItem);
  });
}

// Display single recipe in the .main div (right side)
function displayRecipeInMain(recipe) {
  mainDiv.innerHTML = `
    <h2>${recipe.Recipe_Name}</h2>
    <p><strong>Ingredients:</strong> ${recipe.Ingredients}</p>
    <p><strong>Steps:</strong> ${recipe.Steps}</p>
  `;
}

// Event listener for search button
searchButton.addEventListener("click", () => {
  const query = searchInput.value.trim();
  filterRecipes(query); // Filter recipes based on the search query
});

// Initial fetch (show all recipes initially)
fetchRecipes();
