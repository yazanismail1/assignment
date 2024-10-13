<p align="center">
    <h1 align="center">Code Structure, Implemented Features & Further Improvements</h1>
    <br>
</p>

# Overview
This project is structured using the Yii2 framework and follows the Model-View-Controller (MVC) architecture. It is divided into two main components: the backend (dashboard) and the frontend (storefront). The backend handles administrative functions and background jobs, while the frontend focuses on user interactions, such as viewing car listings and managing purchases.

## Directory Structure
- common/

    - Contains shared models and components used by both the backend and frontend.

    - models/

        - CarListing.php: Represents the car listing data model, including attributes like title, make, model, year, price, mileage, and status.
        - CarListingSearch.php: Provides search functionality for car listings, allowing for filtering and sorting based on various criteria.

- dashboard/ (Backend)

    - Contains the administrative panel and related functionality.

    - controllers/

        - CarListingController.php: Manages CRUD operations for car listings, including creating, reading, updating, and deleting listings.
        - JobManagementController.php: Handles job management for background tasks, such as exporting car listings.

    - jobs/

        - CarListingExportJob.php: Represents the background job for exporting car listings to a CSV file.

    - views/

        - car-listing/

            - index.php: Displays a list of car listings with options for CRUD operations.
            - view.php: Shows the detailed view of a specific car listing.
            - create.php: Form for creating a new car listing.
            - update.php: Form for updating an existing car listing.
            - export-files.php: Displays generated export files with download options.
            - job-management.php: Lists queued jobs for management.

- frontend/ (Storefront)

    - Contains user-facing functionality for car listings and purchases.

    - controllers/

        - CarListingController.php: Displays car listings, allowing users to view details and make purchases.

    - views/

        - car-listing/

            - index.php: Displays the list of car listings with filtering and sorting options.
            - view.php: Shows the detailed view of a specific car listing, including purchase options.

## Key Features
- Car Listings: Users can view car listings with filtering and sorting options.
- Purchasing: Users can purchase a car, which updates the status of the listing and associates it with the user.
- Job Management: Admins can manage background jobs, such as exporting car listings to CSV.
- User Purchases: Authenticated users can view their purchased car listings.

## Further Improvements
- Caching: Introducing caching can help the performance and the retrieval of the data which will conclude less server computing and better user experience and smoothness.
- Include images for the listing which it will visualize and ease the process of making the user decide upon purchasing a certain car.
- Payment gateways: Implementing payment gateways can finalize the process of the user life cycle and finalize a MVP to be launched.
- Activate the email sending where verify and activate the users accounts.
- UX/UI enhancements.
- Create a sales dashboard feature for admins (e.g., total sales, most popular models)
- Introducing Docker and Kubernetes


[⇽ Go Back](./README.md)