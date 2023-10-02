
# Interview Test Project

This repository contains a PHP project developed as an interview test task. It's built with the Symfony 6.3 framework and showcases various features and functionalities.

## Requirements

- Docker & docker compose

## Key Features

- Built with Symfony 6.3 framework.
- Uses Guzzle for making HTTP requests.
- Organized with the following main namespaces: `Application`, `Presentation`, and `Infrastructure`.

## Design Choices

### Directory Structure

The directory structure and namespaces (`Application`, `Presentation`, and `Infrastructure`) draw inspiration from the principles of Domain-Driven Design (DDD). However, it's worth noting that this isn't a classic DDD approach. Instead, it's a deliberately simplified version where the `Application` namespace encompasses both application-specific logic and domain logic. This organization provides a clear separation of concerns:

- **Application**: Contains use cases, domain logic, and application-specific logic. It represents the layer closest to the end-users, serving as an intermediary between the domain (or core) logic and the user interface.

- **Presentation**: Focuses on the user interface and how data is presented to and accepted from the user. This can include controllers, templates, and view models.

- **Infrastructure**: Deals with concerns external to our application, such as databases, messaging systems, and external services. It serves as a bridge between the application's core logic and any external systems or third-party libraries.

By merging the application and domain layers, this structure aims for simplicity while still maintaining a degree of separation for different responsibilities.

### Why Symfony?

Symfony is a robust and modular PHP framework that offers a wide range of components and tools to streamline the development process. Its flexibility, scalability, and community support make it an ideal choice for this project. Additionally, Symfony's built-in tools and conventions provide a clear path to maintainable and efficient code.

### Docker Integration

Using Docker for containerization ensures a consistent environment for development, testing, and deployment. It abstracts away system-specific differences and ensures that the application runs consistently across different machines. The provided `Makefile` simplifies common Docker and project-related tasks, making the development process smoother.

## Installation
Clone the repository:
```shell
git clone https://github.com/anydasa/interview1.git
```
Navigate to the project directory:
```shell
cd interview1
```
Build the Docker image and run the container:
```shell
make build # docker compose build
```

Install the required dependencies using Composer:
```shell
make composer-install # docker compose run --rm app composer install
```

## Running Example command

Before executing the example command, ensure you've created a `.env.local` file in the root directory of the project. Add the following variable with the correct value:

```dotenv
EXCHANGERATESAPI_KEY=your_api_key_here
```
```shell
make run-example # docker compose run --rm app bin/console comm:calc:batch tests/_data/transactions.txt
```

## Running Tests

This project uses Codeception for testing. To run the tests, execute:
```shell
make test # docker compose run --rm app vendor/bin/codecept run
```

## Contributing

While this is primarily an interview test task, any feedback, issues, or pull requests are welcome!