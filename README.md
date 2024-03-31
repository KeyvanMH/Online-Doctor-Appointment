# overview
 ### Online doctor appointment
Online doctor appointment is a API for reserving online appointment for clinic with lot's of feature's!
 # Features
- **Doctors** have their own profiles and dashboards.
- The API incorporates **JWT**, allowing for a streamlined login process for **doctors** without the need to manually input their information.
- **Doctors** can view their schedule and personal information within their dashboard.
- **Doctors** can update their account information such as password, contact number, email, address, etc.
- **Doctors** can upload their own profile picture.
- **Doctors** can cancel and add reservations for themselves.
- **Patients** can make appointments using only their name and phone number, and they will receive a confirmation number in return.
- This API includes a search engine for **patients** to find **doctors** by name, city, specialty, or address.
- **Patients** can cancel their reservation using the confirmation number.
- **Patients** can view their preferred doctor's schedule to easily choose a reservation time.
- **Patients** can view the doctor's profile photo if available.





# Table of Contents
- [Requirements](#requirements)
- [Database](#database)
- [How to Install](#how-to-install)
- [Documentation](#documentation)

## Requirements
To run this PHP API, you will need the following software and dependencies:
- **XAMPP Version 3.3.0:** This API requires XAMPP to be installed. If you don't have XAMPP installed, you can download it from [XAMPP official website](https://www.apachefriends.org/index.html).
- **Composer:** Composer is a dependency manager for PHP. You can download and install Composer from [Composer official website](https://getcomposer.org/download/).
- **PHP Version 8.2:** Ensure that your PHP version is 8.2 or higher to run this API.

## Database
This API uses MySQL as the database management system. You need to create two databases with the specified names. Detailed instructions for setting up the databases can be found in the [documentation file](./documentation).

## How to Install
To install the necessary dependencies for this API, follow these steps:
1. **XAMPP and Composer Installation:** Make sure that XAMPP and Composer are installed on your system. If not, follow the installation instructions provided in the links above.
2. **Install Required Library:** Run the following command in the command line to install the required library:
    ```bash
    composer require firebase/php-jwt:^6.10
    ```

## Documentation
For comprehensive documentation and usage guidelines, please refer to the [documentation file](./documentation) in the project directory.

