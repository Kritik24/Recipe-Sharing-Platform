<!DOCTYPE html>
<html lang="en">

<head>
  <title>Recipe Sharing Platform</title>
  <link rel="stylesheet" href="mainproject.css" />
</head>

<body>
  <div class="nav">
    <h1>Recipe Sharing Platform</h1>
    <button id="logout"><a href="login/login.php">Logout</a> </button>
  </div>

  <div class="container">
    <div class="list">
      <!-- Search Section -->
      <div class="search-container">
        <h1>Recipe Search</h1>
        <div class="search-box">
          <input type="text" id="searchInput" placeholder="Search recipes..." />
          <button id="searchButton">Search</button>

          <!-- Add Recipe Button -->
          <section id="add-recipe-section">
            <button id="addRecipeButton">+</button>
          </section>
        </div>
        <p id="errorMessage" class="hidden">
          No recipes found. Please try again.
        </p>
      </div>

      <!-- Results Section -->
      <div class="results-container">
        <h2>Search Results:</h2>
        <ul id="resultsList"></ul>
      </div>

      <!-- Popup Modal for Add Recipe -->
      <div id="addRecipeModal" class="modal">
        <div class="modal-content">
          <span class="close-button">&times;</span>
          <h2>Add Recipe</h2>
          <form id="addFoodForm">
            <label for="foodName">Recipe Name:</label>
            <input type="text" id="foodName" name="foodName" required />

            <label for="foodDetails">Ingredients:</label>
            <textarea id="foodDetails" name="foodDetails" required></textarea>

            <label for="steps">Steps:</label>
            <textarea id="steps" name="steps" required></textarea>

            <button type="submit">Add</button>
          </form>
        </div>
      </div>
    </div>
    <div class="main"></div>
  </div>
  <script src="script.js"></script>

</body>

</html>