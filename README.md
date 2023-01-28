# fitness-api

A smart digital api management solution for modern fitness entrepreneurs and personal trainers.

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
