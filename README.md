# Onion Architecture Docker Fitness API

A smart digital api management solution for modern fitness entrepreneurs and personal trainers to simplify and streamline your business management, freeing you from the monotone paperwork so you have more freedom and energy for other pursuits.

You can create follow-up video content for every workout in your Fitness center. Depending on a video you can specify steps that closely follow everything you do. This could be a great solution for personal trainers allowing their users to inspect and practise certain routines at home.

This API helps you to make instructions videos available to your clients so that you can simplify your work during the fitness sessions. We also offer a database with instruction videos you can use.

### v1 ERD

![fitness-api drawio (2)](https://user-images.githubusercontent.com/22980168/216581867-a9a21fa1-7081-4575-ade1-80abb72b59d2.png)

### Onion Architecture
Domain entities are the core and centre part. Onion architecture is built on a domain model in which layers are connected through interfaces. 
The idea is to keep external dependencies as far outward as possible where domain entities and business rules form the core part of the architecture.

![Onion architecture drawio (1)](https://user-images.githubusercontent.com/22980168/215732848-459b243a-d977-4953-8e26-85ce6bc0a886.png)
### Organisation Implementation

Currently CRUD operations for Organisation is disabled due to them only being available via CMS.

![fitness-api-flow drawio (1)](https://user-images.githubusercontent.com/22980168/215733005-1683ab0c-20dd-454a-855c-f8ddee669803.png)

# Configuration

Before API usage, please rename `.env.example` into `.env` (and populate it based on the command outputs)

As this is dockerized all you have to do is run following command and enjoy playing:
1. Build docker image
```bash
docker-compose build app
````
2. Run the environment in background mode
```bash
docker-compose up -d
````
3. Install all the dependencies
```bash
docker-compose exec app composer install
````
3. Run the migrations and seeds
```bash
docker-compose exec app php artisan migrate --seed
````
3. Create a personal access client and addit to `.env`
```bash
docker-compose exec app php artisan passport:client --personal
````

You can pull out Postman collection which is in the root of application named
`onion-architecture-docker-api.postman_collection.json`

