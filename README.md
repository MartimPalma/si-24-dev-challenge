# RedLight Summer Internship 2024 - Dev Challenge

![banner](/assets/banner.png)

#

In this year’s challenge we ask you to implement a **Francesinha Wiki** 🥪! In this platform, the users should be able to look for francesinhas and the respective restaurants, as well as review them and check their details 

## **Main Goals**

This platform should allow the user to:

-   Register new francesinhas
    
-   List registered francesinhas
    
-   Show an already registered francesinha
    
-   Update each francesinha details
    
-   Delete francesinha registries
    
-   Register new restaurants
    
-   List existing restaurants
    
-   Show the details of an existing restaurant and list its available francesinhas
    
-   Update an existing restaurant
    
-   Delete an existing restaurant
    
-   Search for restaurants and francesinhas
    

## **Structure and Entities**

A **francesinha** entry is composed by:

-   Name
    
-   Price
    
-   Rating (between 1-5)
    
-   Ingredients
    
-   Photos (optional)
    
-   Restaurant

**Example**:

-   Name: Mega Francesinha
    
-   Price: 10
    
-   Classification: 4,9
    
-   Ingredients: Ham, Steak, Egg, Cheese, Bacon, Sausage, Bread, Francesinha sauce
    
-   Restaurant: A Biquinha
    

A **restaurant** is composed by:

-   Name
    
-   Address
    
-   City
    
-   Country
    
-   Rating (between 1-5)
    
-   Francesinhas
    

**Example**:

-   Name: A Biquinha
    
-   Address: Rua das Padeiras 88, 3000-311 Coimbra
    
-   City: Coimbra”
    
-   Country: Portugal
    
-   Classification (1-5 stars): 5.0
    
-   Francesinhas: Mega Francesinha, Chicken Francesinha, Omelet francesinha
    

**
## Phases
**

#### The frontend

On the frontend phase we want to see web pages where you can complete the goals established before. That is, create, list, search, update, and delete both francesinhas and restaurants.

Feel free to use any CSS frameworks like Tailwind, Bootstrap, or any similar one if you are familiar with it. If you want a challenge you can also try to finish this step using any web framework such as React, Angular or VueJS.

#### The backend

For the backend you should develop a server that responds to the frontend requests and integrates with a database that stores the information about the francesinhas and restaurants.

Here you're also free to use any backend technology you're familiar with, be it Ruby on Rails, .NET, Django, ExpressJS, or any other of your choosing. For database technologies you can achieve this either using relational databases such as PostgreSQL and MySQL or by using non-relational databases such as MongoDB.

#### Some extras

Once the application allows the user to perform the main goals, you can also develop the following extras:

-   Make the mentioned entities soft deletable, which can be recovered after.
    
-   Turn Ingredients into actual entities/classes, which can be associated to many francesinhas, edited (at least the name field), searched or deleted.
    
-   Validate that the backend can only receive the parameters you want it to receive, no more, no less.
    
-   Create validations for the form fields.
    
-   Add sorting by classification and name to the search functionality
    
-   Upload photos for a francesinha entry
    

#### Tips

Take advantage of your strengths. If you feel that the backend is not going so well then focus more on the frontend and vice versa.

## **Delivery**

Consider adding a README.md file to the project with documentation on how to set up and run the project when testing it, as well as any important general information that we should know about the project and its code.

When you're done, you should fork this repository and upload your work there to share it with us or you can simply send everything in a .zip folder or a WeTransfer link. Please try to share your process going through the steps you took to reach your final version.
