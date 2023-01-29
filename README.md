# fitness-api

A smart digital api management solution for modern fitness entrepreneurs and personal trainers to simplify and streamline your business management, freeing you from the monotone paperwork so you have more freedom and energy for other pursuits.

You can create follow up video content for every workout in your Fitness center. Depending on a video you can specify steps that closely follow everything you do. This could be a great solution for personal trainers allowing their users to inspect and practise certain routines at home.

Our solutions helps you to make instructions videos available to your clients so that you can simplify your work during the fitness sessions. We also offer a database with instruction videos you can use.

### TODO
- [x] Create v1 of ERD
- [x] Architecture description
- [x] Implementation of v1 ERD
- [ ] Build CMS (perhaps Nova?)
- [ ] Basic description
- [ ] Usage
- [ ] Examples

### v1 ERD

![fitness-api drawio](https://user-images.githubusercontent.com/22980168/215267846-d492aca8-55a6-4a52-ad23-596a118955d1.png)

### Onion Architecture
Domain entities are the core and centre part. Onion architecture is built on a domain model in which layers are connected through interfaces. 
The idea is to keep external dependencies as far outward as possible where domain entities and business rules form the core part of the architecture.

![Onion architecture drawio](https://user-images.githubusercontent.com/22980168/215268458-96f94f98-5901-4503-a54f-a7e32ce77004.png)
### Organisation Implementation

Currently CRUD operations for Organisation is disabled due to them only being available via CMS.

![fitness-api-flow drawio](https://user-images.githubusercontent.com/22980168/214027316-6e5a4f6b-5341-4308-bf60-bcc902dcbfd8.png)

# Configuration

Before API usage, please rename `.env.example` into `.env`

Run this commands which will create a dummy admin account, with all the necessary dummy data for testing
```bash
php artisan migrate --seed
```

Admin credentials

```bash
username: admin@graphene.com
password: password
```
