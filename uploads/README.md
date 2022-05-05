
# Quack

## How to add the users table?

#### SQL CODE:

```
CREATE TABLE users (
    usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersName varchar(128) NOT NULL,
    usersEmail varchar(128) NOT NULL,
    usersPwd varchar(128) NOT NULL,
    usersUid varchar(128) NOT NULL,
    usersBio TEXT
    );
```
## How to add the posts table?

#### SQL CODE:

 ```
 CREATE TABLE posts ( 
     postsId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
     postsContent TEXT NOT NULL, 
     postsThumbnail varchar(128), 
     postsTitle varchar(128), 
     postsOwnerId int(11),
     postsFile TEXT
 );
 ```
## How to add the likes table?

#### SQL CODE:

 ```
 CREATE TABLE likes (
	likesId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    postId int(11) NOT NULL,
    usersId int(11) NOT NULL
);
 ```