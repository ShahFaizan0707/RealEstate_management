<!-- add_property.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
    <link rel="stylesheet" href="css/add_property.css">
</head>
<body>
<div class="button-container">
    <h1 class="add-property-heading">Add Property</h1>
    <button type="button" class="my-properties-button" onclick="location.href='my_properties.php';">My Properties</button>
</div>
    <form id="propertyForm" action="php/add_property.php" method="POST" enctype="multipart/form-data">
        <label for="propertyName">Property Name:</label>
        <input type="text" id="propertyName" name="propertyName" required><br>
        
        <label for="propertyLocation">Property Location:</label>
        <input type="text" id="propertyLocation" name="propertyLocation" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br>
        
        <label for="bhkType">BHK Type:</label>
        <select id="bhkType" name="bhkType">
            <option value="any">Any</option>
            <option value="1BHK">1 BHK</option>
            <option value="2BHK">2 BHK</option>
            <option value="3BHK">3 BHK</option>
            <!-- Add more options as needed -->
        </select><br>
        
        <label for="budget">Budget (₹):</label>
        <select id="budget" name="budget">
            <option value="5000">₹5000</option>
            <option value="10000">₹10000</option> 
            <option value="15000">₹15000</option>
            <option value="20000">₹20000</option>
            <option value="25000">₹25000</option>
            <option value="30000">₹30000</option>
            <option value="35000">₹35000</option>
            <option value="40000">₹40000</option>
            <option value="45000">₹45000</option>
            <option value="50000">₹50000</option>
            <option value="60000">₹60000</option>
            <option value="70000">₹70000</option>
            <option value="80000">₹80000</option>
            <option value="90000">₹90000</option>
            <option value="100000">₹100000</option>
            <option value="120000">₹120000</option>
            <option value="150000">₹150000</option>
            <option value="200000">₹2 L+</option>
        </select><br>
        
        <label for="propertyType">Property Type:</label>
        <select id="propertyType" name="propertyType">
            <option value="any">Any</option>
            <option value="apartment">Apartment</option>
            <option value="villa">Villa</option>
            <option value="house">House</option>
            <!-- Add more options as needed -->
        </select><br>
        
        <label for="builtUpArea">Built-up Area (sqft):</label>
        <select id="builtUpArea" name="builtUpArea">
            <option value="500">500 sqft</option>
            <option value="1000">1000 sqft</option>
            <option value="1500">1500 sqft</option>
            <option value="2000">2000 sqft</option>
            <option value="2500">2500 sqft</option>
            <option value="3000">3000 sqft</option>
            <option value="3500">3500 sqft</option>
            <option value="4000">4000 sqft</option>
            <option value="4500">4500 sqft</option>
            <option value="5000">5000 sqft</option>
        </select><br>
        
        <label for="furnishingType">Furnishing Type:</label>
        <select id="furnishingType" name="furnishingType">
            <option value="any">Any</option>
            <option value="unfurnished">Unfurnished</option>
            <option value="semiFurnished">Semi-furnished</option>
            <option value="fullyFurnished">Fully furnished</option>
            <!-- Add more options as needed -->
        </select><br>
        
        <label for="propertyAge">Property Age:</label>
        <input type="number" id="propertyAge" name="propertyAge" required><br>
        
        <label for="propertyImage">Property Image:</label>
        <input type="file" id="propertyImage" name="propertyImage" accept="image/*" required><br>
        
        <input type="hidden" name="sellerId" value="<?php echo $_SESSION['seller_id']; ?>">
        
        <button type="submit">Add Property</button>
    </form>
</body>
</html>
