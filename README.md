# Eboss core

### Table of content

- [Eboss core](#eboss-core)
  - [Table of content](#table-of-content)
  - [Project Overview](#project-overview)
  - [Installation](#installation)
  - [Folder Structure](#folder-structure)
  - [Core Classes description](#core-classes-description)
    - [API response Class and Methods](#api-response-class-and-methods)
    - [error handling Class and Methods](#error-handling-class-and-methods)
    - [File upload Class and Methods](#file-upload-class-and-methods)
    - [handle token](#handle-token)
    - [Database Class and Methods](#database-class-and-methods)
      - [Inserting data method](#inserting-data-method)
      - [Updating data method](#updating-data-method)
      - [Fetching data method](#fetching-data-method)
      - [Deleting data method](#deleting-data-method)
      - [Retrive last inserted ID method](#retrive-last-inserted-id-method)
  - [Skeleton of micro-services](#skeleton-of-micro-services)

## Project Overview

This codebase is a project led by Awfatech Global, primarily aimed at supporting microservices within the Eboss ecosystem. Within this codebase, you will find a collection of objects and methods designed to facilitate the development of PHP-based microservices.

---

## Installation

To get started, follow these steps:

1. **Fork the Codebase**
   : Begin by creating a copy of the codebase in your own Git repository. This process is commonly referred to as "forking."

2. **Pull the Source Code**
   : Retrieve the source code from the remote repository by running the appropriate Git command.

3. **Navigate to the Source Code's Root Directory**
   : Once you have the source code locally, access the root directory of the project.

4. **Start the PHP and Nginx Server**
   : aunch the PHP and Nginx server using Docker Compose by running the following command:
   ```bash
   docker compose up
   ```
   This command will initialize a container and start the server.
5. **Stop the Container**
   : If you need to stop the container, execute the following command:
   ```
   docker compose down
   ```
   This will halt the running container.

These steps will allow you to set up and run the PHP and Nginx server within a Docker container for your project.

---

## Folder Structure

```
    │
    ├── docker [config files for docker]
    ├── logs [nginx logs]
    ├── src [root folder]
    │   ├── api [api endpoints]
    │   ├── assets
    │   │   ├── core [core object's folder]
    │   │   │   ├── lib [library/package's folder]
    │   │   ├──  [specific business logic object's folder]
    │   ├── logs [error log]
    │   ├── secrets [secret keys]
    ├── README.md
    ├── docker-compose.yml
    ├── .env
    └── .gitignore

```

## Core Classes description

Within this codebase, you'll encounter a diverse set of Classes, each tailored to fulfill distinct requirements. These Classes have been designed and implemented to serve specific purposes, reflecting the versatility and flexibility of the codebase. Whether it's handling various data processing tasks, managing database interactions, or facilitating backend operations, these Classes have been intricately crafted to meet the diverse needs of our application.

Files inside core:

```text
│ core
│ ├── api_response.php
│ ├── err.php
│ ├── file_up.php
│ ├── handle_token.php
│ ├── sql_pdo.php

```

---

### API response Class and Methods

This is a straightforward Class designed for the construction of API responses and their transmission to the client.

Creating Object from the `ApiResponse` Class

```php
$responseBuilder = new ApiResponse('<status code>','<status>','<message>','<data>');
```

By executing this snippet, create a new instance of the ApiResponseBuilder object, enabling you to utilize its functionalities for crafting and transmitting API responses to clients.

Afterward, it is necessary to utilize the following method to transmit the response to the client:

```php
echo $responseBuilder->toJson();
```

Executing this line will ensure that the assembled API response reaches its intended recipient.

---

### error handling Class and Methods

The error handling component, integrated into the core objects, specializes in logging service-related errors while excluding those originating from user mistakes. Business logic is responsible for addressing errors caused by users based on specific requirements. During the initialization of the error object, it necessitates three parameters: the error description, the application responsible for the error, and the user accountable for triggering it.

How to use the error object in code:

```php

try {
   // logic
} catch (Throwable $e) {
   ErrorHandler::handleException($e, '<from where>', '<from whom>');
}

```

---

### File upload Class and Methods

---

### handle token

---

The JWToken object plays a crucial role in the Eboss ecosystem by facilitating the decoding of JWTs and the extraction of vital information. Within this ecosystem, the API gateway takes charge of generating tokens enriched with client-specific details. These tokens are transmitted alongside every request to microservices. This allows microservices to leverage the enclosed information for diverse tasks, ranging from establishing connection-specific data for individual clients to directing file storage to specific file servers.

Utilizing the JWToken object is a simple process, involving just one method: decodeToken. Here's a basic example of how to use it:

```php

$jwt = new JWToken();
$appInfo = $jwt->decodeToken('<token>');

```

To gain a deeper understanding of how to effectively utilize the JWToken object and its decodeToken method, it is recommended to consult the skeleton documentation. This documentation typically offers a comprehensive resource with detailed explanations, practical examples, and usage guidelines.

---

### Database Class and Methods

---

The MySQLDatabaseHandler class is a versatile and essential component designed to streamline interactions with a MySQL database. This class encapsulates the intricacies of database connectivity and offers a user-friendly interface for executing common database operations, including insertion, updating, deletion, and selection of data.

Creating Object from the `PDODB` Class

```php
$DB = new PDODB($appInfo); // pass appinfo array as parameter (decoded form token)
```

#### Inserting data method

```php
$sql="INSERT into <rest of query>";
$this->DB->insert($sql);
```

This method will insert data into database

#### Updating data method

```php
$sql="UPDATE <table_name> SET <map column> WHERE <rest of clause>";
$this->DB->update($sql);
```

This method will update data into database and will return `1` if data will have updated otherwise 0.

#### Fetching data method

```php
$sql="SELECT <rest of query> WHERE <rest of cluse>";
$this->DB->select($sql);
```

This method will fetch data from database and return the as array

#### Deleting data method

```php
$sql="insert into <rest of query>";
$this->DB->delete($sql);
```

This method will delete data from database

#### Retrive last inserted ID method

```php
$this->DB->lastInsertedId($sql);
```

This method will return latest inserted row id

---

---

## Skeleton of micro-services

There is a skeleton of for business login class and api endpoint. just need to copy rename class name.

renaming:

1. `module-skeleton` is inside `src/assets/`. inside `module-skeleton` diretory there is a file called `module-skeleton.php`. replace the directory and file with an appropiate name.(like micro-service/module name).
2. in `module-skeleton.php` there two classes. one for property name which store in data (map property name with database column name, but property name must be meaningful) and another one is for methods those will handle business logic part. replace those classes name.
3.
